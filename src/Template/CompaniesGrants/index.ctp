<?php
$this->assign('title', __('Current status of Grants'));
?>
<nav class="small-12 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Companies Grant'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grants'), ['controller' => 'Grants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grant'), ['controller' => 'Grants', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="companiesGrants index small-12 medium-10 large-10 columns content">
    <div class="row">
        <?php if ($nonFinished): ?>
            <h3 class="small-11 columns">
                <?= __('Current status') ?> » <?= __('In progress') ?>
            </h3>
            <?= $this->Html->link(
                '<i title="' . __('Show finished') . '" class="fi-lock"></i>',
                ['controller' => 'CompaniesGrants', 'action' => 'index', 0],
                ['class' => 'small-1 columns s150', 'escape' => false]) ?>
        <?php endif;
        if (!$nonFinished) : ?>
            <h3 class="small-11 columns">
                <?= __('Current status') ?> » <?= __('Finished') ?>
            </h3>
            <?= $this->Html->link(
                '<i title="' . __('Show non finished') . '" class="fi-unlock"></i>',
                ['controller' => 'CompaniesGrants', 'action' => 'index', 1],
                ['class' => 'small-1 columns s150', 'escape' => false]) ?>
        <?php endif; ?>
    </div>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"><?= $this->Paginator->sort('Companies.name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Grants.shortname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Statuses.name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('LatestHistory.Histories__deadline') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contact') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($companiesGrants as $companiesGrant): ?>
            <tr>
                <td>
                    <?= $this->Html->link(
                        ($companiesGrant->LatestHistory['Histories__deadline']
                            && $companiesGrant->LatestHistory['Histories__deadline'] <= date('Y-m-d'))
                        ? '<i class="fi-alert s150" title="' . __('Overdued') . '"></i>'
                        : '<i class="fi-eye s150" title="' . __('View') . '"></i>',
                    ['action' => 'view', $companiesGrant->id],
                    ['escape' => false]) ?>
                </td>
                <td><?= $this->Html->link($companiesGrant->company['name'], ['controller' => 'Companies', 'action' => 'view', $companiesGrant->company['id']]) ?></td>
                <td><?= $this->Html->link($companiesGrant->grant['shortname'], ['controller' => 'Grants', 'action' => 'view', $companiesGrant->grant['id']]) ?></td>
                <td><?= $this->Number->format($companiesGrant->amount) ?></td>
                <td><?= $companiesGrant['Statuses']['name']
                        ? '<span class="label '. h($companiesGrant['Statuses']['style']) . '">'
                            . h($companiesGrant['Statuses']['name'])
                            . '</span>'
                        : ''
                    ?></td>
                <td><?= ($companiesGrant->LatestHistory['Histories__deadline'])
                        ? '<span class="label '. h($companiesGrant['Statuses']['style']) . '">'
                        . h($companiesGrant->LatestHistory['Histories__deadline'])
                        . '</span>'
                        : ''
                    ?></td>
                <td><?= $this->Text->autoLink($companiesGrant->contact) ?></td>
                <td class="actions align-center">
                    <?= $this->Html->link('<i class="fi-pencil" title="' . __('Edit') . '"></i>', ['action' => 'edit', $companiesGrant->id], ['escape' => false]) ?>
                    <?= $this->Form->postLink('<i class="fi-x" title="' . __('Delete') . '"></i>', ['action' => 'delete', $companiesGrant->id],
                        ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?',
                            $companiesGrant->id)]) ?>
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
