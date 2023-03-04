<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://releases.jquery.com/git/jquery-3.x-git.min.js"></script>
    <link rel="stylesheet" href="../../public/css/styles.css">
    <title>Inforgenenses CRUD</title>
</head>
<body>
    <?php 
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $current_user = isset($_SESSION['user']) ? $_SESSION['user'] : '0';
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light bg-gradient shadow pb-4 sticky-lg-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="https://www.inforgeneses.com.br/assets/modelo7//images/logo.svg" alt="Inforgeneses"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mt-3">
                    <li class="nav-item">
                        <a class="nav-link text-info fw-bold active" aria-current="page" href="/">Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-info fw-bold" href="/user/edit?user=<?= $current_user ?>">Minha conta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-info fw-bold" href="/user/create">Cadastrar-se</a>
                    </li>
                    <?php if($current_user == '0'): ?>
                    <li class="nav-item">
                        <a class="nav-link text-info fw-bold" href="/login">Entrar</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-info fw-bold" href="/logout">Sair</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-sm mt-5 mb-5">
        <?= $this->section("content") ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>