<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="small-3 medium-2 large-2 columns" id="actions-sidebar">
    <ul class="menu vertical">
        <li class="menu-text"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies Grants'), ['controller' => 'CompaniesGrants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Companies Grant'), ['controller' => 'CompaniesGrants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Statuses'), ['controller' => 'Statuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Statuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="histories index small-9 medium-10 large-10 columns content">
    <h3><?= __('Histories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('company_grant_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event') ?></th>
                <th scope="col"><?= __('Tags') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($histories as $history): ?>
            <tr>
                <td><?= $history->has('companies_grant')
                        ? $this->Html->link(
                            $history->companies_grant->company->name . ' - ' . $history->companies_grant->grant->shortname,
                            ['controller' => 'CompaniesGrants', 'action' => 'view', $history->companies_grant->id]
                        )
                        : '' ?></td>
                <td>
                    <?= $history->has('status')
                        ? '<span class="label ' . $history->status->style . '">' . $history->status->name .
                    '</span>'
                        : ''
                    ?>
                </td>
                <td><?= $history->has('user') ? $this->Html->link($history->user->username, ['controller' => 'Users',
                        'action' => 'view', $history->user->id]) : '' ?></td>
                <td><?= h($history->event) ?></td>
                <td>
                    <?php
                    if ($history->has('tags')) :
                        foreach ($history->tags as $tag) :
                            ?>
                            <span><?= $tag->name ?></span>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </td>
                <td><?= h($history->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $history->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $history->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $history->id], ['confirm' => __('Are you sure you want to delete # {0}?', $history->id)]) ?>
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
