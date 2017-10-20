<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Issuer'), ['action' => 'edit', $issuer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Issuer'), ['action' => 'delete', $issuer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $issuer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Issuers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Issuer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grants'), ['controller' => 'Grants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grant'), ['controller' => 'Grants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="issuers view small-9 medium-10 large-10 columns content">
    <h3><?= h($issuer->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($issuer->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($issuer->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Grants') ?></h4>
        <?php if (!empty($issuer->grants)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Issuer Id') ?></th>
                <th scope="col"><?= __('Shortname') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($issuer->grants as $grants): ?>
            <tr>
                <td><?= h($grants->id) ?></td>
                <td><?= h($grants->issuer_id) ?></td>
                <td><?= h($grants->shortname) ?></td>
                <td><?= h($grants->name) ?></td>
                <td><?= h($grants->code) ?></td>
                <td class="actions">
                    <?= $this->Html->link('<i class="fi-eye" title="' . __('View') . '"></i>', ['controller' => 'Grants', 'action' => 'view', $grants->id], ['escape' => false]) ?>
                    <?= $this->Html->link('<i class="fi-pencil" title="' . __('Edit') . '"></i>', ['controller' => 'Grants', 'action' => 'edit', $grants->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fi-x" title="' . __('Delete') . '"></i>', ['controller' => 'Grants', 'action' => 'delete', $grants->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $grants->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
