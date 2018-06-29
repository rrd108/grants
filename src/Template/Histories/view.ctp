<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-12 medium-3 large-3 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit History'), ['action' => 'edit', $history->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete History'), ['action' => 'delete', $history->id], ['confirm' => __('Are you sure you want to delete # {0}?', $history->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies Grants'), ['controller' => 'CompaniesGrants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Companies Grant'), ['controller' => 'CompaniesGrants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="histories view small-12 medium-9 large-9 columns content">
    <h3><?= h($history->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Companies Grant') ?></th>
            <td><?= $history->has('companies_grant') ? $this->Html->link($history->companies_grant->id, ['controller' => 'CompaniesGrants', 'action' => 'view', $history->companies_grant->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $history->has('status') ? $this->Html->link($history->status->name, ['controller' => 'Statuses', 'action' => 'view', $history->status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $history->has('user') ? $this->Html->link($history->user->id, ['controller' => 'Users', 'action' => 'view', $history->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event') ?></th>
            <td><?= h($history->event) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($history->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($history->created) ?></td>
        </tr>
    </table>
</div>
