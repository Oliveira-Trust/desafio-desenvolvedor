from django.contrib import admin

from apps.instruments.models import Instrument, InstrumentFile


@admin.register(InstrumentFile)
class InstrumentFileAdmin(admin.ModelAdmin):
    list_filter = (
        "created_at",
        "updated_at",
        "file",
    )

    list_display = (
        "created_at",
        "updated_at",
        "file",
    )

    search_fields = ("file",)


admin.site.register(Instrument)
