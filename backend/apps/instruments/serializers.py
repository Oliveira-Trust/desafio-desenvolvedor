from rest_framework import serializers

from apps.instruments.models import Instrument, InstrumentFile


class InstrumentSerializer(serializers.ModelSerializer):
    class Meta:
        model = Instrument
        fields = '__all__'


class InstrumentFileSerializer(serializers.ModelSerializer):
    class Meta:
        model = InstrumentFile
        fields = '__all__'

    def validate_file(self, value):
        # Verifica o formato do arquivo
        if not value.name.endswith(('.csv', '.xlsx')):
            raise serializers.ValidationError("Formato de arquivo não suportado. Envie um arquivo CSV ou XLSX.")

        # Verificar se o arquivo já existe no banco de dados
        if InstrumentFile.objects.filter(file=f"instrument_files/{value.name}").exists():
            raise serializers.ValidationError("Um arquivo com este nome já foi enviado.")

        return value
