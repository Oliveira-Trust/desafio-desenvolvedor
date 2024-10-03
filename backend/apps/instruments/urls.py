from django.urls import path
from apps.instruments.views import TestTask, InstrumentViewset

urlpatterns = [
    path('test-task/', TestTask.as_view()),
    path('instruments/', InstrumentViewset.as_view()),
]