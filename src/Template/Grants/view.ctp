<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-12 medium-3 large-3 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Grant'), ['action' => 'edit', $grant->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Grant'), ['action' => 'delete', $grant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $grant->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Grants'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grant'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Issuers'), ['controller' => 'Issuers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Issuer'), ['controller' => 'Issuers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="grants view small-12 medium-9 large-9 columns content">
    <h3><?= h($grant->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Issuer') ?></th>
            <td><?= $grant->has('issuer') ? $this->Html->link($grant->issuer->name, ['controller' => 'Issuers', 'action' => 'view', $grant->issuer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Shortname') ?></th>
            <td><?= h($grant->shortname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($grant->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($grant->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($grant->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Companies') ?></h4>
        <?php if (!empty($grant->companies)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($grant->companies as $companies): ?>
            <tr>
                <td><?= $this->Html->link(
                        '<i class="fi-eye" title="' . __('View') . '"></i>',
                        ['controller' => 'Companies', 'action' => 'view', $companies->id],
                        ['escape' => false]) ?></td>
                <td><?= h($companies->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        '<i class="fi-pencil" title="' . __('Edit') . '"></i>',
                        ['controller' => 'Companies', 'action' => 'edit', $companies->id],
                        ['escape' => false]) ?>
                    <?= $this->Form->postLink(
                        '<i class="fi-x" title="' . __('Delete') . '"></i>',
                        ['controller' => 'Companies', 'action' => 'delete', $companies->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $companies->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
