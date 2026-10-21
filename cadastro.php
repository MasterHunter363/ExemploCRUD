<?php
require("conexao.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["aluno"] ?? "");
    $curso = trim($_POST["curso"] ?? "");

    if ($nome != "" && $curso != "") {

        $stmt = mysqli_prepare(
            $conexao,
            "INSERT INTO matricula (nome, curso) VALUES (?, ?)"
        );

        mysqli_stmt_bind_param($stmt, "ss", $nome, $curso);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: cadastro.php?sucesso=1");
            exit();
        } else {
            $mensagem = "Erro ao cadastrar aluno.";
        }

        mysqli_stmt_close($stmt);

    } else {
        $mensagem = "Preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar aluno</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Sistema Acadêmico</a>

            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php">Início</a>
                <a class="nav-link active" href="cadastro.php">Cadastrar</a>
                <a class="nav-link" href="atualizarCurso.php">Matrículas</a>
                <a class="nav-link" href="lendoDados.php">Consultar</a>
            </div>
        </div>
    </nav>

    <main class="container py-5">

        <div class="page-heading">
            <h1 class="h2 fw-bold">Cadastrar aluno</h1>
            <p>Preencha os dados para adicionar uma matrícula.</p>
        </div>

        <div class="content-card" style="max-width: 700px;">

            <?php if (isset($_GET["sucesso"])): ?>
                <div class="alert alert-success">
                    Cadastro realizado com sucesso!
                </div>
            <?php endif; ?>

            <?php if ($mensagem != ""): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($mensagem) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="cadastro.php">

                <div class="mb-3">
                    <label for="aluno" class="form-label">
                        Nome do aluno
                    </label>

                    <input type="text" class="form-control" id="aluno" name="aluno" required>
                </div>

                <div class="mb-4">
                    <label for="curso" class="form-label">
                        Curso
                    </label>

                    <input type="text" class="form-control" id="curso" name="curso" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Cadastrar
                </button>
                
                <button type="reset" class="btn btn-outline-secondary">
                    Limpar
                </button>

                <a href="index.php" class="btn btn-danger">
                    Voltar
                </a>

            </form>
        </div>
    </main>


</body>

</html>