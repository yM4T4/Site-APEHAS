<?php
// Paginação
require_once 'php/includes/db.php';

$cursos_por_pagina = 9; 
$pagina_atual = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $cursos_por_pagina;

$total_cursos_stmt = $pdo->query('SELECT COUNT(*) FROM cursos');
$total_cursos = $total_cursos_stmt->fetchColumn();
$total_paginas = ceil($total_cursos / $cursos_por_pagina);

$stmt = $pdo->prepare('SELECT id, titulo, descricao, imagem, categoria, DATE_FORMAT(data_cadastro, "%d/%m/%Y") as data_formatada FROM cursos ORDER BY id DESC LIMIT :limit OFFSET :offset');
$stmt->bindValue(':limit', $cursos_por_pagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos - Associação APEHAS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/Cursos.css">
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
                        <li class="nav-item active"><a class="nav-link" href="Cursos.php">Cursos <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="eventos.php">Eventos</a></li>
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
                        <h1 class="page-title">Nossos Cursos e Oficinas</h1>
                        <p class="page-subtitle">Aprender é um exercício para a vida toda. Descubra nossas atividades!</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php if (count($cursos) > 0): ?>
                        <?php foreach ($cursos as $curso): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="course-card">
                                    <div class="course-card-img-container">
                                        <a href="curso_detalhe.php?id=<?php echo $curso['id']; ?>">
                                            <img src="uploads/cursos/<?php echo htmlspecialchars($curso['imagem']); ?>" class="course-card-img" alt="<?php echo htmlspecialchars($curso['titulo']); ?>">
                                        </a>
                                    </div>
                                    <div class="course-card-body">
                                        <div class="course-card-meta">
                                            <span class="course-category"><?php echo htmlspecialchars($curso['categoria']); ?></span>
                                            <span class="course-date"><?php echo $curso['data_formatada']; ?></span>
                                        </div>
                                        <h5 class="course-card-title">
                                            <a href="curso_detalhe.php?id=<?php echo $curso['id']; ?>"><?php echo htmlspecialchars($curso['titulo']); ?></a>
                                        </h5>
                                        <p class="course-card-text">
                                            <?php echo htmlspecialchars(substr($curso['descricao'], 0, 120)) . '...'; ?>
                                        </p>
                                    </div>
                                    <div class="course-card-footer">
                                        <a href="curso_detalhe.php?id=<?php echo $curso['id']; ?>" class="btn-read-more">Ver Detalhes <i class="fas fa-arrow-right"></i></a>
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
                                <h3 class="text-muted">Nenhum curso disponível no momento</h3>
                                <p class="lead text-muted">Volte em breve para novidades!</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($total_paginas > 1): ?>
                <nav aria-label="Navegação da página de cursos" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <li class="page-item <?php if ($i == $pagina_atual) echo 'active'; ?>">
                                <a class="page-link" href="Cursos.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
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
                        <li><a href="eventos.php">Eventos</a></li>
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
                © <span id="currentYear"></span> Associação de Promoção ao Envelhecimeneto Humano Ativo e Saudável. Todos os direitos reservados. Created by @mgl_alvesc
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/Cursos.js"></script>
</body>
</html>