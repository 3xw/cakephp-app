<?php
use Cake\Core\Configure;
?>
<section class="section--default">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-md-8 col-sm-10 mx-auto col-lg-6">
        <?= $this->Flash->render() ?>
        <?= $this->Flash->render('auth') ?>
        <div class="utils--spacer-default"></div>
        <h2 class="mb-0"><?=  __('Mot de passe oublié') ?></h2>
        <p class="small">
          &nbsp;<?= __('Si vous n\'avez pas encore de compte, ').$this->Html->link(__('inscrivez-vous'), ['action' => 'register']) ?>.
        </p>
        <div class="utils--spacer-mini"></div>
        <?= $this->Form->create(null) ?>
        <?= $this->Form->controll('reference', ['required' => true,'class' => 'form-control', 'label' => false]) ?>
        <div class="utils--spacer-semi"></div>
        <button type="submit" class="btn btn--red btn--line btn--radius color--red"><?= __('Envoyer') ?></button>
        <?= $this->Form->end() ?>
        <div class="utils--spacer-mini"></div>
        <?= $this->Html->link(__('retour au login'), ['action' => 'request_reset_password'],['class' => 'small']); ?>
        <div class="utils--spacer-double"></div>
      </div>
    </div>
  </div>
</section>
