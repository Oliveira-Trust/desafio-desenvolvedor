from django.shortcuts import render
from rest_framework import filters
from django_filters import rest_framework as django_filters
from rest_framework.generics import ListAPIView
from rest_framework.viewsets import ModelViewSet
import django_rq
from apps.instruments.filters import InstrumentFilter
from apps.instruments.models import Instrument, InstrumentFile
from apps.instruments.serializers import InstrumentFileSerializer, InstrumentSerializer
from apps.instruments.tasks import consumer_instrument_spreadsheet

# Fila django_rq
rq_default = django_rq.get_queue("default")

class InstrumentList(ListAPIView):
    queryset = Instrument.objects.all()
    serializer_class = InstrumentSerializer
    filter_backends = [filters.SearchFilter, filters.OrderingFilter, django_filters.DjangoFilterBackend]
    permission_classes = []
    filterset_class = InstrumentFilter
    search_fields = ['TckrSymb', 'RptDt']
    ordering_fields = ['id', 'TckrSymb', 'RptDt', 'created_at', 'updated_at']


class InstrumentFileViewSet(ModelViewSet):
    queryset = InstrumentFile.objects.all()
    serializer_class = InstrumentFileSerializer

    def perform_create(self, serializer: InstrumentFileSerializer):
        super().perform_create(serializer)
        rq_default.enqueue(
            consumer_instrument_spreadsheet,
            serializer.instance.pk
        )

