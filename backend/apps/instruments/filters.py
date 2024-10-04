import django_filters
from .models import Instrument

class InstrumentFilter(django_filters.FilterSet):
    class Meta:
        model = Instrument
        fields = {
            'TckrSymb': ['exact', 'icontains'],
            'RptDt': ['exact', 'gt', 'lt']
        }