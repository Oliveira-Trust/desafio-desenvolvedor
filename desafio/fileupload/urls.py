from django.urls import path
from .views import FileUploadView, UploadList

urlpatterns = [
    path('upload/', FileUploadView.as_view(), name='upload-file'),
    path('uploads/', UploadList.as_view(), name='uploads')
]
