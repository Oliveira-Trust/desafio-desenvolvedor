from flask import Flask, request, jsonify
from flask_pymongo import PyMongo
import pandas as pd
from datetime import datetime
import chardet
import io

app = Flask(__name__)
app.config["MONGO_URI"] = "mongodb://localhost:27017/oliveira_trust"
mongo = PyMongo(app)

@app.route('/upload', methods=['POST'])
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
    #print("CONSULTAR" + encoding)
    
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


@app.route('/historico', methods=['GET'])
def historico_upload():
    """Consulta o arquivo no banco com nome ou data, ou os dois."""
    nome = request.args.get('nome')
    data = request.args.get('data')
    
    filtro = {}
    if nome:
        filtro["nome"] = nome
    if data:
        filtro["data_upload"] = {"$gte": datetime.strptime(data, "%Y-%m-%d")}
    
    resultados = mongo.db.arquivos.find(filtro, {"nome": 1, "data_upload": 1})
    return jsonify([{"id": str(r["_id"]), "nome": r["nome"], "data_upload": r["data_upload"]} for r in resultados])


@app.route('/buscar', methods=['GET'])
def buscar_conteudo():
    """Informar o nome do arquivo e os valores especificos para filtrar a busca."""
    TckrSymb = request.args.get('TckrSymb')
    RptDt = request.args.get('RptDt')
    page = int(request.args.get('page', 1))
    per_page = int(request.args.get('per_page', 10))
    
    filtro = {}
    if TckrSymb:
        filtro["dados.TckrSymb"] = TckrSymb
    if RptDt:
        filtro["dados.RptDt"] = RptDt
    
    pipeline = [
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

