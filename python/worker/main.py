import os
import time
import pandas as pd
from watchdog.observers import Observer
from watchdog.events import FileSystemEventHandler
from pymongo import MongoClient
import chardet


#Database configuration
MONGO_URI = "mongodb://localhost:27017/"
DB_NAME = "admin"
COLLECTION_NAME = "records"

# Directory to monitor
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
UPLOADS_DIR = os.path.join(BASE_DIR, '..', '..', 'laravel', 'public', 'uploads')

# Fields to filter from the CSV/XLSX files
# These fields should match the columns in your CSV/XLSX files
FIELDS = ["RptDt", "TckrSymb", "MktNm", "SctyCtgyNm", "ISIN", "CrpnNm"]

# MongoDB client setup
client = MongoClient(MONGO_URI)
db = client[DB_NAME]
collection = db[COLLECTION_NAME]

# Create the uploads directory if it doesn't exist
if not os.path.exists(UPLOADS_DIR):
    print(f"Directory {UPLOADS_DIR} does not exist. Creating it...")
    os.makedirs(UPLOADS_DIR, exist_ok=True)

def detect_encoding(file_path):
    """
    Detects the encoding of a file using the chardet library.

    Args:
        file_path (str): The path to the file.

    Returns:
        str: The detected encoding of the file.
    """
    with open(file_path, 'rb') as f:
        result = chardet.detect(f.read(10000))
    return result['encoding']


class FileHandler(FileSystemEventHandler):
    """
    Handles file system events, specifically for newly created files.
    """

    def on_created(self, event):
        """
        Triggered when a new file is created in the monitored directory.

        Args:
            event (FileSystemEvent): The event object containing information about the created file.
        """
        if not event.is_directory and (event.src_path.endswith(".csv") or event.src_path.endswith(".xlsx")):
            print(f"New file detected: {event.src_path}")
            self.process_file(event.src_path)

    def process_file(self, file_path):
        """
        Processes a newly created file by reading its content, filtering specific fields, 
        and inserting the data into a MongoDB collection.

        Args:
            file_path (str): The path to the file to be processed.
        """
        try:
            if file_path.endswith(".csv"):
                encoding = detect_encoding(file_path) or 'latin1'
                print(f"Codification detected: {encoding}")
                df = pd.read_csv(file_path, encoding=encoding, sep=';', skiprows=1, low_memory=False)
                df.columns = df.columns.str.strip()  # Remove leading/trailing whitespace
                print("Columns available:", df.columns.tolist())
            elif file_path.endswith(".xlsx"):
                df = pd.read_excel(file_path)

            filtered_data = df[FIELDS].dropna()
            records = filtered_data.to_dict(orient="records")
            if records:
                collection.insert_many(records)
                print(f"{len(records)} Records inserted into database.")
            else:
                print("No records to insert.")

        except Exception as e:
            print(f"Error while processing file: {file_path}: {e}")


def monitor_directory():
    """
    Monitors the specified directory for new files and triggers processing when a new file is detected.
    """
    event_handler = FileHandler()
    observer = Observer()
    observer.schedule(event_handler, UPLOADS_DIR, recursive=False)
    observer.start()
    print(f"Monitoring directory: {UPLOADS_DIR}")

    try:
        while True:
            time.sleep(1)
    except KeyboardInterrupt:
        observer.stop()
    observer.join()


if __name__ == "__main__":
    monitor_directory()