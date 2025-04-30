<?php

namespace App\Repositories;

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\BSON\UTCDateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class MongoDbDataRepository
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        try {
            $connection = new Client(
                'mongodb://root:password@mongodb:27017/admin'
            );

            $database = $connection->selectDatabase('finance_api');
            $this->collection = $database->file_data;

            $this->createIndexes();
        } catch (\Exception $e) {
            Log::error('MongoDB connection error: ' . $e->getMessage());
        }
    }

    /**
     * Bulk insert data into MongoDB.
     *
     * @param array $data
     * @return bool
     */
    public function bulkInsert(array $data)
    {
        try {
            if (empty($data)) {
                return false;
            }

            foreach ($data as &$item) {
                if (isset($item['RptDt']) && !empty($item['RptDt'])) {
                    $carbon = Carbon::createFromFormat('Y-m-d', $item['RptDt']);
                    $item['RptDt'] = new UTCDateTime($carbon->timestamp * 1000);
                }
                
                $now = new UTCDateTime(Carbon::now()->timestamp * 1000);
                $item['created_at'] = $now;
                $item['updated_at'] = $now;
            }

            $result = $this->collection->insertMany($data);
            return $result->isAcknowledged();
        } catch (\Exception $e) {
            Log::error('MongoDB bulk insert error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Search for financial instruments by ticker and/or date.
     *
     * @param string|null $ticker
     * @param string|null $date
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function search($ticker = null, $date = null, $limit = 50, $offset = 0)
    {
        try {
            $filter = [];

            if ($ticker) {
                $filter['TckrSymb'] = $ticker;
            }

            if ($date) {
                $carbon = Carbon::createFromFormat('Y-m-d', $date);
                $filter['RptDt'] = new UTCDateTime($carbon->timestamp * 1000);
            }

            $cursor = $this->collection->find(
                $filter,
                [
                    'limit' => (int) $limit,
                    'skip' => (int) $offset,
                    'sort' => ['TckrSymb' => 1, 'RptDt' => -1]
                ]
            );

            $results = [];
            foreach ($cursor as $document) {
                $document = iterator_to_array($document);
                
                if (isset($document['RptDt']) && $document['RptDt'] instanceof UTCDateTime) {
                    $carbon = Carbon::createFromTimestamp($document['RptDt']->toDateTime()->getTimestamp());
                    $document['RptDt'] = $carbon->format('Y-m-d');
                }

                if (isset($document['_id'])) {
                    unset($document['_id']);
                }
                
                $results[] = $document;
            }

            $total = $this->collection->countDocuments($filter);

            return [
                'data' => $results,
                'total' => $total,
                'page' => floor($offset / $limit) + 1,
                'limit' => $limit
            ];
        } catch (\Exception $e) {
            Log::error('MongoDB search error: ' . $e->getMessage());
            return [
                'data' => [],
                'total' => 0,
                'page' => 1,
                'limit' => $limit,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Get statistics about the data in MongoDB.
     *
     * @return array
     */
    public function getStats()
    {
        try {
            $totalDocuments = $this->collection->countDocuments();
            
            $uniqueTickers = $this->collection->distinct('TckrSymb');
            
            $oldestDate = $this->collection->findOne([], ['sort' => ['RptDt' => 1]]);
            $newestDate = $this->collection->findOne([], ['sort' => ['RptDt' => -1]]);
            
            $oldestDateStr = null;
            $newestDateStr = null;
            
            if ($oldestDate && isset($oldestDate['RptDt'])) {
                $oldestDateStr = Carbon::createFromTimestamp($oldestDate['RptDt']->toDateTime()->getTimestamp())
                    ->format('Y-m-d');
            }
            
            if ($newestDate && isset($newestDate['RptDt'])) {
                $newestDateStr = Carbon::createFromTimestamp($newestDate['RptDt']->toDateTime()->getTimestamp())
                    ->format('Y-m-d');
            }
            
            return [
                'total_documents' => $totalDocuments,
                'unique_tickers' => count($uniqueTickers),
                'date_range' => [
                    'from' => $oldestDateStr,
                    'to' => $newestDateStr
                ]
            ];
        } catch (\Exception $e) {
            Log::error('MongoDB stats error: ' . $e->getMessage());
            return [
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Create indexes for optimized queries.
     *
     * @return void
     */
    protected function createIndexes()
    {
        try {
            $this->collection->createIndex(['TckrSymb' => 1]);
            
            $this->collection->createIndex(['RptDt' => 1]);
            
            $this->collection->createIndex(['TckrSymb' => 1, 'RptDt' => 1]);
        } catch (\Exception $e) {
            Log::error('MongoDB create indexes error: ' . $e->getMessage());
        }
    }

    /**
     * Get a preview of data for a specific upload by date.
     *
     * @param string $date
     * @param int $limit
     * @return array
     */
    public function getPreviewByDate($date, $limit = 10)
    {
        try {
            if (empty($date)) {
                return [];
            }
            
            $carbon = Carbon::createFromFormat('Y-m-d', $date);
            $dateFilter = new UTCDateTime($carbon->timestamp * 1000);
            
            $cursor = $this->collection->find(
                ['RptDt' => $dateFilter],
                [
                    'limit' => (int) $limit,
                    'sort' => ['TckrSymb' => 1]
                ]
            );
            
            $results = [];
            foreach ($cursor as $document) {
                $document = iterator_to_array($document);
                
                if (isset($document['RptDt']) && $document['RptDt'] instanceof UTCDateTime) {
                    $carbon = Carbon::createFromTimestamp($document['RptDt']->toDateTime()->getTimestamp());
                    $document['RptDt'] = $carbon->format('Y-m-d');
                }
                
                if (isset($document['_id'])) {
                    unset($document['_id']);
                }
                
                $results[] = $document;
            }
            
            return $results;
        } catch (\Exception $e) {
            Log::error('MongoDB preview error: ' . $e->getMessage());
            return [];
        }
    }
} 