
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Acadêmico</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            Sistema Acadêmico
        </a>

        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="index.php">Início</a>
                <a class="nav-link" href="cadastro.php">Cadastrar aluno</a>
                <a class="nav-link" href="atualizarCurso.php">Gerenciar matrículas</a>
                <a class="nav-link" href="lendoDados.php">Consultar alunos</a>
            </div>
        </div>
    </div>
</nav>

<main class="container py-5">

    <section class="hero p-4 p-md-5">
        <h1 class="display-5 fw-bold">
            Bem-vindo ao Sistema Acadêmico
        </h1>
    </section>

    <h2 class="section-title mt-5 mb-3">
        O que você deseja fazer?
    </h2>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="feature-card h-100">
                <h3>Cadastrar aluno</h3>
                <p>Adicione novos alunos e seus cursos.</p>
                <a href="cadastro.php" class="btn btn-primary">
                    Acessar cadastro
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-card h-100">
                <h3>Gerenciar matrículas</h3>
                <p>Edite ou exclua matrículas cadastradas.</p>
                <a href="atualizarCurso.php" class="btn btn-primary">
                    Gerenciar
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-card h-100">
                <h3>Consultar alunos</h3>
                <p>Visualize os alunos cadastrados no sistema.</p>
                <a href="lendoDados.php" class="btn btn-primary">
                    Consultar
                </a>
            </div>
        </div>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
