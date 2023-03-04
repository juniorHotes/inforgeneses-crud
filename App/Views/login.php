<?php $this->layout("master") ?>

<?php $form = new \App\Libs\FormFeedback($this->e(isset($data) ? $data : '')) ?>

<div class="container col-xxl-5 col-lg-5 col-md-6 border py-4 px-5 rounded-3">
    <h3>Entre com seu usuário</h3>
    <hr>
    <form class="pt-2 needs-validation" method="POST" action="/login">
      <div class="mb-3">
        <label for="login" class="form-label">E-mail ou usuário</label>
        <input type="text" class="form-control required <?= $form->is_invalid('login') ?>" name="login" id="login" value="<?= $form->field_val('login') ?>">
        <div class="invalid-feedback" id="login-feedback"><?= $form->field_feedback('login') ?></div>
      </div>
      <div class="mb-3">
        <label for="pass" class="form-label">Senha</label>
        <input type="password" class="form-control required <?= $form->is_invalid('pass') ?>" name="pass" id="pass" value="<?= $form->field_val('pass') ?>">
        <div class="invalid-feedback" id="pass-feedback"><?= $form->field_feedback('pass') ?></div>
      </div>
      <hr>
      <div class="d-grid gap-2">
          <button type="submit" class="btn btn-xl btn-primary">
            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            Entrar
          </button>
      </div>
    </form>
</div>

<script src="../../public/js/script.js"></script>