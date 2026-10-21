<?php
require("conexao.php");

$consulta = "SELECT * FROM matricula ORDER BY idMatricula DESC";
$matricula = mysqli_query($conexao, $consulta);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar alunos</title>

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
                <a class="nav-link" href="atualizarCurso.php">Matrículas</a>
                <a class="nav-link active" href="lendoDados.php">Consultar</a>
            </div>
        </div>
    </nav>

    <main class="container py-5">

        <div class="page-heading">
            <h1 class="h2 fw-bold">Consultar alunos e Cursos</h1>
            
        </div>

        <div class="content-card">
            <div class="table-wrap">
                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome do aluno</th>
                            <th>Curso</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($matricula && mysqli_num_rows($matricula) > 0): ?>

                            <?php while ($aluno = mysqli_fetch_assoc($matricula)): ?>
                                <tr>
                                    <td><?= (int) $aluno["idMatricula"] ?></td>
                                    <td><?= htmlspecialchars($aluno["nome"]) ?></td>
                                    <td>
                                        <span class="badge-course">
                                            <?= htmlspecialchars($aluno["curso"]) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="empty-state">
                                    Nenhum aluno cadastrado ainda.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

            <a href="index.php" class="btn btn-outline-secondary mt-3">
                Voltar ao início
            </a>
        </div>

    </main>
</body>

</html>