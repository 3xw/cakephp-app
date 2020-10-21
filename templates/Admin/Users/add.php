<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?= $this->Html->link('<i class="material-icons">list</i> '.__('List'),['action'=>'index'], ['class' => '','escape'=>false]) ?>
      </li>
    </ul>
  </div>
</nav>
<div class="utils--spacer-semi"></div>
<div class="row no-gutters">
  <div class="col-11 mx-auto">
    <div class="card">
      <?= $this->Form->create($user) ?>
      <?php $this->Form->setTemplates(['dateWidget' => "{{day}}{{month}}{{year}}{{hour}}{{minute}}"]);?>
      <div class="card-header">
        <h2><?= __('Add User') ?></h2>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-sm-2">
            <?= $this->Form->control('active', ['class'=>'form-control']);?>
          </div>
          <div class="col-sm-5">
            <?= $this->Form->control('role',['options'=> ['doctor'=>'doctor','caregiver'=>'caregiver','teacher'=>'teacher','admin'=>'admin'],'class'=>'form-control']);?>
          </div>
          <div class="col-sm-5">
            <?= $this->Form->control('email',['class'=>'form-control']);?>
          </div>

          <div class="col-sm-2">
            <?= $this->Form->control('title',['options'=> ['Mme.'=>'Mme.','M.'=>'M.','Dr.'=>'Dr.','Pr.'=>'Pr.'],'class'=>'form-control']);?>
          </div>
          <div class="col-sm-5">
            <?= $this->Form->control('last_name',['class'=>'form-control']);?>
          </div>
          <div class="col-sm-5">
            <?= $this->Form->control('first_name',['class'=>'form-control']);?>
          </div>
          <div class="col-sm-5">
            <?= $this->Form->control('hospital',['class'=>'form-control', 'required' => 'required']);?>
          </div>
          <div class="col-sm-5">
            <?= $this->Form->control('service',['class'=>'form-control', 'required' => 'required']);?>
          </div>
          <div class="col-sm-5">
            <?= $this->Form->control('country',['class'=>'form-control', 'required' => 'required']);?>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-sm-6">
            <?= $this->Form->control('licences._ids',['class'=>'form-control']);?>
          </div>
          <div class="col-sm-6">
            <?= $this->Form->control('lessons._ids',['class'=>'form-control']);?>
          </div>
        </div>

      </div>
      <div class="card-footer">
        <div class="text-right">
          <div class="btn-group">
            <?= $this->Html->link(__('Cancel'), $referer, ['class' => 'btn btn-danger btn-fill']) ?>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-info btn-fill']) ?>
          </div>
        </div>
      </div>
      <?= $this->Form->end() ?>
  </div>
</div>
</div>
<div class="utils--spacer-default"></div>
