<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Histories'), ['controller' => 'Histories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New History'), ['controller' => 'Histories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tags form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($tag) ?>
    <fieldset>
        <legend><?= __('Add Tag') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('histories._ids', ['options' => $histories]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
