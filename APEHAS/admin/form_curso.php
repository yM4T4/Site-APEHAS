<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php';

$curso = ['id' => '', 'titulo' => '', 'descricao' => '', 'imagem' => ''];
$titulo_pagina = 'Adicionar Novo Curso';

if (isset($_GET['id'])) {
    $titulo_pagina = 'Editar Curso';
    $stmt = $pdo->prepare('SELECT * FROM cursos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$curso) {
        header('Location: gerenciar_cursos.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo_pagina; ?> - Painel ADM</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo $titulo_pagina; ?></h1>
        
        <form action="salvar_curso.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($curso['id']); ?>">
            
            <div class="form-group">
                <label for="titulo">Título do Curso</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($curso['titulo']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="5" required><?php echo htmlspecialchars($curso['descricao']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="imagem">Imagem do Curso</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem">
                <?php if (!empty($curso['imagem'])): ?>
                    <p class="mt-2">Imagem atual: <?php echo htmlspecialchars($curso['imagem']); ?></p>
                    <img src="../uploads/cursos/<?php echo htmlspecialchars($curso['imagem']); ?>" width="150" class="img-thumbnail">
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar Curso</button>
            <a href="gerenciar_cursos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>