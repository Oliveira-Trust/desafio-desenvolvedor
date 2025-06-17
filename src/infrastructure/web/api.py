from fastapi import APIRouter, UploadFile, File, HTTPException, Query
from typing import List,Optional
from datetime import date
from src.application import use_cases
from . import schemas

router = APIRouter()

@router.post("/upload", status_code=201)
def upload_instrument_file(file: UploadFile = File(...)):
    """
    Endpoint para fazer upload de arquivos de instrumentos (CSV ou Excel).
    - **Regra de Negócio**: Não permite o envio do mesmo arquivo duas vezes.
    """
    try:
        result = use_cases.process_file_upload(file.file, file.filename)
        return result
    except ValueError as e:
        raise HTTPException(status_code=400, detail=str(e))
    except Exception:
        raise HTTPException(status_code=500, detail="Ocorreu um erro inesperado ao processar o arquivo.")

@router.get("/history", response_model=List[schemas.UploadHistoryOut])
def get_history(filename: Optional[str] = Query(None), upload_date: Optional[date] = Query(None)):
    """
    Endpoint para buscar o histórico de uploads.
    - **Regra de Negócio**: Permite filtrar por nome do arquivo ou data de referência.
    """
    history = use_cases.list_upload_history(filename,upload_date)
    return history

@router.get("/instruments", response_model=List[schemas.InstrumentsOut])
def search_instruments_endpoint(
    TckrSymb: Optional[str] = Query(None, description="Símbolo do Ticker (ex: AMZO34)"),
    RptDt: Optional[date] = Query(None, description="Data do relatório (ex: 2024-08-26)"),
    page: int = Query(1, gt=0),
    page_size: int = Query(20, gt=0, le=100)
):
    """
    Endpoint para buscar o conteúdo dos arquivos.
    - **Regra de Negócio**: Se nenhum parâmetro for enviado, retorna o resultado paginado.
    - **Regra de Negócio**: Permite busca por TckrSymb e RptDt.
    """
    instruments = use_cases.find_instruments(TckrSymb, RptDt, page, page_size)
    if not instruments:
        raise HTTPException(status_code=404, detail="Nenhum instrumento encontrado.")
    return instruments
