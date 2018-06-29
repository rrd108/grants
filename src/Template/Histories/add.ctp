<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="small-12 medium-3 large-3 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Histories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies Grants'),
                ['controller' => 'CompaniesGrants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Companies Grant'),
                ['controller' => 'CompaniesGrants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="histories form small-12 medium-9 large-9 columns content">
    <?= $this->Form->create($history) ?>
    <fieldset>
        <legend><?= __('Add History') ?></legend>
        <?= $this->Form->control('company_grant_id', ['options' => $companiesGrants, 'empty' => true]) ?>
        <?= $this->Form->control('status_id', ['options' => $statuses, 'empty' => true]) ?>
        <?= $this->Form->label(__('User')) ?>
        <?= $this->request->session()->read('Auth.User.username')?>
        <?= $this->Form->control('user_id',
            ['value' => $this->request->session()->read('Auth.User.id'), 'type' => 'hidden']) ?>
        <?= $this->Form->control('event') ?>
        <?= $this->Form->control('created', ['type' => 'text', 'value' => $time]) ?>
        <?= $this->Form->control('deadline',['type' => 'text', 'value' => $deadlinetime]) ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
