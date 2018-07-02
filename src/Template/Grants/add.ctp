<?php
$this->assign('title', __('New Grant'));
?>
<div class="grants form small-12 columns content">
    <?= $this->Form->create($grant) ?>
    <fieldset>
        <legend><?= __('Add Grant') ?></legend>
        <?php
            echo $this->Form->control(
                'issuer_id',
                ['type' => 'datalist', 'options' => $issuers->order('Issuers.name')]
            );
            echo $this->Form->control('shortname');
            echo $this->Form->control('name');
            echo $this->Form->control('code');
            echo $this->Form->control(
                'companies._ids',
                ['type' => 'datalist', 'options' => $companies->order('Companies.name')]
            );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'button']) ?>
    <?= $this->Form->end() ?>
</div>
