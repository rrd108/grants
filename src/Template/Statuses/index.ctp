<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-12 medium-3 large-3 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="statuses index small-12 medium-9 large-9 columns content">
    <h3><?= __('Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('style') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statuses as $status): ?>
            <tr>
                <td><?= $this->Html->link(
                    '<i class="fi-eye" title="' . __('View') . '"></i>',
                    ['action' => 'view', $status->id],
                    ['escape' => false]) ?></td>
                <td><?= h($status->name) ?></td>
                <td><?= h($status->style) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        '<i class="fi-pencil" title="' . __('Edit') . '"></i>',
                        ['action' => 'edit', $status->id],
                        ['escape' => false]) ?>
                    <?= $this->Form->postLink(
                        '<i class="fi-x" title="' . __('Delete') . '"></i>',
                        ['action' => 'delete', $status->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $status->id)]) ?>
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
