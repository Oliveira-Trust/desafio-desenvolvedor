<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CurrencyConversionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CurrencyConversionsTable Test Case
 */
class CurrencyConversionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CurrencyConversionsTable
     */
    protected $CurrencyConversions;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CurrencyConversions',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CurrencyConversions') ? [] : ['className' => CurrencyConversionsTable::class];
        $this->CurrencyConversions = $this->getTableLocator()->get('CurrencyConversions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CurrencyConversions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CurrencyConversionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
