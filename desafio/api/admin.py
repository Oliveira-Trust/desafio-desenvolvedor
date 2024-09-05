from django.contrib import admin
from .models import Arquivo
# Register your models here.

@admin.register(Arquivo)
class ArquivoAdmin(admin.ModelAdmin):
    list_display = ['upload_arquivo', 'data_publicacao']