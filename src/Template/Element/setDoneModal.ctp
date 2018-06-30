<?= $this->Html->script('grants.histories.setdone.min', ['block' => true]) ?>

<div class="reveal" id="setDoneModal" data-reveal>
    <h1><?= __('Set this todo as done?') ?></h1>
    <p class="lead">Did you finished this todo item?</p>
    <p class="callout warning" id="eventinfo"></p>
    <?= $this->Form->create(
        null,
        [
            'url' => ['controller' => 'Histories', 'action' => 'setDone'],
            'id' => 'setDoneForm'
        ]) ?>
    <?= $this->Form->control('done', ['label' => __('Done at'), 'type' => 'text']) ?>
    <?= $this->Form->button(__('Yes'), ['class' => 'button success']) ?>
    <?= $this->Form->button(__('No'), ['class' => 'button alert']) ?>
    <?= $this->Form->end() ?>
    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
