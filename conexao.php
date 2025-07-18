<?php
define('HOST', '127.0.0.1');
define('USER', '');
define('SENHA', '');
define('DB', '');

$conexao = mysqli_connect(HOST, USER, SENHA, DB) or die ("Erro ao conectar ao banco de dados: ");
?>
