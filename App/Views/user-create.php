<?php $this->layout("master") ?>

<?php $form = new \App\Libs\FormFeedback($this->e(isset($data) ? $data : '')) ?>

<div class="container col-xxl-5 col-lg-5 col-md-6 border py-4 px-5 rounded-3">
    <h3>Cadastre-se</h3>
    <hr>
    <form class="pt-2 needs-validation" method="POST" action="/user/create">
        <div class="mb-3">
            <label for="user_name" class="form-label">Nome</label>
            <input type="text" class="form-control required <?= $form->is_invalid('user_name') ?>" name="user_name" id="user_name" value="<?= $form->field_val('user_name') ?>" placeholder="Ex: Jhon">
            <div class="invalid-feedback" id="user_name-feedback"><?= $form->field_feedback('user_name') ?></div>
        </div>
        <div class="mb-3">
            <label for="user_email" class="form-label">E-mail</label>
            <input type="email" class="form-control required <?= $form->is_invalid('user_email') ?>" name="user_email" id="user_email" value="<?= $form->field_val('user_email') ?>" placeholder="Ex: jhon@email.com">
            <div class="invalid-feedback" id="user_email-feedback"><?= $form->field_feedback('user_email') ?></div>
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Senha</label>
            <input type="password" class="form-control required <?= $form->is_invalid('password') ?>" name="password" id="password" value="<?= $form->field_val('password') ?>" placeholder="Sua senha">
            <div class="invalid-feedback" id="password-feedback"><?= $form->field_feedback('password') ?></div>
            <?php require_once(dirname(__DIR__, 2) . '/templates/html-password-requirements.html') ?>
        </div>
        <div class="mb-3">
            <label for="compare_pass" class="form-label">Confirmar senha</label>
            <input type="password" class="form-control required <?= $form->is_invalid('compare_pass') ?>" name="compare_pass" id="compare_pass" value="<?= $form->field_val('compare_pass') ?>" placeholder="Confirme sua senha">
            <div class="invalid-feedback" id="compare_pass-feedback"><?= $form->field_feedback('compare_pass') ?></div>
        </div>
        <hr>
        <div class="form-feedback">
            <p><?= $form->form_feedback() ?></p>
        </div>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-xl btn-primary">
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Cadastrar
            </button>
        </div>
    </form>
</div>

<script src="../../public/js/script.js"></script>
<script src="../../public/js/checkpw.js"></script>