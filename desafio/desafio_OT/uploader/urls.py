from django.urls import path
from .views import FileUploadView, UploadHistoryView

urlpatterns = [
    path('upload/', FileUploadView.as_view(), name='file-upload'),
    path('history/', UploadHistoryView.as_view(), name='upload-history'),
]
