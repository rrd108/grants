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
                ['action' => 'delete', $grant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $grant->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Grants'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Issuers'), ['controller' => 'Issuers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Issuer'), ['controller' => 'Issuers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grants form small-9 medium-10 large-10 columns content">
    <?= $this->Form->create($grant) ?>
    <fieldset>
        <legend><?= __('Edit Grant') ?></legend>
        <?php
            echo $this->Form->control('issuer_id', ['options' => $issuers]);
            echo $this->Form->control('shortname');
            echo $this->Form->control('name');
            echo $this->Form->control('code');
            echo $this->Form->control('companies._ids', ['options' => $companies]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
