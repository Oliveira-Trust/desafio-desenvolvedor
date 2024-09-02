from rest_framework import generics
from rest_framework import status
from django.shortcuts import render
from rest_framework.response import Response
from .serializers import FileUploadSerializer
from fileupload.models import File
import pandas as pd
from datetime import datetime
from django.db import transaction

class FileUploadView(generics.CreateAPIView):
   
   serializer_class = FileUploadSerializer

   def post(self, request, *args, **kwargs):
      serializer = self.get_serializer(data=request.data)
      serializer.is_valid(raise_exception=True)

      if request.data['file']:        
         
         file = serializer.validated_data['file']
         if file.name.endswith('.csv'):
            reader = pd.read_csv(file,on_bad_lines = "skip",sep=';')

         elif file.name.endswith('.xlsx'):
            reader = pd.read_excel(file,  engine='openpyxl')
            
         else:
                        
            return Response({'status':'Arquivo com formato não permitido'},
                            status.HTTP_403_FORBIDDEN)         
         
       
                 
         for _ , row in reader.iterrows():
            
                    
            db = File(
               RptDt= row.RptDt,            
               TckrSymb = row.TckrSymb,
               MktNm = row.MktNm,
               SctyCtgyNm = row.SctyCtgyNm ,
               ISIN = row.ISIN,
               CrpnNm  = row.CrpnNm)       
                             
            db.save()
         
         return Response({"status":"sucess"},
                      status.HTTP_201_CREATED)
   

  
        
        
            
            
              
      
