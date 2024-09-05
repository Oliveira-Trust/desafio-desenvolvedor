from rest_framework import serializers
from fileupload.models import File

class FileUploadSerializer(serializers.Serializer):
    file = serializers.FileField()    
    
    class Meta:
        model = File
        fields = "__all__"


class FileUploadListSerializer(serializers.ModelSerializer):
       
    
    class Meta:
        model = File
        fields = ['name', 'upload_date']


class FileUploadContentListSerializer(serializers.ModelSerializer):
       
    
    class Meta:
        model = File
        fields = "__all__"     
