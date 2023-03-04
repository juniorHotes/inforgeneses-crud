<?php $this->layout("master") ?>

<?php 
    $user = json_decode(str_replace('&quot;', '"', $this->e(isset($user) ? $user : '')));

    $form = new \App\Libs\FormFeedback($this->e(isset($data) ? $data : ''));
?>

<div class="container col-xxl-5 col-lg-5 col-md-6">
    <div class="border mt-5 mb-5 py-4 px-5 rounded-3">
        <h3>Editar usuário</h3>
        <hr>
        <form class="pt-2 needs-validation" method="POST" action="/user/edit?action=edit_user&user=<?= $_GET['user'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control required <?= $form->is_invalid('name') ?>" name="name" id="name" value="<?= ($_SERVER['REQUEST_METHOD'] == "POST") ? $form->field_val('name') : $user->name ?>" placeholder="Ex: Jhon">
                <div class="invalid-feedback" id="name-feedback"><?= $form->field_feedback('name') ?></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control required <?= $form->is_invalid('email') ?>" name="email" id="email" value="<?= ($_SERVER['REQUEST_METHOD'] == "POST") ? $form->field_val('email') : $user->email ?>" placeholder="Ex: jhon@email.com">
                <div class="invalid-feedback" id="email-feedback"><?= $form->field_feedback('email') ?></div>
            </div>
            <hr>
            <div class="form-feedback">
                <p><?= $form->form_feedback() ?></p>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-xl btn-primary">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Salvar
                </button>
            </div>
        </form>
    </div>

    <div class="border py-4 px-5 rounded-3">
        <h3>Trocar senha</h3>
        <hr>
        <form class="pt-2 needs-validation" method="POST" action="/user/edit?action=change_pass&user=<?= $_GET['user'] ?>">
            <div class="mb-3">
                <label for="current_pass" class="form-label">Senha atual</label>
                <input type="password" class="form-control required <?= $form->is_invalid('current_pass') ?>" name="current_pass" id="current_pass" value="<?= $form->field_val('current_pass') ?>" placeholder="Senha que você usa atualmente">
                <div class="invalid-feedback" id="current_pass-feedback"><?= $form->field_feedback('current_pass') ?></div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nova senha</label>
                <input type="password" class="form-control required <?= $form->is_invalid('password') ?>" name="password" id="password" value="<?= $form->field_val('password') ?>" placeholder="Sua nova senha">
                <div class="invalid-feedback" id="password-feedback"><?= $form->field_feedback('password') ?></div>
                <?php require_once(dirname(__DIR__, 2) . '/templates/html-password-requirements.html') ?>
            </div>
            <div class="mb-3">
                <label for="conf_pass" class="form-label">Confirmar nova senha</label>
                <input type="password" class="form-control required <?= $form->is_invalid('conf_pass') ?>" name="conf_pass" id="conf_pass" value="<?= $form->field_val('conf_pass') ?>" placeholder="Confirme sua nova senha">
                <div class="invalid-feedback" id="conf_pass-feedback"><?= $form->field_feedback('conf_pass') ?></div>
            </div>
            <hr>
            <div class="form-feedback">
                <p><?= $form->form_feedback() ?></p>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-xl btn-primary">
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Salvar
                </button>
            </div>
        </form>
    </div>

    <div class="border py-4 px-3 rounded-3 mt-5">
        <div class="row justify-content-md-center">
            <p><strong>Excluír este usuário</strong></p>
            <p class="fw-lighter">Depois de excluir este usuário, não há como voltar atrás. tenha certeza. <a href="" class="link-danger" data-bs-toggle="modal" data-bs-target="#confirm-delete-user" data-bs-whatever="@mdo">Excluír conta</a></p>       
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete-user" tabindex="-1" aria-labelledby="confirm-delete-user-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirm-delete-user-label">Confirmação de exclusão de conta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="needs-validation" id="form-delete-user" action="/user/delete" method="post">
            <input type="hidden" id="confirm-text" value="<?= $user->name ?>/deletar"/>
            <input type="hidden" id="user_id" name="user_id" value="<?= $user->id ?>/deletar"/>
            <div class="modal-body">
                <div class="mb-3">
                    <p>Essa ação não pode ser desfeita. Isso excluirá permanentemente o seu usuário.</p>
                </div>
                <div class="mb-3">
                    <label for="pass" class="col-form-label">Digite <strong><?= $user->name ?>/deletar</strong> abaixo para confirmar.</label>
                    <input type="text" class="form-control required" id="delete_user" name="delete_user">
                    <div class="invalid-feedback" id="pass-feedback"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="btn-delete" class="btn btn-danger" disabled>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Excluír
                </button>
            </div>
        </form>
    </div>
  </div>
</div>

<script src="../../public/js/script.js"></script>
<script src="../../public/js/checkpw.js"></script>