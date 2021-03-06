<?php
/**
 * @var \App\View\AppView $this
 */
?>
<nav class="small-12 medium-3 large-3 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company'), ['action' => 'edit', $company->first()->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company'), ['action' => 'delete', $company->first()->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $company->first()->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grants'), ['controller' => 'Grants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grant'), ['controller' => 'Grants', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="companies view small-12 medium-9 large-9 columns content">
    <h3><?= h($company->first()->company['name']) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($company->first()->company['name']) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($company->first()->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Grants') ?></h4>
        <?php if (!empty($company->first()->grant)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"></th>
                    <th scope="col"><?= __('Issuer Name') ?></th>
                    <th scope="col"><?= __('Shortname') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Code') ?></th>
                    <th scope="col"><?= __('Status') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($company as $grants): ?>
                    <tr>
                        <td><?= $this->Html->link(
                                '<i class="fi-eye" title="' . __('View') . '"></i>',
                                ['controller' => 'Grants', 'action' => 'view', $grants->grant->id],
                                ['escape' => false]) ?></td>
                        <td><?= h($grants->grant->issuer->name) ?></td>
                        <td><?= h($grants->grant->shortname) ?></td>
                        <td><?= h($grants->grant->name) ?></td>
                        <td><?= h($grants->grant->code) ?></td>
                        <td><?= $grants->Statuses['name'] ? '<span class="label ' . h($grants->Statuses['style']) . '">' . $grants->Statuses['name'] . '</span>' : '' ?></td>
                        <td class="actions">
                            <?= $this->Html->link(
                                '<i class="fi-pencil" title="' . __('Edit') . '"></i>',
                                ['controller' => 'Grants', 'action' => 'edit', $grants->grant->id],
                                ['escape' => false]) ?>
                            <?= $this->Form->postLink(
                                '<i class="fi-x" title="' . __('Delete') . '"></i>',
                                ['controller' => 'Grants', 'action' => 'delete', $grants->grant->id],
                                [
                                    'escape' => false,
                                    'confirm' => __('Are you sure you want to delete # {0}?', $grants->grant->id)
                                ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
