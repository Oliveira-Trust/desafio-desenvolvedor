import pytest
from src.application import use_cases
from io import BytesIO
import pandas as pd

# O 'mocker' é uma ferramenta do pytest-mock que nos permite "fingir"
# que funções de outras partes do sistema se comportam como queremos.

def test_process_file_upload_success(mocker):
    """
    Testa o caso de uso de upload bem-sucedido.
    Verifica se, para um arquivo novo, os dados são salvos corretamente.
    """
    mocker.patch('src.infrastructure.database.repositories.is_file_processed', return_value=False)
    mock_save_data= mocker.patch('src.infrastructure.database.repositories.save_file_data')

    # Cria um arquivo CSV falso em memória
    fake_csv_content = "RptDt;TckrSymb\n2025-06-12;TEST1"
    fake_file = BytesIO(fake_csv_content.encode('utf-8'))

    use_cases.process_file_upload(file=fake_file, filename="test.csv")

    mock_save_data.assert_called_once()

def test_process_file_upload_duplicate_file_raises_error(mocker):
    """
    Testa o caso de uso de upload de um arquivo duplicado.
    Verifica se uma exceção ValueError é levantada.
    """

    mocker.patch('src.infrastructure.database.repositories.is_file_processed', return_value=True)
    mock_save_data = mocker.patch('src.infrastructure.database.repositories.save_file_data')

    fake_file = BytesIO(b"content")

    with pytest.raises(ValueError, match= "Arquivo já processado anteriormente."):
        use_cases.process_file_upload(file=fake_file, filename="test.csv")

    # Garante que, nesse caso, a função de salvar NUNCA foi chamada.
    mock_save_data.assert_not_called()







  