from rest_framework.serializers import ModelSerializer
from apps.instruments.models import Instrument
import math

class InstrumentSerializer(ModelSerializer):
    class Meta:
        model = Instrument
        fields = '__all__'

    def to_representation(self, instance):
        representation = super().to_representation(instance)
        for key, value in representation.items():
            if isinstance(value, float) and math.isnan(value):
                print(instance.id)
                print(key)
                representation[key] = None
        return representation