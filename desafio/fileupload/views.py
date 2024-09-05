from rest_framework import generics
from rest_framework.generics import ListAPIView
from rest_framework import status
from django.shortcuts import render
from rest_framework.response import Response
from .serializers import FileUploadSerializer, FileUploadListSerializer, FileUploadContentListSerializer
from fileupload.models import File
import pandas as pd
from datetime import datetime
from rest_framework import filters
from django.utils.decorators import method_decorator
from django.views.decorators.vary import vary_on_cookie, vary_on_headers
from rest_framework.permissions import IsAuthenticated
class FileUploadView(generics.ListAPIView):
   
   serializer_class = FileUploadSerializer
   
   def post(self, request, *args, **kwargs):
      serializer = self.get_serializer(data=request.data)
      serializer.is_valid(raise_exception=True)      

      if request.data['file']:    
         
         file = serializer.validated_data['file']
         
         if File.objects.filter(name=file.name):
            return Response({'status':'Arquivo já existe no banco de dados'},
                            status.HTTP_409_CONFLICT)            
            
            

        
         if file.name.endswith('.csv'):
            print('file name ', type(file.name))        
            
            df = pd.read_csv(file,on_bad_lines = "skip",sep=';',encoding= 'unicode_escape',skiprows=1)
            df['name'] = file.name
            df['upload_date'] =  datetime.today()

           

         elif file.name.endswith('.xlsx'):
            df = pd.read_excel(file,  engine='openpyxl')
            df['name'] = file.name
            df['upload_date'] = datetime.today()
            
         else:
                        
            return Response({'status':'Arquivo com formato não permitido'},
                            status.HTTP_403_FORBIDDEN)

         
                 
         for _ , row in df.iterrows():            
                    
            db = File(
               name = file.name,
               RptDt= row.RptDt,            
               TckrSymb = row.TckrSymb,
               MktNm = row.MktNm,
               SctyCtgyNm = row.SctyCtgyNm ,
               ISIN = row.ISIN,
               CrpnNm  = row.CrpnNm,
               upload_date= row.upload_date)       
                            
            db.save()
         
         return Response({"status":"sucess"},
                      status.HTTP_201_CREATED)



class UploadList(ListAPIView):
   
    queryset = File.objects.all().distinct('name', 'upload_date')   
    serializer_class = FileUploadListSerializer
    filter_backends = [filters.SearchFilter]
    search_fields = ['name', 'upload_date']
    
   


class UploadContentList(ListAPIView):
      
   queryset = File.objects.all().order_by('RptDt','TckrSymb','MktNm', 'SctyCtgyNm', 'ISIN','CrpnNm').distinct('RptDt','TckrSymb','MktNm', 'SctyCtgyNm', 'ISIN','CrpnNm')
   serializer_class = FileUploadContentListSerializer
   permission_classes = [IsAuthenticated]
   filter_backends = [filters.SearchFilter]   
   search_fields = ['=RptDt','=TckrSymb']
  
   
 

      
   

  
        
        
            
            
              
      
