from fastapi import APIRouter, File, UploadFile

router = APIRouter()

"""
Idéia inicial dos Endpoins
"""

@router.post("/upload/")
async def upload_file(file: UploadFile = File(...)):
    pass


@router.get("/upload/history/")
async def upload_history(filename: str = None, date: str = None):
    pass


@router.get("/upload/search/")
async def search_content(TckrSymb: str = None, RptDt: str = None):
    pass