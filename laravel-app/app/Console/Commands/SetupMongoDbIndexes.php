<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MongoDB\Client;

class SetupMongoDbIndexes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:mongo:setup-indexes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create necessary indexes in MongoDB for financial data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $host = config('database.connections.mongodb.host');
        $port = config('database.connections.mongodb.port');
        $database = config('database.connections.mongodb.database');
        $username = config('database.connections.mongodb.username');
        $password = config('database.connections.mongodb.password');

        $dsn = "mongodb://";
        if ($username && $password) {
            $dsn .= "{$username}:{$password}@";
        }
        $dsn .= "{$host}:{$port}";

        $this->info('Connecting to MongoDB...');

        try {
            $client = new Client($dsn);
            $db = $client->selectDatabase($database);
            $collection = $db->financial_data;

            $this->info('Creating indexes for financial data collection...');

            $collection->createIndex(['TckrSymb' => 1], ['name' => 'idx_ticker']);
            $this->info('- Created index for TckrSymb');

            $collection->createIndex(['RptDt' => 1], ['name' => 'idx_report_date']);
            $this->info('- Created index for RptDt');

            $collection->createIndex(['TckrSymb' => 1, 'RptDt' => 1], ['name' => 'idx_ticker_date']);
            $this->info('- Created compound index for TckrSymb and RptDt');

            $collection->createIndex(['ISIN' => 1], ['name' => 'idx_isin']);
            $this->info('- Created index for ISIN');

            $collection->createIndex(['MktNm' => 1], ['name' => 'idx_market']);
            $this->info('- Created index for MktNm');

            $this->info('MongoDB indexes created successfully!');
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Failed to create MongoDB indexes: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
} 