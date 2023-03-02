<?php $this->layout("master") ?>

<div class="container col-xxl-5 col-lg-5 col-md-6 border py-4 px-5 rounded-3">
    <h3>Entre com seu usuário</h3>
    <hr>
    <form class="pt-2 needs-validation" method="POST" action="/login">
      <div class="mb-3">
        <label for="user_login" class="form-label">E-mail ou usuário</label>
        <input type="text" class="form-control required" name="user_login" id="user_login">
        <div class="invalid-feedback" id="user_login-feedback"></div>
      </div>
      <div class="mb-3">
        <label for="pass" class="form-label">Senha</label>
        <input type="password" class="form-control required" name="pass" id="pass">
        <div class="invalid-feedback" id="pass-feedback"></div>
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