import os

from typing import Any
from typing import List
from typing import Optional

from datetime import datetime

from sqlmodel import select
from sqlmodel import Session

from fastapi import BackgroundTasks

from fastapi import File
from fastapi import APIRouter
from fastapi import UploadFile
from fastapi.responses import JSONResponse
from fastapi.exceptions import HTTPException
from fastapi.encoders import jsonable_encoder

from models.arquivo import ArquivoUpload
from models.arquivo import ArquivoRecord
from models.arquivo import ArquivoRecordList
from models.arquivo import ArquivoUploadList
from models.arquivo import ArquivoUploadResponse
from models.arquivo import ArquivoUploadResponseList

from connections.postgres import get_db_session

router = APIRouter()

@router.get("/", response_model=ArquivoUploadList, summary="List all files uploaded")
def get_file_list(pagenumber: int = 1, pagelimit: int = 20) -> Any:
    session = Session(get_db_session())
    arquivo_list = session.exec(
        select(ArquivoUpload).limit(pagelimit).offset((pagenumber-1) * pagelimit)
        ).all()

    session.close()
    return ArquivoUploadList(data=arquivo_list, count=len(arquivo_list))


@router.get("/records", response_model=ArquivoRecordList, summary="list all data of all files")
def get_file(TckrSymb: str = None, RptDt: str = None, pagenumber: int = 1, pagelimit: int = 20) -> Any:
    session = Session(get_db_session())

    query = select(ArquivoRecord)
    if RptDt: query = query.where(ArquivoRecord.RptDt == RptDt)
    if TckrSymb: query = query.where(ArquivoRecord.TckrSymb == TckrSymb)

    arquivo_list = session.exec(
        query.limit(pagelimit).offset((pagenumber-1) * pagelimit)
        ).all()

    session.close()
    return ArquivoRecordList(data=arquivo_list, count=len(arquivo_list))


@router.get("/{id}/records", response_model=ArquivoRecordList, summary="list all data of designed file")
def get_file(id: int, TckrSymb: str = None, RptDt: str = None, pagenumber: int = 1, pagelimit: int = 20) -> Any:
    session = Session(get_db_session())

    query = select(ArquivoRecord).where(ArquivoRecord.ArquivoUploadId == id)
    if TckrSymb: query = query.where(ArquivoRecord.TckrSymb == TckrSymb)
    if RptDt: query = query.where(ArquivoRecord.RptDt == RptDt)

    arquivo_list = session.exec(
        query.limit(pagelimit).offset((pagenumber-1) * pagelimit)
        ).all()

    session.close()
    return ArquivoRecordList(data=arquivo_list, count=len(arquivo_list))


@router.post("/upload", response_model=ArquivoUploadResponseList, summary="upload files to service")
async def upload_file(files: List[UploadFile] = File(...), background_tasks: BackgroundTasks = BackgroundTasks()) -> Any:

    success_count: int = 0
    upload_list: List[ArquivoUploadResponse] = []

    for file in files:
        ALLOWED_MIME_TYPES = {
            'text/csv',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        }

        if file.content_type not in ALLOWED_MIME_TYPES:
            upload_list.append(ArquivoUploadResponse(filename=file.filename, status="file type mismatch"))
            continue

        session = Session(get_db_session())
        if session.exec(select(ArquivoUpload).where(ArquivoUpload.filename == file.filename)).first():
            upload_list.append(ArquivoUploadResponse(filename=file.filename, status="file already exists"))
            continue            

        try:
            contents = file.file.read()

            file_size = len(contents)
            open(file.filename, 'wb').write(contents)
            upload = ArquivoUpload(filesize=file_size, data=datetime.now(), filename=file.filename)

            session.add(upload)
            session.commit()

            success_count += 1
            session.refresh(upload)
            upload_list.append(ArquivoUploadResponse(filename=file.filename, status="success", id=upload.id))

        except Exception as ex:
            session.rollback()
            if os.path.exists(file.filename): os.remove(file.filename)
            upload_list.append(ArquivoUploadResponse(filename=file.filename, status="failed"))

        finally:
            session.close()
            file.file.close()
  
    background_tasks.add_task(process_csv_file, upload_list)
    status_code = 202 if success_count == len(files) else (207 if success_count else 400)
    return JSONResponse(status_code=status_code, content=jsonable_encoder(upload_list))

def process_csv_file(upload_list: List[ArquivoUploadResponse]) -> None:

    for upload in upload_list:
        if not upload.status.startswith("success"):
            continue

        if not os.path.exists(upload.filename):
            continue

        session = Session(get_db_session())
        record_list: List[ArquivoRecord] = []
        try:
            with open(upload.filename, "rt") as csvfile:
                file_lines: List[str] = csvfile.readlines()
                colum_dict = {column:index for index, column in enumerate(file_lines[1].split(";"))}

                for csvdata in file_lines[2:]:
                    data = csvdata.split(";")
                    record_list.append(
                        ArquivoRecord(
                            upload_id=upload.id,
                            ISIN=data[colum_dict.get("ISIN")],
                            RptDt=data[colum_dict.get("RptDt")],
                            MktNm=data[colum_dict.get("MktNm")],
                            TckrSymb=data[colum_dict.get("TckrSymb")],
                            SctyCtgyNm=data[colum_dict.get("SctyCtgyNm")],
                        ))

                csvfile.close()

            session.add_all(record_list)

            session.commit()
            os.remove(upload.filename)

        except Exception as ex:
            session.rollback()

        finally:
            session.close()
