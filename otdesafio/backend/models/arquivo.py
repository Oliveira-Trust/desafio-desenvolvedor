from typing import List
from typing import Optional

from datetime import date
from datetime import datetime

from sqlmodel import Field
from sqlmodel import SQLModel
from sqlmodel import Relationship

class ArquivoUpload(SQLModel, table=True):
    __tablename__ = "arquivo_upload"

    id: Optional[int] = Field(default=None, primary_key=True)

    data: date
    filename: str
    filesize: int
    validated: bool = Field(default=False)
    created_at: datetime = Field(default=datetime.now())

    records: Optional[List["ArquivoRecord"]] = Relationship(back_populates="upload")

class ArquivoRecord(SQLModel, table=True):
    __tablename__ = "arquivo_record"

    id: Optional[int] = Field(default=None, primary_key=True)
    upload_id : int = Field(default=None, foreign_key="arquivo_upload.id")

    RptDt: str | None = Field(default=None, max_length=255, description="ReportDate")
    TckrSymb: str | None = Field(default=None, max_length=255, description="TickerSymbol")
    MktNm: str | None = Field(default=None, max_length=255, description="MarketName")
    SctyCtgyNm: str | None = Field(default=None, max_length=255, description="SecurityCategoryName")
    ISIN: str | None = Field(default=None, max_length=255, description="ISIN")
    CrpnNm: str | None = Field(default=None, max_length=255, description="CorporationName")

    upload: Optional[ArquivoUpload] = Relationship(back_populates="records")

class ArquivoUploadList(SQLModel):
    data: List[ArquivoUpload]
    count: int

class ArquivoRecordList(SQLModel):
    data: List[ArquivoRecord]
    count: int

class ArquivoUploadResponse(SQLModel):
    id: Optional[int] = 0
    status: str
    filename: str

class ArquivoUploadResponseList(SQLModel):
    data: List[ArquivoUploadResponse]
    count: int
