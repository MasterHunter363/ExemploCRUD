<?php

$conexao = mysqli_connect(
    "localhost",
    "root",
    "",
    "sistemaAcademico",
    3307
);

if (!$conexao) {
    die("Não foi possivel conectar ao banco de dados.". mysqli_connect_error());

}

mysqli_set_charset($conexao,"utf8mb4");




?>