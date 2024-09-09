from flask import Flask, request, jsonify
from flask_pymongo import PyMongo
from flask_caching import Cache
from flask_httpauth import HTTPBasicAuth
import pandas as pd
from datetime import datetime
import chardet
import io

app = Flask(__name__)
auth = HTTPBasicAuth()
app.config["MONGO_URI"] = "mongodb://localhost:27017/oliveira_trust"
mongo = PyMongo(app)
app.config['CACHE_TYPE'] = 'simple'
cache = Cache(app)

users = {
    "pablo": "123",
    "teste": "012"
}

@auth.verify_password
def verify_password(username, password):
    """Verifica o nome de usuário e a senha."""
    if username in users and users[username] == password:
        return username
    return jsonify("Pendente Uusername e password.")

@app.route('/upload', methods=['POST'])
@auth.login_required
def upload_arquivo():
    """Leitura do arquivo CSV ou xlsx. Função salvo no banco apenas informções necessárias, reduzindo o tamanho do banco."""
    if 'file' not in request.files:
        return jsonify({"error": "Nenhum arquivo enviado"}), 400
    
    file = request.files['file']
    if file.filename == '':
        return jsonify({"error": "Nenhum arquivo selecionado"}), 400
    
    if not file.filename.endswith(('.xlsx', '.csv')):
        return jsonify({"error": "Formato de arquivo não permitido"}), 400
    
    if mongo.db.arquivos.find_one({"nome": file.filename}):
        return jsonify({"error": "Arquivo já foi enviado anteriormente"}), 400
    
    conteudo = file.read()
    encoding = chardet.detect(conteudo)['encoding']

    if file.filename.endswith('.xlsx'):
        data = pd.read_excel(io.BytesIO(conteudo))
    else:
        data = pd.read_csv(io.BytesIO(conteudo), encoding=encoding, delimiter=';', dtype=str, skiprows=1)
    
    data.fillna('', inplace=True)

    dados_coletados = []

    for index, row in data.iterrows():

        dados_relevantes = {
            "RptDt": row.get('RptDt', ''),
            "TckrSymb": row.get('TckrSymb', ''),
            "MktNm": row.get('MktNm', ''),
            "SctyCtgyNm": row.get('SctyCtgyNm', ''),
            "ISIN": row.get('ISIN', ''),
            "CrpnNm": row.get('CrpnNm', '')
        }
        dados_coletados.append(dados_relevantes)

    resultado = mongo.db.arquivos.insert_one({
    "nome": file.filename,
    "data_upload": datetime.now(),
    "total_linhas": len(dados_coletados),
    "dados": dados_coletados
    })
    
    return jsonify({"message": "Arquivo enviado com sucesso", "id": str(resultado.inserted_id)}), 201

def generate_cache_key():
    """Gera uma chave única baseada na função."""
    endpoint = request.endpoint

    if endpoint == 'historico_info':
        nome = request.args.get('nome', '')
        data = request.args.get('data', '')
        return f"historico_{nome}_{data}"

    elif endpoint == 'buscar_conteudo':
        nome = request.args.get('nome', '')
        TckrSymb = request.args.get('TckrSymb', '')
        RptDt = request.args.get('RptDt', '')
        page = request.args.get('page', '1')
        per_page = request.args.get('per_page', '10')
        return f"buscar_{nome}_{TckrSymb}_{RptDt}_{page}_{per_page}"
    
    return None

@app.route('/historico', methods=['GET'])
@auth.login_required
@cache.cached(timeout=300, key_prefix=generate_cache_key)
def historico_info():
    """Consulta o arquivo no banco com nome ou data, ou os dois."""
    nome = request.args.get('nome')
    data = request.args.get('data')

    if not nome and not data:
        return jsonify({"error": "Informe o nome do arquivo ou a data."}), 400

    filtro = {}
    if nome:
        filtro["nome"] = nome
    if data:
        filtro["data_upload"] = {"$gte": datetime.strptime(data, "%Y-%m-%d")}
    
    resultados = mongo.db.arquivos.find(filtro, {"nome": 1, "data_upload": 1})
    return jsonify([{"id": str(r["_id"]), "nome": r["nome"], "data_upload": r["data_upload"]} for r in resultados])
    

@app.route('/buscar', methods=['GET'])
@auth.login_required
@cache.cached(timeout=300, key_prefix=generate_cache_key)
def buscar_conteudo():
    """Informar o nome do arquivo e os valores especificos para filtrar a busca."""
    nome_arquivo = request.args.get('nome')
    TckrSymb = request.args.get('TckrSymb')
    RptDt = request.args.get('RptDt')
    page = int(request.args.get('page', 1))
    per_page = int(request.args.get('per_page', 10))

    if not nome_arquivo:
        return jsonify({"error": "Informe o nome do arquivo."}), 400
        
    filtro = {}
    if TckrSymb:
        filtro["dados.TckrSymb"] = TckrSymb
    if RptDt:
        filtro["dados.RptDt"] = RptDt
    
    pipeline = [
        {"$match": {"nome": nome_arquivo}},
        {"$unwind": "$dados"},
        {"$match": filtro},
        {"$skip": (page - 1) * per_page},
        {"$limit": per_page},
        {"$project": {
            "_id": 0,
            "RptDt": "$dados.RptDt",
            "TckrSymb": "$dados.TckrSymb",
            "MktNm": "$dados.MktNm",
            "SctyCtgyNm": "$dados.SctyCtgyNm",
            "ISIN": "$dados.ISIN",
            "CrpnNm": "$dados.CrpnNm"
        }}
    ]
        
    resultados = list(mongo.db.arquivos.aggregate(pipeline)) 
    return jsonify(resultados)



if __name__ == "__main__":
    app.run(debug=True)

