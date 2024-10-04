from django.contrib import admin

from apps.instruments.models import Instrument, InstrumentFile

admin.site.register(InstrumentFile)
admin.site.register(Instrument)

# Register your models here.
