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
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="histories form small-12 medium-9 large-9 columns content">
    <?= $this->Form->create($history) ?>
    <fieldset>
        <legend><?= __('Add History') ?></legend>
        <?php
        echo $this->Form->control('company_grant_id', ['options' => $companiesGrants, 'empty' => true]);
        echo $this->Form->control('status_id', ['options' => $statuses, 'empty' => true]);
        echo $this->Form->control('user_id', ['options' => $users]);
        echo $this->Form->control('event');
        echo $this->Form->label(__('Created'));
        echo $this->Form->datetime('created', [
            'minYear' => date('Y') - 2,
            'maxYear' => date('Y') + 2,
            'empty' => [
                'year' => __('Choose year...'),
                'month' => __('Choose month...'),
                'day' => __('Choose day...'),
                'hour' => __('Choose hour...'),
                'minute' => __('Choose minute...')
            ]
        ]);
        echo $this->Form->label(__('Has deadline:'));
        echo $this->Form->checkbox('hasdeadline', ['hiddenField' => false, 'checked' => true]);
        echo $this->Form->control('deadline');
        echo $this->Form->control('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
