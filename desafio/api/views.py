from rest_framework import mixins, viewsets
from .models import Arquivo
from .serializers import ArquivoSerializer
from rest_framework.response import Response
from rest_framework.decorators import action
from .tests import CSVFactory
import os
from django.conf import settings
from django.core.exceptions import ValidationError


class ArquivosAPIViewSet(mixins.CreateModelMixin,
                         mixins.ListModelMixin,
                         mixins.RetrieveModelMixin,
                         viewsets.GenericViewSet):
    queryset = Arquivo.objects.all()
    serializer_class = ArquivoSerializer

    def get_queryset(self):
        queryset = super().get_queryset()
        data = self.request.query_params.get('data')
        nome = self.request.query_params.get('nome')
         
        if data:
            queryset = queryset.filter(data_publicacao__date=data)   
        if nome:
            queryset = queryset.filter(upload_arquivo__icontains=nome)
  
        return queryset



class PesquisaAPIViewSet(mixins.ListModelMixin,
                         mixins.RetrieveModelMixin,
                         viewsets.GenericViewSet):
    queryset = Arquivo.objects.all()
    serializer_class = ArquivoSerializer

    def get_queryset(self):
        queryset = super().get_queryset()
        data = self.request.query_params.get('data')
        nome = self.request.query_params.get('nome')
        if data:
            queryset = queryset.filter(data_publicacao__date=data)
        if nome:
            queryset = queryset.filter(upload_arquivo__icontains=nome)
        
        return queryset
    
    def list(self, request, *args, **kwargs):
        queryset = self.get_queryset()
        result = []
        for arquivo in queryset:
            nome_arquivo = arquivo.upload_arquivo.name
            caminho_arquivo = os.path.join(settings.MEDIA_ROOT, nome_arquivo)
            if not os.path.exists(caminho_arquivo):
                return Response({"error": f"O arquivo '{nome_arquivo}' não localizado!"}, status=404)
            query = self.request.query_params.get('n', None)
            try:
                csv_reader = CSVFactory.create(caminho_arquivo)
                datas = csv_reader.coluna(query)
                for i, data in enumerate(datas):
                    result.append({i+1: data})
            except ValidationError as e:
                return Response({"error": str(e)}, status=400)
        return Response(result)