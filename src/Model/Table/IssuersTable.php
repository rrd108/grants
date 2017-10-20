<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Issuers Model
 *
 * @property \App\Model\Table\GrantsTable|\Cake\ORM\Association\HasMany $Grants
 *
 * @method \App\Model\Entity\Issuer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Issuer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Issuer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Issuer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Issuer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Issuer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Issuer findOrCreate($search, callable $callback = null, $options = [])
 */
class IssuersTable extends Table
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

        $this->setTable('issuers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Grants', [
            'foreignKey' => 'issuer_id'
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
}
