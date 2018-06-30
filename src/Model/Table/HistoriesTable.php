<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\Database\Expression\IdentifierExpression;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Histories Model
 *
 * @property \App\Model\Table\CompaniesGrantsTable|\Cake\ORM\Association\BelongsTo $CompaniesGrants
 * @property \App\Model\Table\StatusesTable|\Cake\ORM\Association\BelongsTo $Statuses
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\History get($primaryKey, $options = [])
 * @method \App\Model\Entity\History newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\History[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\History|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\History patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\History[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\History findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HistoriesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('histories');
        $this->setDisplayField('event');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CompaniesGrants', [
            'foreignKey' => 'company_grant_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DonebyUsers', [
            'className' => 'Users',
            'foreignKey' => 'doneby',
            'joinType' => 'LEFT'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('event');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['company_grant_id'], 'CompaniesGrants'));
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    /**
     * Find latest histories
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     * @return \Cake\ORM\Query
     */
    public function findLatest(Query $query, array $options)
    {
        return $query->innerJoin(
            [
                'latest' => $query->getConnection()->newQuery()
                    ->select(
                        [
                            'cg_id' => 'Histories.company_grant_id',
                            'latest' => $query->func()->max('Histories.created')

                        ]
                    )
                    ->from(['Histories' => 'histories'])
                    ->group('Histories.company_grant_id')
            ],
            [
                $this->getAlias() . '.company_grant_id' => new IdentifierExpression('latest.cg_id'),
                $this->getAlias() . '.created' => new IdentifierExpression('latest.latest')
            ]
        );
    }

    /**
     * Find histories with deadline what are not finished yet
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     * @return \Cake\ORM\Query
     */
    public function findInProgress(Query $query, array $options)
    {
        return $query->where(
            [
                'deadline IS NOT' => null,
                'done IS' => NULL
            ]
        );
    }
}
