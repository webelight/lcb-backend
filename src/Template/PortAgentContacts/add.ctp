<div class="actions columns large-2 medium-3">
	<h3><?= __('Actions') ?></h3>
	<ul class="side-nav">
		<li><?= $this->Html->link(__('List Port Agent Contacts'), ['action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('List Creators'), ['controller' => 'Creators', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Creator'), ['controller' => 'Creators', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List Modifiers'), ['controller' => 'Modifiers', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Modifier'), ['controller' => 'Modifiers', 'action' => 'add']) ?> </li>
		<li><?= $this->Html->link(__('List PortAgents'), ['controller' => 'PortAgents', 'action' => 'index']) ?> </li>
		<li><?= $this->Html->link(__('New Port Agent'), ['controller' => 'PortAgents', 'action' => 'add']) ?> </li>
	</ul>
</div>
<div class="portAgentContacts form large-10 medium-9 columns">
<?= $this->Form->create($portAgentContact) ?>
	<fieldset>
		<legend><?= __('Add Port Agent Contact') ?></legend>
	<?php
		echo $this->Form->input('recstatus');
		echo $this->Form->input('creator_id', ['options' => $creators]);
		echo $this->Form->input('modifier_id', ['options' => $modifiers]);
		echo $this->Form->input('port_agent_id', ['options' => $portAgents]);
		echo $this->Form->input('name');
		echo $this->Form->input('number');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>
</div>
