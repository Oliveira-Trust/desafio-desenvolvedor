<?php

namespace App\Models;

use MongoDB\Client as Mongo;

class FileUpload
{
    protected $mongoClient;
    protected $db;

    public function __construct()
    {
        try {
            $this->mongoClient = new Mongo(env('MONGO_URI'));
            $this->db = $this->mongoClient->selectDatabase('fileupload');
        } catch (\Exception $e) {
            throw new \Exception('Erro ao conectar ao MongoDB: ' . $e->getMessage());
        }
    }

    public function findFileByHash($fileHash)
    {
        return $this->db->file_upload->findOne(['file_hash' => $fileHash]);
    }

    public function saveFileUpload($fileData)
    {
        return $this->db->file_upload->insertOne($fileData);
    }

    public function findFileById($fileId)
    {
        return $this->db->file_upload->findOne(['_id' => new \MongoDB\BSON\ObjectId($fileId)]);
    }

    public function findAllFiles()
    {
        return $this->db->file_upload->find()->toArray();
    }

    public function findFilesByCriteria($filter)
    {
        return $this->db->file_upload->find($filter)->toArray();
    }

    public function insertFileData($preparedBatchData)
    {
        return $this->db->file_data->insertMany($preparedBatchData);
    }

    public function searchFiles($filter, $skip, $limit)
    {
        $cursor = $this->db->file_data->find($filter, [
            'skip' => $skip,
            'limit' => $limit
        ]);
        $documents = $cursor->toArray();
        $total = $this->db->file_data->countDocuments($filter);

        return ['documents' => $documents, 'total' => $total];
    }
}
