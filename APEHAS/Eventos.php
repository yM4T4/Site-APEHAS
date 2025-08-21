<?php
require_once 'php/includes/db.php';

$eventos_por_pagina = 9;
$pagina_atual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $eventos_por_pagina;

$total_eventos_stmt = $pdo->query('SELECT COUNT(*) FROM eventos');
$total_eventos = $total_eventos_stmt->fetchColumn();
$total_paginas = ceil($total_eventos / $eventos_por_pagina);

$stmt = $pdo->prepare('SELECT id, titulo, descricao, imagem, DATE_FORMAT(data_evento, "%d/%m/%Y") as data_formatada FROM eventos ORDER BY data_evento DESC LIMIT :limit OFFSET :offset');
$stmt->bindValue(':limit', $eventos_por_pagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos - Associação APEHAS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/Cursos.css">
    <style>
        .page-banner { 
            background-image: url('img/eventos/banner-eventos.jpg'); 
        }
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="SobreNos.html">Sobre Nós</a></li>
                    <li class="nav-item"><a class="nav-link" href="Cursos.php">Cursos</a></li>
                    <li class="nav-item active"><a class="nav-link" href="Eventos.php">Eventos <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Participe.html">Participe</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <section class="page-banner">
        <div class="banner-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="page-title">Nossos Eventos</h1>
                    <p class="page-subtitle">Conecte-se, participe e celebre conosco.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php if (count($eventos) > 0): ?>
                    <?php foreach ($eventos as $evento): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="course-card">
                                <div class="course-card-img-container">
                                    <a href="evento_detalhe.php?id=<?php echo $evento['id']; ?>">
                                        <img src="uploads/eventos/<?php echo htmlspecialchars($evento['imagem']); ?>" class="course-card-img" alt="<?php echo htmlspecialchars($evento['titulo']); ?>">
                                    </a>
                                </div>
                                <div class="course-card-body">
                                    <div class="course-card-meta">
                                        <span class="event-date"><?php echo $evento['data_formatada']; ?></span>
                                    </div>
                                    <h5 class="course-card-title">
                                        <a href="evento_detalhe.php?id=<?php echo $evento['id']; ?>"><?php echo htmlspecialchars($evento['titulo']); ?></a>
                                    </h5>
                                    <p class="course-card-text">
                                        <?php echo htmlspecialchars(substr($evento['descricao'], 0, 120)) . '...'; ?>
                                    </p>
                                </div>
                                <div class="course-card-footer">
                                    <a href="evento_detalhe.php?id=<?php echo $evento['id']; ?>" class="btn-read-more">Ver Detalhes <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                         <div class="my-5">
                            <div style="font-size: 4rem; color: #ccc;" class="mb-3">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h3 class="text-muted">Nenhum evento programado</h3>
                            <p class="lead text-muted">Volte em breve para novidades!</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($total_paginas > 1): ?>
            <nav aria-label="Navegação da página de eventos" class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <li class="page-item <?php if ($i == $pagina_atual) echo 'active'; ?>">
                            <a class="page-link" href="Eventos.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </section>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/Eventos.js"></script>
</body>
</html>
