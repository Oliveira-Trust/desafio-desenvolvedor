from flask import Flask, request, jsonify
import pandas as pd
from datetime import datetime
import os
import chardet

app = Flask(__name__)
UPLOAD_FOLDER = 'uploads'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

def salvar_arquivo(file):
    file_path = os.path.join(app.config['UPLOAD_FOLDER'], file.filename)
    file.save(file_path)
    return file_path

@app.route('/upload', methods=['POST'])
def upload_arquivo():
    """Salvo o arquivo na pasta uploads."""
    if 'file' not in request.files:
        return jsonify({"error": "Nenhum arquivo enviado"}), 400
    
    file = request.files['file']
    if file.filename == '':
        return jsonify({"error": "Nenhum arquivo selecionado"}), 400
    
    if not file.filename.endswith(('.xlsx', '.csv')):
        return jsonify({"error": "Formato de arquivo não permitido"}), 400
    
    file_path = os.path.join(app.config['UPLOAD_FOLDER'], file.filename)
    if os.path.exists(file_path):
        return jsonify({"error": "Arquivo já foi enviado anteriormente"}), 400
    
    salvar_arquivo(file)
    return jsonify({"message": "Arquivo enviado com sucesso"}), 201


@app.route('/historico', methods=['GET'])
def historico_upload():
    """Consulta o arquivo no banco com nome ou data, ou os dois."""
    nome = request.args.get('nome')
    data = request.args.get('data')
    
    arquivos = []
    for filename in os.listdir(app.config['UPLOAD_FOLDER']):
        file_path = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        stat = os.stat(file_path)
        file_date = datetime.fromtimestamp(stat.st_mtime).strftime('%Y-%m-%d')
        
        if (not nome or nome in filename) and (not data or data == file_date):
            arquivos.append({
                "nome": filename,
                "data_upload": file_date
            })
    
    return jsonify(arquivos)


@app.route('/buscar', methods=['GET'])
def buscar_conteudo():
    """Informar o nome do arquivo e os valores especificos para filtrar a busca."""
    nome = request.args.get('nome')
    TckrSymb = request.args.get('TckrSymb')
    RptDt = request.args.get('RptDt')
    page = int(request.args.get('page', 1))
    per_page = int(request.args.get('per_page', 10))

    if not nome:
        return jsonify({"error": "Nome do arquivo é necessário"}), 400

    file_path = os.path.join(app.config['UPLOAD_FOLDER'], nome)
    if not os.path.exists(file_path):
        return jsonify({"error": "Arquivo não encontrado"}), 404

    with open(file_path, 'rb') as file:
        result = chardet.detect(file.read(10000))
        encoding = result['encoding']

    if nome.endswith('.xlsx'):
        data = pd.read_excel(file_path)
    elif nome.endswith('.csv'):
        data = pd.read_csv(file_path, encoding=encoding, delimiter=';', dtype=str, skiprows=1).fillna('')
    else:
        return jsonify({"error": "Formato de arquivo não suportado"}), 400
    

    if TckrSymb:
        data = data[data['TckrSymb'] == TckrSymb]
    if RptDt:
        data = data[data['RptDt'] == RptDt]
    
    start = (page - 1) * per_page
    end = start + per_page
    dados = data.iloc[start:end].to_dict('records')
    
    return jsonify(dados)


if __name__ == "__main__":
    app.run(debug=True)