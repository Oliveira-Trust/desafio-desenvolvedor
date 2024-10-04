from django.urls import path
from rest_framework.routers import DefaultRouter

from apps.instruments.views import InstrumentList, InstrumentFileViewSet

router = DefaultRouter()

router.register(r'upload', InstrumentFileViewSet, basename='instruments-file-upload')

urlpatterns = [
    path('instruments/', InstrumentList.as_view(), name='instruments'),
]
urlpatterns += router.urls
