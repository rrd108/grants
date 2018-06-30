<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GrantsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GrantsTable Test Case
 */
class GrantsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GrantsTable
     */
    public $Grants;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.grants',
        'app.issuers',
        'app.companies',
        'app.companies_grants'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Grants') ? [] : ['className' => GrantsTable::class];
        $this->Grants = TableRegistry::getTableLocator()->get('Grants', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Grants);

        parent::tearDown();
    }


}
