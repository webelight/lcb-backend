<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
	</ul>
</div>
<div class="users index large-10 medium-9 columns">
	<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th><?= $this->Paginator->sort('id') ?></th>
			<th><?= $this->Paginator->sort('recstatus') ?></th>
			<th><?= $this->Paginator->sort('creator_id') ?></th>
			<th><?= $this->Paginator->sort('created') ?></th>
			<th><?= $this->Paginator->sort('modifier_id') ?></th>
			<th><?= $this->Paginator->sort('modified') ?></th>
			<th><?= $this->Paginator->sort('username') ?></th>
			<th class="actions"><?= __('Actions') ?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
		<tr>
			<td><?= $this->Number->format($user->id) ?></td>
			<td><?= h($user->recstatus) ?></td>
			<td><?= $this->Number->format($user->creator_id) ?></td>
			<td><?= h($user->created) ?></td>
			<td><?= $this->Number->format($user->modifier_id) ?></td>
			<td><?= h($user->modified) ?></td>
			<td><?= h($user->username) ?></td>
			<td class="actions">
				<?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
				<?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
				<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="paginator">
		<ul class="pagination">
		<?php
			echo $this->Paginator->prev('< ' . __('previous'));
			echo $this->Paginator->numbers();
			echo $this->Paginator->next(__('next') . ' >');
		?>
		</ul>
		<p><?= $this->Paginator->counter() ?></p>
	</div>
</div>
