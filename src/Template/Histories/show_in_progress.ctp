<?php
use Cake\I18n\Date;

$this->assign('title', __('Todos'));
?>
<div class="histories index small-12 columns content">
    <h3><?= __('Todos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th></th>
                <th scope="col"><?= $this->Paginator->sort('deadline', __('Overdue')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_grant_id', __('Grant')) ?></th>
                <th scope="col"><?= $this->Paginator->sort('deadline') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('event') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($histories as $history): ?>
            <tr>
                <td>
                    <?php
                    $dateDiff = (new Date())->diff($history->deadline);
                    ?>
                    <i class="<?= $dateDiff->invert ? 'fi-alert s150' : 'fi-clock' ?>"
                       id="h_<?= $history->id ?>"
                    ></i>
                </td>
                <td><em><?= __('{0} days', $dateDiff->days) ?></em></td>
                <td><?= $history->has('companies_grant')
                        ? $this->Html->link(
                            $history->companies_grant->company->name . ' - ' . $history->companies_grant->grant->shortname,
                            ['controller' => 'CompaniesGrants', 'action' => 'view', $history->companies_grant->id]
                        )
                        : '' ?></td>
                <td>
                    <?php
                    echo h($history->deadline);
                    ?>
                </td>
                <td class="status">
                    <span class="label <?= $history->status->style ?>">
                        <?= $history->status->name ?>
                    </span>
                </td>
                <td>
                    <?= $this->Html->link(
                        $history->user->username,
                        ['controller' => 'Users', 'action' => 'view', $history->user->id]
                    ) ?>
                </td>
                <td class="event"><?= h($history->event) ?></td>
                <td><?= h($history->created) ?></td>
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

<?php echo $this->element('setDoneModal'); ?>
