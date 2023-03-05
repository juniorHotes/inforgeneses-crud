# INFORGENENSES - CRUD PHP

Criação, leitura, atualização e exclusão de usuarios

## Funcionalidades 
1 - Visualizar usuários</br>
2 - Cadastrar usuário</br>
3 - Editar usuário</br>
4 - Deletar usuário</br>

## Requisitos do projeto

* Instale os requitos
<ul>
    <li><a href="https://www.php.net/">PHP 8.2.3</a></li>
    <li><a href="https://www.mysql.com/downloads/">Mysql</a></li>
    <li><a href="https://getcomposer.org//">Composer</a></li>
</ul>

## Instalação do projeto
1 - Na raiz do projeto abra seu terminal e execute.</br>
    ``composer update``</br>
2 - Inicie seu servidor PHP ou apache (se configurado), no seu terminal e execute.</br>
    ``php -S localhost:8080``</br>
3 - Abra no seu navegador <a href="http:localhost:8080">http:localhost:8080</a></br>

### Observações
 * Para o servidor integrado do php reconhecer o msql/pdo será preciso configurar o arquivo php.ini</br>
   * Edite o php.ini
        * Descomente/Remova o `;` antes do ``extension_dir="ext"``
            * _Se o PDO ainda não for reconhecido, passe o caminho completo do ``ext``. ex: ``extension_dir="C:\tools\php-8.2.3\ext"``_
        * Descomente/Remova o `;` antes do ``extension=pdo_mysql``
        * Salve o arquivo e inicie o servidor ``php -S localhost:8080``</br>
_Não esqueça de estár com seu servidor mysql ativo._

## Construído com
    * PHP 8
    * Mysql
    * Composer
    * Estrutura MVC