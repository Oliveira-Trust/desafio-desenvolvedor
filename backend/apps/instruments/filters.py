import django_filters
from django_filters import rest_framework as filters
from django.db.models import FileField

from apps.instruments.models import Instrument, InstrumentFile


class InstrumentFilter(django_filters.FilterSet):
    class Meta:
        model = Instrument
        fields = {
            'TckrSymb': ['exact', 'icontains'],
            'RptDt': ['exact', 'gt', 'lt']
        }


class InstrumentFileFilter(django_filters.FilterSet):
    file = django_filters.CharFilter(method='filter_file_icontains', lookup_expr='icontains')

    class Meta:
        model = InstrumentFile
        fields = {
            'file': ['exact', 'icontains'],
        }
        filter_overrides = {
            FileField: {
                'filter_class': filters.CharFilter,
                'extra': lambda f: {
                    'lookup_expr': 'icontains',
                },
            },
        }

    def filter_file_icontains(self, queryset, name, value):
        return queryset.filter(**{f"{name}__icontains": value})
