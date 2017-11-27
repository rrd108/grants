<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-12 medium-3 large-3 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Grants'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Issuers'), ['controller' => 'Issuers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Issuer'), ['controller' => 'Issuers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grants form small-12 medium-9 large-9 columns content">
    <?= $this->Form->create($grant) ?>
    <fieldset>
        <legend><?= __('Add Grant') ?></legend>
        <?php
            echo $this->Form->control('issuer_id', ['options' => $issuers, 'empty' => true]);
            echo $this->Html->link(__('New Issuer'), ['controller' => 'Issuers', 'action' => 'add']);
            echo $this->Form->control('shortname');
            echo $this->Form->control('name');
            echo $this->Form->control('code');
            echo $this->Form->control('companies._ids', ['options' => $companies]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
