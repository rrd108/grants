<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * History Entity
 *
 * @property int $id
 * @property int $company_grant_id
 * @property int $status_id
 * @property string $user_id
 * @property string $event
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\CompaniesGrant $companies_grant
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\User $user
 */
class History extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
