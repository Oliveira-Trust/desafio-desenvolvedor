from pymongo import MongoClient
import pandas as pd
import json
import csv

def get_db_client():
    client = MongoClient("mongodb://192.168.1.29:27017/")
    db_handle = client['db_data']
    return db_handle, client




db, client = get_db_client()
csv_path = '/home/rubens/pythonProjects/desafio-desenvolvedor/main_endpoint/InstrumentsConsolidatedFile_20240927_1.csv'
if 'InstrumentsConsolidatedFile_20240927_1' not  in db.list_collection_names():    
    data = pd.read_csv(csv_path,skiprows=[0], encoding='latin1', delimiter=';', low_memory=False) #, on_bad_lines='skip'
    print(data.head(10))
    payload = json.loads(data.to_json(orient='records'))
    coll = db['InstrumentsConsolidatedFile_20240927_1']
    coll.insert_many(payload)
    count = coll.count_documents({})
client.close()

