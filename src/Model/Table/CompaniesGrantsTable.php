<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CompaniesGrants Model
 *
 * @property \App\Model\Table\CompaniesTable|\Cake\ORM\Association\BelongsTo $Companies
 * @property \App\Model\Table\GrantsTable|\Cake\ORM\Association\BelongsTo $Grants
 *
 * @method \App\Model\Entity\CompaniesGrant get($primaryKey, $options = [])
 * @method \App\Model\Entity\CompaniesGrant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CompaniesGrant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CompaniesGrant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CompaniesGrant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CompaniesGrant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CompaniesGrant findOrCreate($search, callable $callback = null, $options = [])
 */
class CompaniesGrantsTable extends Table
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

        $this->setTable('companies_grants');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Grants', [
            'foreignKey' => 'grant_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Histories', [
            'foreignKey' => 'company_grant_id',
            'sort' => 'Histories.created DESC'
        ]);
        $this->hasMany('LatestHistory', [
            'className' => 'Histories',
            'foreignKey' => 'company_grant_id',
            'strategy' => 'subquery',
            'finder' => 'latest',
            'limit' => 1,   //symulates a hasOne
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
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->existsIn(['grant_id'], 'Grants'));

        return $rules;
    }

    /**
     *
     * Find grants where the last status is awaiting
     *
     * @param \Cake\ORM\Query $query
     * @param array           $options
     * @return \Cake\ORM\Query
     */
    public function findAwait(Query $query, array  $options)
    {
        return $query->contain(
            [
                'LatestHistory'=> [
                    'Statuses' => function ($q) use ($options) {
                        return $q->find('await', $options);
                    }
                ]
            ]
        )->reject(function ($row) { //TODO refactor
            return empty($row->latest_history);
        });
    }
}
