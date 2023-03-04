<?php $this->layout("master") ?>

<?php 
    $users = json_decode(str_replace('&quot;', '"', $this->e($users)));
?>

<div class="container border pt-4 px-5 rounded-3 ">
    <a href="/user/create" class="btn btn-primary">Adicionar</a>
    <table class="table caption-top">
    <caption>Lista de usuários</caption>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Registrado em</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <th scope="row"><a href="/user/edit?user=<?= $user->id ?>" class="link-primary"><?= $user->id ?></a></th>
            <td><a href="/user/edit?user=<?= $user->id ?>" class="link-primary"><?= $user->name ?></a></td>
            <td><a href="/user/edit?user=<?= $user->id ?>" class="link-primary"><?= $user->email ?></a></td>
            <td><a href="/user/edit?user=<?= $user->id ?>" class="link-primary"><?= $user->created_at ?></a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
</div>