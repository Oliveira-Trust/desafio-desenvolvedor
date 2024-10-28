from rest_framework import serializers
from .models import UploadHistory

class UploadHistorySerializer(serializers.ModelSerializer):
    class Meta:
        model = UploadHistory
        fields = ['file_name', 'uploaded_at', 'reference_date']
