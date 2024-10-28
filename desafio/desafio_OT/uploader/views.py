from django.utils.dateparse import parse_date
from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework import status
from rest_framework.pagination import PageNumberPagination
from .models import UploadHistory
from .serializers import UploadHistorySerializer
import re

class FileUploadView(APIView):
    def post(self, request):
        file = request.FILES.get('file')
        reference_date = request.data.get('reference_date')
        
        if not file or not reference_date:
            return Response({"error": "Arquivo e data de referência são obrigatórios."}, status=status.HTTP_400_BAD_REQUEST)
      
        if UploadHistory.objects.filter(file_name=file.name).exists():
            return Response({"error": "Este arquivo já foi carregado anteriormente."}, status=status.HTTP_400_BAD_REQUEST)

        if not self.is_valid_file_type(file.name):
            return Response({"error": "Formato de arquivo inválido. Somente arquivos CSV, XLSX e XLS são permitidos."}, status=status.HTTP_400_BAD_REQUEST)

        try:
           parsed_date = parse_date(reference_date)
           if not parsed_date or not self.is_valid_date(reference_date):
               raise ValueError 
        except (ValueError, TypeError):
            return Response({"error": "Data de referência inválida. O formato deve ser YYYY-MM-DD."}, status=status.HTTP_400_BAD_REQUEST)
        
        upload_history = UploadHistory.objects.create(
            file_name=file.name,
            reference_date=parsed_date
        )

        return Response(UploadHistorySerializer(upload_history).data, status=status.HTTP_201_CREATED)

    def is_valid_date(self, date_str):
        date_pattern = re.compile(r'^\d{4}-\d{2}-\d{2}$')
        return bool(date_pattern.match(date_str))

    def is_valid_file_type(self, filename):
        valid_extensions = ['.csv', '.xlsx', 'xls']
        return any(filename.lower().endswith(ext) for ext in valid_extensions)

class UploadHistoryPagination(PageNumberPagination):
    page_size = 10  
    page_size_query_param = 'page_size'  
    max_page_size = 100 

class UploadHistoryView(APIView):
    pagination_class = UploadHistoryPagination  

    def get(self, request):
        file_name = request.query_params.get('file_name')
        reference_date = request.query_params.get('reference_date')
        
        uploads = UploadHistory.objects.all()

        if file_name:
            uploads = uploads.filter(file_name__icontains=file_name)

        try:
            if reference_date:
                uploads = uploads.filter(reference_date=parse_date(reference_date))
        except:
            return Response({"error": "Data de referência inválida. O formato deve ser YYYY-MM-DD."}, status=status.HTTP_400_BAD_REQUEST)

        if not uploads.exists():
            return Response({"error": "Nenhum upload encontrado com os critérios fornecidos."}, status=status.HTTP_404_NOT_FOUND)

        page = request.query_params.get('page', 1)
        page_size = request.query_params.get('page_size', self.pagination_class.page_size)

        if (isinstance(page, str) and page.lstrip('-').isdigit()) and int(page) < 1:
            return Response({"error": "O número da página deve ser um inteiro positivo."}, status=status.HTTP_400_BAD_REQUEST)

        if (isinstance(page_size, str) and page_size.lstrip('-').isdigit()) and int(page_size) < 1:
            return Response({"error": "O tamanho da página deve ser um inteiro positivo."}, status=status.HTTP_400_BAD_REQUEST)

        paginator = self.pagination_class()
        result_page = paginator.paginate_queryset(uploads, request)
        serializer = UploadHistorySerializer(result_page, many=True)
        return paginator.get_paginated_response(serializer.data)
