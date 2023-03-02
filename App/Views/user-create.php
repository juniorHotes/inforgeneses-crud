<?php $this->layout("master") ?>

<div class="container col-xxl-5 col-lg-5 col-md-6 border py-4 px-5 rounded-3">
    <h3>Cadastre-se</h3>
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
        <div class="mb-3">
            <label for="pass" class="form-label">Senha</label>
            <input type="password" class="form-control required" name="password" id="password" placeholder="Sua senha">
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
            <label for="compare_pass" class="form-label">Confirmar senha</label>
            <input type="password" class="form-control required" name="compare_pass" id="compare_pass" placeholder="Confirme sua senha">
            <div class="invalid-feedback" id="compare_pass-feedback"></div>
        </div>
        <hr>
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