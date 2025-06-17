from pydantic import BaseModel
from typing import List, Optional
from datetime import date

class InstrumentsOut(BaseModel):
  """Schema de saída para um instrumento."""
  RptDt: date
  TckrSymb: str
  MktNm: Optional[str]
  SctyCtgyNm: Optional[str]
  ISIN: Optional[str]
  CrpnNm: Optional[str]

class UploadHistoryOut(BaseModel):
  """Schema de saída para o histórico de upload."""
  filename: str
  upload_date: date

class PaginatedInstrumentsOut(BaseModel):
  """Schema de saída para resultados paginados."""
  page: int
  page_size: int
  results: List[InstrumentsOut]
