import os
from rest_framework import serializers
from django.core.exceptions import ValidationError

from .models import Arquivo


class DateTimeToDateField(serializers.DateField):
    def to_representation(self, value):
        return super().to_representation(value.date())


class ArquivoSerializer(serializers.ModelSerializer):
    data_publicacao = DateTimeToDateField('%d/%m/%Y', read_only=True)

    class Meta:
        model = Arquivo
        fields = '__all__'

    def to_representation(self, instance):
        rep = super().to_representation(instance)
        rep['upload_arquivo'] = os.path.basename(instance.upload_arquivo.name)
        return rep

    def validate_upload_arquivo(self, arquivo):

        if Arquivo.objects.filter(upload_arquivo=arquivo.name).exists():
            if self.instance and os.path.basename(self.instance.upload_arquivo.name) == arquivo.name:
                return arquivo
            raise ValidationError(f"Ha um arquivo semelhante e não pode ser sobrescrito.")
        return arquivo
