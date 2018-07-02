<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\DatalistBehavior;
use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\Table;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\DatalistBehavior Test Case
 */
class DatalistBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\DatalistBehavior
     */
    public $Datalist;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Datalist = new DatalistBehavior(new Table());
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Datalist);

        parent::tearDown();
    }

    /**
     * Test beforeMarshal method
     *
     * @return void
     */
    public function testBeforeMarshal()
    {
        $data = [
            'issuer_id' => 'this is a string',
            'name' => 'Name of the element',
        ];
        $data = new ArrayObject($data);
        $options = new ArrayObject(['Issuers' => 'name']);
        $this->Datalist->beforeMarshal(new Event('Model.beforeSave'), $data, $options);
        $this->assertEquals('this is a string', $data['issuer']['name']);

        $data = [
            'name' => 'Name of the element',
            'companies' => [
                '_ids' => 'New Company'
            ]
        ];
        $data = new ArrayObject($data);
        $options = new ArrayObject(['Companies' => 'name']);
        $this->Datalist->beforeMarshal(new Event('Model.beforeSave'), $data, $options);
        $this->assertEquals('New Company', $data['companies'][0]['name']);

        $data = [
            'name' => 'Name of the element',
            'issuer_id' => 'this is a string',
            'companies' => [
                '_ids' => 'New Company'
            ]
        ];
        $data = new ArrayObject($data);
        $options = new ArrayObject(['Issuers' => 'name', 'Companies' => 'name']);
        $this->Datalist->beforeMarshal(new Event('Model.beforeSave'), $data, $options);
        $this->assertEquals('this is a string', $data['issuer']['name']);
        $this->assertEquals('New Company', $data['companies'][0]['name']);
    }
}