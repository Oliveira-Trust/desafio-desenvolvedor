
import io

import pandas as pd

from apps.common.utils import replace_nan_based_on_field_type
from apps.instruments.models import Instrument, InstrumentFile


def clean_instrument_spreadsheet(instrument_file: InstrumentFile) -> pd.DataFrame:
    # Decodificar os bytes para uma string
    file_content = instrument_file.file.read().decode('latin1')

    df = pd.read_csv(
        io.StringIO(file_content),
        encoding='latin1',
        sep=';',
        skiprows=1
    )
    instrument_model_fields = {field.name: field for field in Instrument._meta.get_fields()}
    df = replace_nan_based_on_field_type(df, instrument_model_fields)

    # Setar id do instrument_file em todas as linhas
    df['instrument_file_id'] = instrument_file.pk
    return df
