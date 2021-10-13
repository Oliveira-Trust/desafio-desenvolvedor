<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Enums\StatusType;
use App\Models\Fee;
use App\Services\FeeService;
use Tests\TestCase;

class FeeServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->feeService = app(FeeService::class);
    }

    public function test_get_fees(): void
    {
        $fee = Fee::factory(2)->create();
        $result = $this->feeService->getAllFees();

        $this->assertCount(2, $result);
    }

    public function test_not_find_activated_fee(): void
    {
        $params = [
            'type'        => 'B',
            'range'       => 3000,
            'less_than'   => 2,
            'more_than'   => 1,
            'description' => 'Foo description.',
            "status"      => StatusType::INACTIVATED,

        ];
        $this->feeService->storeFee($params);
        $result = $this->feeService->getAllActiveFees();

        $this->assertCount(0, $result);
    }

    public function test_find_fee_by_id(): void
    {
        $params = [
            'type'        => 'B',
            'range'       => 3000,
            'less_than'   => 2,
            'more_than'   => 1,
            'description' => 'Foo description.',
            "status"      => StatusType::ACTIVATED,
        ];

        $fee = $this->feeService->storeFee($params);
        $result = $this->feeService->getFeeById($fee->id);

        $this->assertEquals('B', $result->type);
    }

    public function test_store_fee(): void
    {
        $params = [
            'type'        => 'B',
            'range'       => 3000,
            'less_than'   => 2,
            'more_than'   => 1,
            'description' => 'Foo description.',
            "status"      => StatusType::ACTIVATED,
        ];
        $fee = $this->feeService->storeFee($params);
        $result = $this->feeService->getFeeById($fee->id);

        $this->assertEquals('B', $result->type);
    }

    public function test_update_fee(): void
    {
        $fee = Fee::factory()->create();

        $params = [
            'type'        => 'B',
            'range'       => 3000,
            'less_than'   => 2,
            'more_than'   => 1,
            'description' => 'Foo description.',
            "status"      => StatusType::ACTIVATED,
        ];
        $this->feeService->updateFee($fee->id, $params);
        $result = $this->feeService->getFeeById($fee->id);

        $this->assertEquals('B', $result->type);
    }
}
