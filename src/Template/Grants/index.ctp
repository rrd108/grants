<?php
$this->assign('title', __('Grants'));
?>

<div class="grants index small-12 columns content">
    <div class="row">
        <h3 class="small-6"><?= __('Grants') ?></h3>
        <?= $this->Html->link(
            '<i class="fi-plus"></i>',
            ['controller' => 'grants', 'action' => 'add'],
            [
                'escape' => false,
                'class' => 'small-6 s150 text-right',
                'title' => __('New Grant')
            ]) ?>
    </div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"><?= $this->Paginator->sort('issuer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shortname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grants as $grant): ?>
            <tr>
                <td><?= $this->Html->link(
                        '<i class="fi-eye" title="' . __('View') . '"></i>',
                        ['action' => 'view', $grant->id],
                        ['escape' => false]) ?></td>
                <td><?= $grant->has('issuer') ? $this->Html->link($grant->issuer->name, ['controller' => 'Issuers', 'action' => 'view', $grant->issuer->id]) : '' ?></td>
                <td><?= h($grant->shortname) ?></td>
                <td><?= h($grant->name) ?></td>
                <td><?= h($grant->code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(
                        '<i class="fi-pencil" title="' . __('Edit') . '"></i>',
                        ['action' => 'edit', $grant->id],
                        ['escape' => false]) ?>
                    <?= $this->Form->postLink(
                        '<i class="fi-x" title="' . __('Delete') . '"></i>',
                        ['action' => 'delete', $grant->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $grant->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination text-center">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
