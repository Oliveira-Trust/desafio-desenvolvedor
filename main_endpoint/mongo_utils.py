from pymongo import MongoClient

def get_db_handle(db_name, host, port, username, password):

    # client = MongoClient(host=host,
    #                     port=int(port),
    #                     username=username,
    #                     password=password
    #                     )
    client = MongoClient("mongodb://192.168.1.29:27017/")
    db_handle = client['db_data']
    return db_handle, client
