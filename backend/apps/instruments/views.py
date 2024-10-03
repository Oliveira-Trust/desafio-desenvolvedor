from django.shortcuts import render
from rest_framework.generics import RetrieveAPIView, ListAPIView
import django_rq
from apps.instruments.models import Instrument
from apps.instruments.serializers import InstrumentSerializer
from apps.instruments.tasks import consumer_spreadsheet

class TestTask(RetrieveAPIView):
    def get(self, request, *args, **kwargs):
        t = django_rq.get_queue("default")
        return t.enqueue(
            consumer_spreadsheet,
            job_timeout=6000
        )

class InstrumentViewset(ListAPIView):
    queryset = Instrument.objects.all()
    serializer_class = InstrumentSerializer
    permission_classes = []
