<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-12 medium-3 large-3 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $companiesGrant->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $companiesGrant->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Companies Grants'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grants'), ['controller' => 'Grants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grant'), ['controller' => 'Grants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companiesGrants form small-12 medium-9 large-9 columns content">
    <?= $this->Form->create($companiesGrant) ?>
    <fieldset>
        <legend><?= __('Edit Companies Grant') ?></legend>
        <?php
            echo $this->Form->control('company_id', ['options' => $companies]);
            echo $this->Form->control('grant_id', ['options' => $grants]);
            echo $this->Form->control('contact');
            echo $this->Form->control('amount');
            echo $this->Form->control('deminimis');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
