import csv
import threading
from concurrent.futures import ThreadPoolExecutor, ProcessPoolExecutor, as_completed  # Correção aqui
import multiprocessing
import time


class CSVFactory:
    @staticmethod
    def create(arquivo, encoding='ISO-8859-1', delimiter=';'):
        return CSVLeitor(arquivo, encoding, delimiter)


class CSVLeitor:
    def __init__(self, arquivo, encoding='ISO-8859-1', delimiter=';'):
        self.arquivo = arquivo
        self.encoding = encoding
        self.delimiter = delimiter
        self.thread_lock = threading.RLock()  # Lock para uso com threads

    def _processar_linha_thread(self, row, nome_coluna, datas):
        """Processa uma única linha do CSV usando threads"""
        if nome_coluna not in row:
            print(f"A coluna '{nome_coluna}' não foi localizada")
        with self.thread_lock:  # Garante que apenas uma thread por vez possa modificar a lista 'datas'
            datas.append(row[nome_coluna])

    def _processar_chunk(self, chunk, nome_coluna):
        """Processa um 'chunk' (parte) do CSV usando multithreading"""
        datas = []
        with ThreadPoolExecutor() as executor:
            futures = [executor.submit(self._processar_linha_thread, row, nome_coluna, datas) for row in chunk]
            for future in as_completed(futures):
                future.result()  # Espera as threads finalizarem
        return datas

    def _dividir_csv_em_chunks(self, reader, n):
        """Divide o arquivo CSV em 'n' chunks para processamento em paralelo"""
        chunk = []
        for i, row in enumerate(reader, 1):
            chunk.append(row)
            if i % n == 0:
                yield chunk
                chunk = []
        if chunk:  # Retorna o chunk restante
            yield chunk

    def coluna_threaded_multiprocess(self, nome_coluna, chunk_size=100):
        """Leitura da coluna com multithreading e multiprocessing"""
        start_time = time.time()  # Marca o tempo inicial

        manager = multiprocessing.Manager()
        queue = manager.Queue()  # Queue compartilhada entre processos
        datas = []

        try:
            with open(self.arquivo, mode='r', encoding=self.encoding) as file:
                next(file)  # Pula a primeira linha (cabeçalho)
                reader = csv.DictReader(file, delimiter=self.delimiter)

                # Dividimos o arquivo CSV em 'chunks' para processar em paralelo
                chunks = list(self._dividir_csv_em_chunks(reader, chunk_size))

                # Usando ProcessPoolExecutor para paralelizar o processamento dos chunks
                with ProcessPoolExecutor() as executor:  # Correção aqui
                    futures = [executor.submit(self._processar_chunk, chunk, nome_coluna) for chunk in chunks]

                    # Coleta os resultados à medida que os processos terminam
                    for future in as_completed(futures):
                        chunk_datas = future.result()
                        datas.extend(chunk_datas)

        except FileNotFoundError:
            print(f"O arquivo '{self.arquivo}' não foi encontrado.")
        
        except Exception as e:
            print("eee")
        end_time = time.time()  # Marca o tempo final
        print(f"Tempo de execução com multithreading e multiprocessing: {end_time - start_time:.2f} segundos")

        return datas

# Exemplo de uso:
caminho_arquivo = '/home/xxx/Documentos/RESPOSTA/media/InstrumentsConsolidatedFile_20240829_1.csv'  # Caminho do arquivo CSV
query = 'RptDt'  # Nome da coluna a ser lida

# Usando multithreading e multiprocessing juntos
csv_reader = CSVFactory.create(caminho_arquivo)
dados = csv_reader.coluna_threaded_multiprocess(query, chunk_size=100)
for i, data in enumerate(dados):
    print(f"{i+1}: {data}")
