<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Status'), ['action' => 'edit', $status->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Status'), ['action' => 'delete', $status->id], ['confirm' => __('Are you sure you want to delete # {0}?', $status->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="statuses view small-9 medium-10 large-10 columns content">
    <h3><?= h($status->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($status->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($status->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Histories') ?></h4>
        <?php if (!empty($status->histories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Company Grant Id') ?></th>
                <th scope="col"><?= __('Status Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Event') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($status->histories as $histories): ?>
            <tr>
                <td><?= h($histories->id) ?></td>
                <td><?= h($histories->company_grant_id) ?></td>
                <td><?= h($histories->status_id) ?></td>
                <td><?= h($histories->user_id) ?></td>
                <td><?= h($histories->event) ?></td>
                <td><?= h($histories->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Histories', 'action' => 'view', $histories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Histories', 'action' => 'edit', $histories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Histories', 'action' => 'delete', $histories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $histories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
