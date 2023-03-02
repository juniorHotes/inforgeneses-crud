<?php $this->layout("master") ?>

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
        <tr>
            <th scope="row"><a href="/user/edit?user=1" class="link-primary">1</a></th>
            <td><a href="/user/edit?user=1" class="link-primary">João</a></td>
            <td><a href="/user/edit?user=1" class="link-primary">domingosmachado@email.com</a></td>
            <td><a href="/user/edit?user=1" class="link-primary">15/06/1992</a></td>
        </tr>
        <tr>
            <th scope="row"><a href="/user/edit?user=2" class="link-primary">2</a></th>
            <td><a href="/user/edit?user=2" class="link-primary">Alice</a></td>
            <td><a href="/user/edit?user=2" class="link-primary">alice@email.com</a></td>
            <td><a href="/user/edit?user=2" class="link-primary">11/10/2016</a></td>
        </tr>
    </tbody>
    </table>
</div>