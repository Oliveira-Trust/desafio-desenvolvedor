from typing import Any
from django.shortcuts import render

from django.contrib.auth.models import Group, User
from rest_framework import permissions, viewsets

from tutorial.quickstart.serializers import GroupSerializer, UserSerializer

from rest_framework.viewsets import ViewSet
from rest_framework.response import Response
from .serializers import UploadSerializer
from rest_framework.exceptions import APIException
from mongo_utils import mongoDBClient
import re
import pandas as pd
import json 


class UserViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows users to be viewed or edited.
    """
    queryset = User.objects.all().order_by('-date_joined')
    serializer_class = UserSerializer
    permission_classes = [permissions.IsAuthenticated]


class GroupViewSet(viewsets.ModelViewSet):
    """
    API endpoint that allows groups to be viewed or edited.
    """
    queryset = Group.objects.all().order_by('name')
    serializer_class = GroupSerializer
    permission_classes = [permissions.IsAuthenticated]


class UploadViewSet(ViewSet):
    serializer_class = UploadSerializer
    #permission_classes = [permissions.IsAuthenticated]
    
    def __init__(self, **kwargs: Any) -> None:
        self.matches= ['text/csv','xlsx', 'xls']

    def list(self, request):
        return Response("GET API")

    def create(self, request):
        file_uploaded = request.FILES.get('file_uploaded')
        content_type = file_uploaded.content_type       
        if any(x in content_type for x in self.matches):     
            mongo = mongoDBClient()
            db, client = mongo.get_db_client()
            find = re.compile(r"^[^.]*")
            coll = re.search(find, str(file_uploaded)).group(0)
            print(coll)
            if coll not  in db.list_collection_names():    
                data = pd.read_csv(file_uploaded,skiprows=[0], encoding='latin1', delimiter=';', low_memory=False) #, on_bad_lines='skip'                
                payload = json.loads(data.to_json(orient='records'))
                coll = db[coll]
                coll.insert_many(payload)
                client.close()
                response = "You have uploaded a {} file".format(file_uploaded)
                return Response(response)
            else:
                response = "You have alread uploaded a {} file".format(file_uploaded)
                return Response(response)            
            
        response = "POST API can't handle a {} file".format(content_type)
        return Response(response)