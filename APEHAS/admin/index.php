<?php
require_once 'verifica_login.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel ADM - APEHAS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Painel Administrativo APEHAS</h1>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
        
        <p class="lead">Bem-vindo ao painel de gerenciamento do site. Escolha uma opção abaixo para começar.</p>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gerenciar Cursos</h5>
                        <p class="card-text">Adicione, edite ou remova os cursos e oficinas do site.</p>
                        <a href="gerenciar_cursos.php" class="btn btn-primary">Gerenciar Cursos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gerenciar Eventos</h5>
                        <p class="card-text">Adicione, edite ou remova os eventos do site.</p>
                        <a href="gerenciar_eventos.php" class="btn btn-primary">Gerenciar Eventos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>