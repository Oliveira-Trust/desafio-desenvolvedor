import csv
import time  # Importa o módulo para medir o tempo de execução

class CSVFactory:
    @staticmethod
    def create(arquivo, encoding='ISO-8859-1', delimiter=';'):
        return CSVLeitor(arquivo, encoding, delimiter)

class CSVLeitor:
    def __init__(self, arquivo, encoding='ISO-8859-1', delimiter=';'):
        self.arquivo = arquivo
        self.encoding = encoding
        self.delimiter = delimiter

    def coluna(self, nome_coluna):
        datas = []
        try:
            # Medir o tempo apenas da leitura do arquivo
            start_time = time.time()  # Marca o tempo de início da leitura
            with open(self.arquivo, mode='r', encoding=self.encoding) as file:
                next(file)  # Pula a primeira linha (cabeçalho)
                reader = csv.DictReader(file, delimiter=self.delimiter)
                for row in reader:
                    if nome_coluna not in row:
                        pass
                    datas.append(row[nome_coluna])
            end_time = time.time()  # Marca o tempo de fim da leitura
            print(f"Tempo de leitura do arquivo: {end_time - start_time:.2f} segundos")  # Exibe o tempo de leitura

        except FileNotFoundError:
            print(f"O arquivo '{self.arquivo}' não foi encontrado.")
        
        except Exception as e:
            print(f"Ocorreu um erro inesperado: {e}")

        return datas

# Uso do código
caminho_arquivo = '/home/xxx/Documentos/RESPOSTA/media/InstrumentsConsolidatedFile_20240829_1.csv'  # Caminho do arquivo CSV
query = 'RptDt'  # Nome da coluna a ser lida

csv_reader = CSVFactory.create(caminho_arquivo)
dados = csv_reader.coluna(query)
