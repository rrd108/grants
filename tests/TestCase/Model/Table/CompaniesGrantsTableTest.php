<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompaniesGrantsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompaniesGrantsTable Test Case
 */
class CompaniesGrantsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompaniesGrantsTable
     */
    public $CompaniesGrants;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.companies_grants',
        'app.companies',
        'app.grants',
        'app.issuers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CompaniesGrants') ? [] : ['className' => CompaniesGrantsTable::class];
        $this->CompaniesGrants = TableRegistry::get('CompaniesGrants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CompaniesGrants);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
