<?php
require("conexao.php");

$editaAluno = null;
$mensagem = "";

if (isset($_POST["atualizar"])) {

    $idMatricula = (int) ($_POST["idMatricula"] ?? 0);
    $nome = trim($_POST["nome"] ?? "");
    $curso = trim($_POST["curso"] ?? "");

    if ($idMatricula > 0 && $nome != "" && $curso != "") {

        $stmt = mysqli_prepare(
            $conexao,
            "UPDATE matricula SET nome = ?, curso = ? WHERE idMatricula = ?"
        );

        mysqli_stmt_bind_param($stmt, "ssi", $nome, $curso, $idMatricula);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: atualizarCurso.php?atualizado=1");
            exit();
        } else {
            $mensagem = "Erro ao atualizar o registro.";
        }

        mysqli_stmt_close($stmt);

    } else {
        $mensagem = "Preencha todos os campos.";
    }
}

if (isset($_GET["editar"])) {

    $idEditar = (int) $_GET["editar"];

    $stmt = mysqli_prepare(
        $conexao,
        "SELECT * FROM matricula WHERE idMatricula = ?"
    );

    mysqli_stmt_bind_param($stmt, "i", $idEditar);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
    $editaAluno = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($stmt);
}

if (isset($_GET["apagar"])) {

    $idMatricula = (int) $_GET["apagar"];

    $stmt = mysqli_prepare(
        $conexao,
        "DELETE FROM matricula WHERE idMatricula = ?"
    );

    mysqli_stmt_bind_param($stmt, "i", $idMatricula);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: atualizarCurso.php?apagado=1");
        exit();
    } else {
        $mensagem = "Erro ao excluir o registro.";
    }

    mysqli_stmt_close($stmt);
}

$alunos = mysqli_query(
    $conexao,
    "SELECT * FROM matricula ORDER BY idMatricula DESC"
);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar matrículas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Sistema Acadêmico</a>

            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Início</a>
                <a class="nav-link" href="cadastro.php">Cadastrar</a>
                <a class="nav-link active" href="atualizarCurso.php">Matrículas</a>
                <a class="nav-link" href="lendoDados.php">Consultar</a>
            </div>
        </div>
    </nav>

    <main class="container py-5">

        <div class="page-heading">
            <h1 class="h2 fw-bold">Gerenciar matrículas</h1>

        </div>

        <?php if (isset($_GET["atualizado"])): ?>
            <div class="alert alert-success">
                Matrícula atualizada com sucesso!
            </div>
        <?php endif; ?>

        <?php if (isset($_GET["apagado"])): ?>
            <div class="alert alert-success">
                Registro excluído com sucesso!
            </div>
        <?php endif; ?>

        <?php if ($mensagem != ""): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <?php if ($editaAluno): ?>
            <div class="content-card mb-4">

                <h2 class="h5 fw-bold mb-3">Editar aluno</h2>

                <form method="post" action="atualizarCurso.php">

                    <input type="hidden" name="idMatricula" value="<?= (int) $editaAluno["idMatricula"] ?>">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome"
                                value="<?= htmlspecialchars($editaAluno["nome"]) ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="curso" class="form-label">Curso</label>
                            <input type="text" class="form-control" id="curso" name="curso"
                                value="<?= htmlspecialchars($editaAluno["curso"]) ?>" required>
                        </div>
                    </div>

                    <button type="submit" name="atualizar" class="btn btn-primary mt-3">
                        Salvar alterações
                    </button>

                    <a href="atualizarCurso.php" class="btn btn-outline-secondary mt-3">
                        Cancelar
                    </a>

                </form>
            </div>
        <?php endif; ?>

        <div class="content-card">
            <div class="text-left mb-3">
                <a href="cadastro.php" class="btn btn-primary">+ Novo aluno</a>
                <br>
                <button type="button" class="btn btn-danger mt-1" onclick="window.location.href='index.php'">
                    Voltar
                </button>
            </div>
            <div class="table-wrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Curso</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($alunos && mysqli_num_rows($alunos) > 0): ?>

                            <?php while ($aluno = mysqli_fetch_assoc($alunos)): ?>
                                <tr>
                                    <td><?= (int) $aluno["idMatricula"] ?></td>
                                    <td><?= htmlspecialchars($aluno["nome"]) ?></td>
                                    <td>
                                        <span class="badge-course">
                                            <?= htmlspecialchars($aluno["curso"]) ?>
                                        </span>
                                    </td>
                                    <td class="text-nowrap">
                                        <a class="btn btn-sm btn-outline-primary"
                                            href="atualizarCurso.php?editar=<?= (int) $aluno["idMatricula"] ?>">
                                            Editar
                                        </a>

                                        <a class="btn btn-sm btn-outline-danger"
                                            href="atualizarCurso.php?apagar=<?= (int) $aluno["idMatricula"] ?>"
                                            onclick="return confirm('Deseja realmente excluir este registro?')">
                                            Apagar
                                        </a>
                                    </td>
                                </tr>

                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>

</html>