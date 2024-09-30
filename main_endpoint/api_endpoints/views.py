from typing import Any
from django.shortcuts import render

from django.contrib.auth.models import Group, User
from rest_framework import permissions, viewsets

from tutorial.quickstart.serializers import GroupSerializer, UserSerializer

from rest_framework.viewsets import ViewSet
from rest_framework.response import Response
from .serializers import UploadSerializer
from mongo_utils import mongoDBClient
import re
import pandas as pd
import json 
from rest_framework import status
from .decorators import define_usage
from rest_framework.reverse import reverse
from rest_framework.decorators import api_view, permission_classes, authentication_classes
from rest_framework.authentication import SessionAuthentication, BasicAuthentication, TokenAuthentication
from rest_framework.permissions import AllowAny, IsAuthenticated
from rest_framework.authtoken.models import Token
from django.contrib.auth import authenticate

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
        mongo = mongoDBClient()
        db, _ = mongo.get_db_client()
        data = db.list_collection_names()
        return Response(data=data)

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
                return Response(response, status=status.HTTP_409_CONFLICT)            
            
        response = "POST API can't handle a {} file".format(content_type)
        return Response(response, status=status.HTTP_415_UNSUPPORTED_MEDIA_TYPE)


#URL /signin/
@define_usage(params={'username': 'String', 'password': 'String'},
              returns={'authenticated': 'Bool', 'token': 'Token String'})
@api_view(['POST'])
@permission_classes((AllowAny,))
def signin(request):
    try:
        username = request.data['username']
        password = request.data['password']
    except:
        return Response({'error': 'Please provide correct username and password'},
                        status=status.HTTP_400_BAD_REQUEST)
    user = authenticate(username=username, password=password)
    if user is not None:
        token, _ = Token.objects.get_or_create(user=user)
        return Response({'authenticated': True, 'token': "Token " + token.key})
    else:
        return Response({'authenticated': False, 'token': None})

#URL /get_by_name/
@api_view(['POST'])
@permission_classes((AllowAny,))
def get_by_name(request):
    try:        
        filename = request.data['filename']        
    except:
        return Response({'error': 'Please provide correct username and password - - '},
                        status=status.HTTP_400_BAD_REQUEST)
    mongo = mongoDBClient()
    db, client = mongo.get_db_client()
    if filename in db.list_collection_names(): 
        response = "File {} is in the database.".format(filename)
        return Response(response, status=status.HTTP_200_OK)
    else:
        response = "File {} is not in the database.".format(filename)
        return Response(response, status=status.HTTP_404_NOT_FOUND)
    
#URL /get_by_date/
@api_view(['POST'])
@permission_classes((AllowAny,))
def get_by_date(request):
    try:        
        date = request.data['date']        
    except:
        return Response({'error': 'Please provide correct username and password - - '},
                        status=status.HTTP_400_BAD_REQUEST)
    mongo = mongoDBClient()
    db, client = mongo.get_db_client()
    files = []
    for collections in db.list_collection_names():
        if date in collections:
            files.append(collections)    
    if len( files) > 0:         
        return Response(json.dumps(files), status=status.HTTP_200_OK)
    else:
        response = "File {} is not in the database.".format(date)
        return Response(response, status=status.HTTP_404_NOT_FOUND)
    
#URL /get_by_date/
@api_view(['POST'])
@permission_classes((AllowAny,))
def get_file_content(request):
    try:        
        TckrSymb = request.data['TckrSymb']        
        RptDt = request.data['RptDt'] 
    except:
        return Response({'error': 'Please provide correct username and password - - '},
                        status=status.HTTP_400_BAD_REQUEST)
    mongo = mongoDBClient()
    db, client = mongo.get_db_client()    
