<?php declare(strict_types=1);

namespace Tests\Traits;

trait RefreshMongoDatabase
{
    protected function refreshDatabase()
    {
        $collections = \DB::connection()->getDatabase()->listCollections();

        foreach ($collections as $collection) {
            \DB::connection()
                ->getDatabase()
                ->selectCollection($collection->getName())
                ->drop();
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }
}
