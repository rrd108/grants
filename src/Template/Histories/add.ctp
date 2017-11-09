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
        echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
        echo $this->Form->control('event');
        echo $this->Form->control('created', ['value' => date('Y-m-d H:i:s',$time->timestamp)]);
        echo $this->Form->label(__('Has deadline:'));
        echo $this->Form->checkbox('hasdeadline', ['hiddenField' => false, 'checked' => true]);
        $displayDate = date('Y-m-d', strtotime('+8 days',$time->timestamp));
        echo $this->Form->control('deadline',['value' => $displayDate]);
        echo $this->Form->control('tags._ids', ['options' => $tags]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
