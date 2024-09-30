from pymongo import MongoClient

class mongoDBClient():

    def __init__(self) -> None:
        pass

    def get_db_client(self):
        client = MongoClient("mongodb://192.168.1.29:27017/")
        db_handle = client['db_data']
        return db_handle, client


    def get_db_handle(self,db_name, host, port, username, password):
        client = MongoClient(host=host,
                            port=int(port),
                            username=username,
                            password=password
                            )
        db_handle = client[db_name]
        return db_handle, client
