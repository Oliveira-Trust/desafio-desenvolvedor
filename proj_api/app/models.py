from datetime import datetime, timezone

from pydantic import BaseModel, Field


class Upload(BaseModel):
    filename: str = Field(...)
    upload_date: datetime = Field(
        default_factory=lambda: datetime.now(timezone.utc)
    )

    # JSON com o conteúdo do arquivo
    content: dict
