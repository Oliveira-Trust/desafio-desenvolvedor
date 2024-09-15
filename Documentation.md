# Documentação das APIs

## Um breve resumo de como ultilizalas. 
APIs são acessadas na url http://localhost:80/

## 1. Create Token

**Endpoint:** POST /api/tokens/create
**Request:** Nenhum corpo de solicitação é necessário.
**Descrição:** Gera um token de autenticação para fins de teste.
**Response:** "token":  "4|wZr75voxsXI0CfXkA15HGAgqOOlu8yf9KnsPWBIa019d4d77"
**Codigo:** success (200 OK):

## 2. Upload File

**Endpoint:** POST /api/v1/upload
**Request:** File. O arquivo CSV a ser carregado (Tipo de conteúdo: multipart/form-data)
**Descrição:** Carrega um arquivo CSV. Requer autenticação bearer token
**Response:** ""Arquivo Enviado""
**Codigo:** success (200 OK):

**Erro 1:** 

> **{"success":false,"message":"Validation errors","data":{"file":["O
> arquivo j\u00e1 foi enviado anteriormente."]}}**

**Erro 2:** **

> **{"success":false,"message":"Validation
> errors","data":{"'file.required' => 'O arquivo é obrigatório.',."]}}**

**
**Erro 3:**

>  **{"success":false,"message":"Validation errors","data":{''file.file'
> => 'O arquivo deve ser um arquivo válido.',"]}}**

**Erro 4:** 

> **{"success":false,"message":"Validation errors","data":{''file.mimes'
> => 'O arquivo deve ser do tipo: csv, xlsx.',',"]}}**




## 3. Upload History

**Endpoint:** GET /api/v1/upload
**Request:** Parâmetros de consulta são opcional, filtre os resultados usando "name" e "uploaded_at". Requer autenticação bearer token
Exemplo do body:
{

	"name":"InstrumentsConsolidatedFile_20240823.csv",
	"uploaded_at":"2024-09-14"

}
**Descrição:** Recupera uma lista de arquivos carregados.
**Response: ** json 
	{
	
			"name":  "InstrumentsConsolidatedFile_20240823.csv",
			"hash":  "18e8d00d5e7fd8542ba7aeeaf24d32ac5bec574b405fbeb1e87a5880aa6d5310",
			"path":  "uploads/InstrumentsConsolidatedFile_20240823.csv",
			"uploaded_at":  "2024-09-14T19:04:28.817000Z",
			"updated_at":  "2024-09-14T19:04:28.817000Z",
			"created_at":  "2024-09-14T19:04:28.817000Z",
			"id":  "66e5de3cadb8e2776f08841c"
}
**Codigo:** success (200 OK):
**Erro:** 
{

	"message":  "Campos invalidos"
}

## 4. Search Content

**Endpoint:** GET /api/v1/search-content
**Request:** Parâmetros de consulta são opcional, filtre os resultados usando "name" e "uploaded_at". Requer autenticação bearer token.
Exemplo do body:

{

	"RptDt":  "23/08/2024",
	"TckrSymb":  "003H11"
}
**Descrição:** Descrição: pesquisa conteúdo com base em parâmetros especificados.
**Response: ** json 
{

		"RptDt":  "23/08/2024",
		"TckrSymb":  "003H11",
		"MktNm":  "EQUITY-CASH",
		"SctyCtgyNm":  "FUNDS",
		"ISIN":  "BR003HCTF006",
		"CrpnNm":  "KINEA CO-INVESTIMENTO FDO INV IMOB",
		"id":  "66e5de3cadb8e2776f07f872"		
}
**Codigo:** success (200 OK):
**Erro:** 
{

	'message' => 'Nenhum filtro válido fornecido. Por favor, forneça pelo menos um dos filtros: 
	TckrSymb ou RptDt.
}																						