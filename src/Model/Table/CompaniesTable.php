<?php

namespace App\Model\Table;

use App\Model\Entity\CompaniesGrant;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \App\Model\Table\GrantsTable|\Cake\ORM\Association\BelongsToMany $Grants
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null, $options = [])
 */
class CompaniesTable extends Table
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

        $this->setTable('companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Grants', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'grant_id',
            'joinTable' => 'companies_grants'
        ]);

        $this->hasMany('CompaniesGrants', [
            'foreignKey' => 'company_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }


    /**
     * Find grants with current status
     *
     * @param \Cake\ORM\Query $query
     * @param array $options
     * @return \Cake\ORM\Query
     */
    public function findCurrent(Query $query, array $options)
    {
        return $query->select([
            'Companies.id',
            'Companies.name',
            'CompaniesGrants.id',
            'CompaniesGrants.company_id',
            'CompaniesGrants.grant_id',
            'CompaniesGrants.contact',
            'CompaniesGrants.amount',
            'CompaniesGrants.deminimis',
            'Grants.id',
            'Grants.shortname',
            'Grants.name',
            'Grants.code',
            'LatestHistory.Histories__deadline',
            'Statuses.name',
            'Statuses.await',
            'Statuses.style',
            'Issuers.name'
        ])
            ->contain('Grants')
            ->contain('CompaniesGrants')
            ->innerJoin(['CompaniesGrants' => 'companies_grants'], ['Companies.id = CompaniesGrants.company_id'])
            ->innerJoin(['Grants' => 'grants'], ['Grants.id = CompaniesGrants.grant_id'])
            ->innerJoin(['Issuers' => 'issuers'],['Grants.issuer_id = Issuers.id'])
            ->innerJoin(
                ['LatestHistory' => $this->CompaniesGrants->Histories->find('latest', $options)],
                ['CompaniesGrants.id = LatestHistory.Histories__company_grant_id']
            )
            ->innerJoin(
                ['Statuses' => 'statuses'],
                ['Statuses.id = LatestHistory.Histories__status_id']
            )
            ->where(['Companies.id' => $options['id']]);
    }
}
