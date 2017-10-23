<?php
$this->assign('title', __('Current status of Grants'));
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Companies Grant'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grants'), ['controller' => 'Grants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grant'), ['controller' => 'Grants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companiesGrants index small-9 medium-10 large-10 columns content">
    <h3><?= __('Current status') ?></h3>
    <h4>Show Standby</h4>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= __('Current Status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contact') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companiesGrants as $companiesGrant): ?>
            <tr>
                <td><?= $this->Html->link(
                    '<i class="fi-eye" title="' . __('View') . '"></i>',
                    ['action' => 'view', $companiesGrant->id],
                    ['escape' => false]) ?></td>
                <td><?= $companiesGrant->has('company') ? $this->Html->link($companiesGrant->company->name, ['controller' => 'Companies', 'action' => 'view', $companiesGrant->company->id]) : '' ?></td>
                <td><?= $companiesGrant->has('grant') ? $this->Html->link($companiesGrant->grant->shortname, ['controller' => 'Grants', 'action' => 'view', $companiesGrant->grant->id]) : '' ?></td>
                <td><?= $this->Number->format($companiesGrant->amount) ?></td>
                <td><?= $companiesGrant->has('histories')
                        ? '<span class="label '. h($companiesGrant->histories[0]['status']['style']) . '">'
                            . h($companiesGrant->histories[0]['status']['name'])
                            . '</span>'
                        : ''
                    ?></td>
                <td><?= $this->Text->autoLink($companiesGrant->contact) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-pencil" title="' . __('Edit') . '"></i>', ['action' => 'edit', $companiesGrant->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fi-x" title="' . __('Delete') . '"></i>', ['action' => 'delete', $companiesGrant->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?',
                            $companiesGrant->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination text-center">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
