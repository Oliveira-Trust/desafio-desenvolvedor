# 📂 Laravel File Upload & Python Worker Integration

Este projeto integra uma API backend em **Laravel** para upload de arquivos (`.csv`, `.xlsx`) com um **worker Python** que monitora os arquivos enviados, extrai informações específicas e as insere em um banco de dados **MongoDB**.

## 🚀 Tecnologias utilizadas

- PHP 8 + Laravel
- Python 3.10+
- MongoDB
- Docker + Docker Compose
- Watchdog (Python)
- Pandas (Python)

---

## 📁 Estrutura do Projeto
```
.
├── laravel/ # Projeto Laravel (upload e API de histórico)
├── python/
│ └── worker/
│ └── main.py # Script principal do workerx
├── docker/ # Dockerfiles e configs
├── docker-compose.yml
└── README.md
.
```

## 📦 Como executar o projeto

### 1. Suba os containers
```
docker-compose up --build
```
### Este comando irá subir:

Laravel (PHP)<br>
MongoDB<br>
Worker Python


## 📝 Endpoints da API Laravel
### Upload de arquivos
```
POST /api/upload
Content-Type: multipart/form-data
```

| Campo | Tipo       | Obrigatório |
| ----- | ---------- | ----------- |
| file  | .csv/.xlsx | ✅ Sim       |

Exemplo de cURL:
```
curl -X POST http://localhost:8080/api/upload \
  -F 'file=@/caminho/do/seu/arquivo.csv'
```
💡 Nota: O Worker Python precisa estar em execução para processar os arquivos após o upload.

### History API
```
GET /api/history
```
Query Params opcionais:
- original_name
- reference_date

#### Exemplo de Saída:
```json
[
  {
    "original_name": "InstrumentsConsolidatedFile_20250509_1.csv",
    "stored_name": "1747110609_InstrumentsConsolidatedFile_20250509_1.csv",
    "hash": "0933269574ee3700c7d11de814869ce8",
    "reference_date": "2025-05-09",
    "updated_at": "2025-05-13T04:30:09.864000Z",
    "created_at": "2025-05-13T04:30:09.864000Z",
    "id": "6822cad123e3705f810bddb2"
  }
]
```

Exemplo de cURL:
- 🔍 Todos os Uploads
```
curl -X GET http://localhost:8080/api/history
```

- 🔍 Buscar uploads filtrando por original_name
```
curl -G http://localhost:8080/api/history \
  --data-urlencode "original_name=InstrumentsConsolidatedFile_20250509_1.csv"
```

- 🔍 Buscar uploads filtrando por reference_date
```
curl -G http://localhost:8080/api/history \
  --data-urlencode "reference_date=2025-05-09"
```

#### Search API
Exemplo de saída:
```json
        {
            "RptDt": "2025-05-07",
            "TckrSymb": "003H11",
            "MktNm": "EQUITY-CASH",
            "SctyCtgyNm": "FUNDS",
            "ISIN": "BR003HCTF006",
            "CrpnNm": "KINEA CO-INVESTIMENTO FDO INV IMOB",
            "id": "6822cc133f4a5beefec742bd"
        },
        {
            "RptDt": "2025-05-07",
            "TckrSymb": "A1AP34R",
            "MktNm": "EQUITY-CASH",
            "SctyCtgyNm": "BDR",
            "ISIN": "BRA1APBDR001",
            "CrpnNm": "ADVANCE AUTO PARTS INC",
            "id": "6822cc133f4a5beefec742c3"
        },
```

### 🧠 Sobre o Worker Python
O worker é responsável por:
1. Observar a pasta laravel/public/uploads
2. Detectar novos arquivos
3. Ler os arquivos .csv ou .xlsx
4. Extrair os campos:
- RptDt
- TckrSymb
- MktNm
- SctyCtgyNm
- ISIN
- CrpnNm
5. Inserir os dados na coleção Record do MongoDB

#### 🧪 Executar o Worker Manualmente
1. Crie e ative um ambiente virtual
```
python3 -m venv venv
source venv/bin/activate  # Linux/macOS
# ou
venv\Scripts\activate     # Windows
```

2. Instale as dependências:
```
pip install -r python/worker/requirements
```

3. Execute o worker:
```
python python/worker/main.py
```