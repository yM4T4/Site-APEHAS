<?php
require_once 'php/includes/db.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: Eventos.php');
    exit;
}
$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT *, DATE_FORMAT(data_evento, "%d/%m/%Y") as data_formatada FROM eventos WHERE id = ?');
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    header('Location: Eventos.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($evento['titulo']); ?> - APEHAS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/curso_detalhe.css"> <!-- Reaproveitando CSS do curso -->
    <style>
        .event-date {
            color: #f39c12; /* laranja */
            font-weight: 600;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.html">
                <img src="img/logo.png" alt="Logo APEHAS" class="">
                <div class="navbar-brand-text-container">
                    <span class="brand-line">Associação de Promoção ao</span>
                    <span class="brand-line">Envelhecimento Humano</span>
                    <span class="brand-line">Ativo e Saudável</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="SobreNos.html">Sobre Nós</a></li>
                    <li class="nav-item"><a class="nav-link" href="Cursos.php">Cursos</a></li>
                    <li class="nav-item active"><a class="nav-link" href="Eventos.php">Eventos</a></li>
                    <li class="nav-item"><a class="nav-link" href="Participe.html">Participe</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="py-5 page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                
                <div class="course-meta mb-3">
                    <span class="event-date">Ocorre em <?php echo htmlspecialchars($evento['data_formatada']); ?></span>
                </div>
                
                <h1 class="course-title"><?php echo htmlspecialchars($evento['titulo']); ?></h1>
                
                <?php if (!empty($evento['imagem'])): ?>
                    <img src="uploads/eventos/<?php echo htmlspecialchars($evento['imagem']); ?>" class="img-fluid rounded shadow-sm my-4 course-image" alt="<?php echo htmlspecialchars($evento['titulo']); ?>">
                <?php endif; ?>
                
                <div class="course-description">
                    <?php echo nl2br(htmlspecialchars($evento['descricao'])); ?>
                </div>

                <hr class="my-5">
                <a href="Eventos.php" class="btn btn-secondary"><i class="fas fa-arrow-left mr-2"></i>Voltar para todos os eventos</a>
            </div>
        </div>
    </div>
</main>

<footer class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <h5>Associação</h5>
                <img src="img/LOGO.png" alt="Logo Rodapé" height="60" class="mb-2">
                <p class="small">Promovendo o Envelhecimento Humano Ativo e Saudável.</p>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <h5>Links Úteis</h5>
                <ul class="list-unstyled">
                    <li><a href="index.html">Início</a></li>
                    <li><a href="SobreNos.html">Sobre Nós</a></li>
                    <li><a href="Cursos.php">Cursos</a></li>
                    <li><a href="Eventos.php">Eventos</a></li>
                    <li><a href="Participe.html">Participe</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contato</h5>
                <p class="small">
                    <i class="fas fa-map-marker-alt"></i> Av. José Manoel Pereira, 252 - Avenida, Itajubá - MG, 37504-000<br>
                    <i class="fas fa-phone"></i> (XX) XXXX-XXXX<br>
                    <i class="fas fa-envelope"></i> contato@suaassociacao.org.br
                </p>
                <div class="social-icons">
                    <a href="#" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-center small">
            © <span id="currentYear"></span> Associação de Promoção ao Envelhecimento Humano Ativo e Saudável. Todos os direitos reservados. Created by @mgl_alvesc
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>
