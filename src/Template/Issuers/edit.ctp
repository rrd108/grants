<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $issuer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $issuer->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Issuers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Grants'), ['controller' => 'Grants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grant'), ['controller' => 'Grants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="issuers form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($issuer) ?>
    <fieldset>
        <legend><?= __('Edit Issuer') ?></legend>
        <?php
            echo $this->Form->control('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
