<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Grants Model
 *
 * @property \App\Model\Table\IssuersTable|\Cake\ORM\Association\BelongsTo $Issuers
 * @property \App\Model\Table\CompaniesTable|\Cake\ORM\Association\BelongsToMany $Companies
 *
 * @method \App\Model\Entity\Grant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Grant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Grant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Grant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Grant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Grant findOrCreate($search, callable $callback = null, $options = [])
 */
class GrantsTable extends Table
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

        $this->setTable('grants');
        $this->setDisplayField('shortname');
        $this->setPrimaryKey('id');

        $this->belongsTo('Issuers', [
            'foreignKey' => 'issuer_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsToMany('Companies', [
            'foreignKey' => 'grant_id',
            'targetForeignKey' => 'company_id',
            'joinTable' => 'companies_grants'
        ]);
        $this->hasMany('CompaniesGrants', [
            'foreignKey' => 'grant_id'
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
            ->requirePresence('shortname', 'create')
            ->notEmpty('shortname');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('code', 'create')
            ->notEmpty('code');

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
        $rules->add($rules->existsIn(['issuer_id'], 'Issuers'));

        return $rules;
    }
}
