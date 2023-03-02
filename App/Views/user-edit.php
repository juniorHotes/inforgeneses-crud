<?php $this->layout("master") ?>

<div class="container col-xxl-5 col-lg-5 col-md-6">
    <div class="border mt-5 mb-5 py-4 px-5 rounded-3">
        <h3>Editar usuário</h3>
        <hr>
        <form class="pt-2 needs-validation" method="POST" action="/user/create">
            <div class="mb-3">
                <label for="user_name" class="form-label">Nome</label>
                <input type="text" class="form-control required" name="user_name" id="user_name" placeholder="Ex: Jhon">
                <div class="invalid-feedback" id="user_name-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="user_email" class="form-label">E-mail</label>
                <input type="email" class="form-control required" name="user_email" id="user_email" placeholder="Ex: jhon@email.com">
                <div class="invalid-feedback" id="user_email-feedback"></div>
            </div>
            <hr>
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
        <form class="pt-2 needs-validation" method="POST" action="/user/create">
            <div class="mb-3">
                <label for="current_pass" class="form-label">Senha atual</label>
                <input type="password" class="form-control required" name="current_pass" id="current_pass" placeholder="Senha que você usa atualmente">
                <div class="invalid-feedback" id="current_pass-feedback"></div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nova senha</label>
                <input type="password" class="form-control required" name="password" id="password" placeholder="Sua nova senha">
                <div class="invalid-feedback" id="password-feedback"></div>
                <ul class="lead list-group mt-2" id="requirements">
                    <li id="length" class="list-group-item py-1 fs-6">Pelo menos 8 caracteres</li>
                    <li id="lowercase" class="list-group-item py-1 fs-6">Pelo menos 1 letra minúscula</li>
                    <li id="uppercase" class="list-group-item py-1 fs-6">Pelo menos 1 letra maiúscula</li>
                    <li id="number" class="list-group-item py-1 fs-6">Pelo menos 1 número numérico</li>
                    <li id="special" class="list-group-item py-1 fs-6">Pelo menos 1 caractere especial</li>
                </ul>
            </div>
            <div class="mb-3">
                <label for="conf_pass" class="form-label">Confirmar nova senha</label>
                <input type="password" class="form-control required" name="conf_pass" id="conf_pass" placeholder="Confirme sua nova senha">
                <div class="invalid-feedback" id="conf_pass-feedback"></div>
            </div>
            <hr>
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
        <form class="needs-validation" action="/user/delete" method="post">
            <div class="modal-body">
                <div class="mb-3">
                    <p>Essa ação não pode ser desfeita. Isso excluirá permanentemente o seu usuário.</p>
                </div>
                <div class="mb-3">
                    <label for="pass" class="col-form-label">Digite sua senha para confirmar.</label>
                    <input type="password" class="form-control required" id="pass" name="pass">
                    <div class="invalid-feedback" id="pass-feedback"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">
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