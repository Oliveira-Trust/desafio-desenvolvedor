from pydantic import BaseModel, Field
from datetime import date
from typing import Optional


class Instrument(BaseModel):
   """
    Representa um instrumento financeiro do arquivo.
    """
    RptDt: date = Field(..., alias="RptDt")
    TckrSymb: str = Field(..., alias="TckrSymb")
    MktNm: Optional[str] = Field(None, alias="MktNm")
    SctyCtgyNm: Optional[str] = Field(None, alias="SctyCtgyNm")
    ISIN: Optional[str] = Field(None, alias="ISIN")
    CrpnNm: Optional[str] = Field(None, alias="CrpnNm")

class UploadHistory(BaseModel):
   """
    Representa o histórico de um upload de arquivo.
    """
    id:int
    filename: str
    upload_date: date
    file_hash: str
