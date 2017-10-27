<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HistoriesFixture
 *
 */
class HistoriesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 8, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'company_grant_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'status_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'uuid', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'event' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_histories_companies_grants1_idx' => ['type' => 'index', 'columns' => ['company_grant_id'], 'length' => []],
            'fk_histories_statuses1_idx' => ['type' => 'index', 'columns' => ['status_id'], 'length' => []],
            'fk_histories_users1_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_histories_companies_grants1' => ['type' => 'foreign', 'columns' => ['company_grant_id'], 'references' => ['companies_grants', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_histories_statuses1' => ['type' => 'foreign', 'columns' => ['status_id'], 'references' => ['statuses', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_histories_users1' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'company_grant_id' => 1,
            'status_id' => 1,
            'user_id' => '3b72c8fc-06f0-42b2-b8e1-5a1efaf98062',
            'event' => '',
            'created' => '2017-10-01 12:00:00'
        ],
        [
            'id' => 2,
            'company_grant_id' => 1,
            'status_id' => 1,
            'user_id' => '3b72c8fc-06f0-42b2-b8e1-5a1efaf98062',
            'event' => '',
            'created' => '2017-10-20 15:00:00'
        ],
        [
            'id' => 3,
            'company_grant_id' => 2,
            'status_id' => 2,
            'user_id' => '3b72c8fc-06f0-42b2-b8e1-5a1efaf98062',
            'event' => '',
            'created' => '2017-10-15 11:00:00'
        ],
    ];
}
