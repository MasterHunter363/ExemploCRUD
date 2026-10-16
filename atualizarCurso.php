<?php

require("conexao.php");

if (isset($_POST['atualizar'])) {
    $idMatricula = $_POST['idMatricula'];
    $nome = $_POST['aluno'];
    $curso = $_POST['curso'];

    $atualizar = "UPDATE matricula SET nome='$nome', curso='$curso' WHERE idMatricula='$idMatricula'";

    if (mysqli_query($conexao, $atualizar)) {
        echo
            " <script>
            alert('Atualização realizada com sucesso!');
            window.location = 'atualizarCurso.php';
            </script>";
        exit();
    } else {
        echo
            "<script>
            alert('Erro ao atualizar: " . mysqli_connect_error($conexao) . "');
            window.history.back();
        </script>";
    }

    $editaAluno = null;

    if (isset($_GET['editar'])) {

        $editar = $_GET['editar'];

        $resultado = mysqli_query($conexao, "SELECT * FROM matricula WHERE idMatricula = '$idEditar'");

    }

    $editaAluno = mysqli_fetch_array($resultado);

}

$alunos = mysqli_query($conexao, "SELECT * FROM matricula");

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Alunos</title>
</head>

<body>
    <h2>Lista de Alunos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Curso</th>
                <th>Ações</th>
            </tr>
        <tbody>
            <?php while ($aluno = mysqli_fetch_array($alunos)): ?>
                <tr>
                    <td><? $aluno['idMatricula'] ?></td>
                    <td><? $aluno['nome'] ?></td>
                    <td><? $aluno['curso'] ?></td>
                    <td><a href="
                    ?editar=<?= $aluno["idMatricula"] ?>
                    ">Editar</a></td>
                </tr>

            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>