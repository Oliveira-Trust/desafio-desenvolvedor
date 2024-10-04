import logging

import numpy as np
import pandas as pd
from django.db import models

# Configurar o logger
logging.basicConfig(level=logging.DEBUG)
logger = logging.getLogger(__name__)


# Função para definir o valor correto para NaN com base no tipo de campo
def replace_nan_based_on_field_type(df: pd.DataFrame, model_fields):
    logger.debug("DataFrame inicial:")
    logger.debug(df)

    for col in df.columns:
        # Verificar se a coluna da planilha existe no modelo
        if col in model_fields:
            field = model_fields[col]
            logger.debug(f"Processando coluna: {col}, Tipo de campo: {type(field)}")

            # Se for um campo de texto, substituir NaN por ""
            if isinstance(field, (models.CharField, models.TextField)):
                df[col] = df[col].fillna(" ")
                logger.debug(f"Substituindo NaN por '' na coluna: {col}")

            # Se for outro tipo de campo, substituir NaN por None
            else:
                df[col] = df[col].replace(np.nan, None)
                logger.debug(f"Substituindo NaN por None na coluna: {col}")

    logger.debug("DataFrame após substituições:")
    logger.debug(df)

    return df
