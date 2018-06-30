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
        'app.issuers',
        'app.histories',
        'app.statuses',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CompaniesGrants') ? [] : ['className' => CompaniesGrantsTable::class];
        $this->CompaniesGrants = TableRegistry::getTableLocator()->get('CompaniesGrants', $config);
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

    public function testFindCurrent()
    {
        $actual = $this->CompaniesGrants->find('current', []);
        $expected = [1,2];
        $this->assertEquals($expected, $actual->extract('id')->toArray());
    }
}
