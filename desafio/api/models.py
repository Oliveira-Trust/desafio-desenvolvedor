from django.db import models
import os
from django.utils.crypto import get_random_string
from django.core.exceptions import ValidationError

from django.core.validators import FileExtensionValidator

class Base(models.Model):
    data_publicacao = models.DateTimeField(auto_now_add=True, blank=True)

    class Meta:
        abstract = True

class Arquivo(Base):
    upload_arquivo = models.FileField(unique=True,  validators=[FileExtensionValidator(allowed_extensions=['csv', 'xlsx'])],
    )

    class Meta:
        verbose_name = "Arquivo"
        verbose_name_plural = "Arquivos"
    
     
   