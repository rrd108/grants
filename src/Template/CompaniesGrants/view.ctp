<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="small-12 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Companies Grant'), ['action' => 'edit', $companiesGrant->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Companies Grant'), ['action' => 'delete', $companiesGrant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $companiesGrant->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Companies Grants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Companies Grant'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grants'), ['controller' => 'Grants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grant'), ['controller' => 'Grants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<table class="vertical-table small-12 medium-10 large-10 columns">
    <tr>
        <th scope="row"><?= __('Company') ?></th>
        <td><?= $companiesGrant->has('company') ? $this->Html->link($companiesGrant->company->name,
                ['controller' => 'Companies', 'action' => 'view', $companiesGrant->company->id]) : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Grant') ?></th>
        <td><?= $companiesGrant->has('grant')
                ? $this->Html->link(
                    $companiesGrant->grant->shortname,
                    ['controller' => 'Grants', 'action' => 'view', $companiesGrant->grant->id]
                ) . ' ' . h($companiesGrant->grant->code)
                : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Issuer') ?></th>
        <td>
            <?= $companiesGrant->has('grant')
                ? $this->Html->link(
                    $companiesGrant->grant->issuer->name,
                    ['controller' => 'issuers', 'action' => 'view', $companiesGrant->grant->issuer->id]
                )
                : '' ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><?= __('Contact') ?></th>
        <td>
            <?= h($companiesGrant->contact) ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><?= __('Amount') ?></th>
        <td>
            <?= $this->Number->format($companiesGrant->amount) ?>
        </td>
    </tr>
    <tr>
        <th scope="row"><?= __('De minimis  ') ?></th>
        <td>
            <?= $companiesGrant->deminimis ?>
        </td>
    </tr>
</table>
<div class="companiesGrants view small-12 medium-12 large-12 columns content">
    <h3><?= __('History') ?></h3>
    <table class="stack">
        <thead>
        <tr>
            <th scope="col" style="width: 1%;"></th>
            <th scope="col" style="width: 20%;"><?= __('Created') ?></th>
            <th scope="col" style="width: 15%;"><?= __('Deadline') ?></th>
            <th scope="col" style="width: 20%;"><?= __('Status') ?></th>
            <th scope="col" style="width: 10%;"><?= __('User') ?></th>
            <th scope="col" style="width: 20%"><?= __('Event') ?></th>
            <th scope="col" style="width: 4%;" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?= $this->Form->create(null, ['url' => ['controller' => 'Histories', 'action' => 'add']]); ?>
            <?= $this->Form->hidden('company_grant_id', ['value' => $companiesGrant->id]) ?>
            <td></td>
            <td>
                <?= $this->Form->control('created', [
                    'type' => 'text',
                    'value' => $time,
                    'label' => false
                ]); ?>
            </td>
            <td>
                <?= $this->Form->control('deadline', [
                    'type' => 'text',
                    'value' => $deadlineTime,
                    'label' => false
                ]); ?>
            </td>
            <td><?= $this->Form->control(__('Status'),
                    ['empty' => true, 'options' => $statuses, 'name' => 'status_id', 'label' => false]); ?></td>
            <td>
                <?= $this->request->session()->read('Auth.User.username')?>
                <?= $this->Form->control('user_id',
                    ['value' => $this->request->session()->read('Auth.User.id'), 'type' => 'hidden']) ?>
            </td>
            </td>
            <td><?= $this->Form->control(__('Event'), ['name' => 'event','label' => false]); ?></td>
            <td><?= $this->Form->button(__('Save'), ['type' => 'submit', 'class' => 'button']) ?></td>
            <?= $this->Form->end() ?>
        </tr>
        <?php foreach ($companiesGrant->histories as $history) : ?>
            <tr>
                <td><?= $this->Html->link(
                        '<i class="fi-eye" title="' . __('View') . '"></i>',
                        ['controller' => 'Histories', 'action' => 'view', $history->id],
                        ['escape' => false]) ?></td>
                <td><?= h($history->created) ?></td>
                <td>
                    <?=
                    $history->has('deadline') ? $history->deadline : ''
                    ?>
                </td>
                <td>
                    <?= $history->has('status')
                        ? '<span class="label ' . $history->status->style . '">' . $history->status->name .
                        '</span>'
                        : ''
                    ?>
                </td>
                <td><?= $history->has('user') ? $this->Html->link($history->user->username, [
                        'controller' => 'Users',
                        'action' => 'view',
                        $history->user->id
                    ]) : '' ?></td>
                <td><?= h($history->event) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        '<i class="fi-pencil" title="' . __('Edit') . '"></i>',
                        ['controller' => 'Histories', 'action' => 'edit', $history->id],
                        ['escape' => false]) ?>
                    <?= $this->Form->postLink(
                        '<i class="fi-x" title="' . __('Delete') . '"></i>',
                        ['controller' => 'Histories', 'action' => 'delete', $history->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $history->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
