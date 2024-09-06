from flask import Flask, request, jsonify
from flask_pymongo import PyMongo
import pandas as pd
from datetime import datetime
import chardet
import io

app = Flask(__name__)
app.config["MONGO_URI"] = "mongodb://localhost:27017/arquivo_db"
mongo = PyMongo(app)

@app.route('/upload', methods=['POST'])
def upload_arquivo():
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
        df = pd.read_excel(io.BytesIO(conteudo))
    else:
        df = pd.read_csv(io.BytesIO(conteudo), encoding=encoding, delimiter=';')
    
    dados = df.to_dict('records')
    
    resultado = mongo.db.arquivos.insert_one({
        "nome": file.filename,
        "data_upload": datetime.now(),
        "dados": dados
    })
    
    return jsonify({"message": "Arquivo enviado com sucesso", "id": str(resultado.inserted_id)}), 201


if __name__ == "__main__":
    app.run(debug=True)