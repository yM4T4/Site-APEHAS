<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php';

$curso = ['id' => '', 'titulo' => '', 'descricao' => '', 'imagem' => '', 'categoria' => ''];
$pageTitle = 'Adicionar Novo Curso';

if (isset($_GET['id'])) {
    $pageTitle = 'Editar Curso';
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
    <title><?php echo $pageTitle; ?> - Painel ADM</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?php echo $pageTitle; ?></h1>
        
        <form action="salvar_cursos.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($curso['id']); ?>">
            <input type="hidden" name="imagem_antiga" value="<?php echo htmlspecialchars($curso['imagem']); ?>">
            
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="titulo">Título do Curso (máx. 20 caracteres)</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($curso['titulo']); ?>" required maxlength="20">
                </div>
                <div class="form-group col-md-4">
                    <label for="categoria">Categoria (máx. 10 caracteres)</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo htmlspecialchars($curso['categoria']); ?>" placeholder="Ex: Tecnologia" required maxlength="10">
                </div>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição (máx. 300 caracteres)</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="10" required maxlength="300"><?php echo htmlspecialchars($curso['descricao']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="imagem">Imagem do Curso (até 50MB)</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem">
                <?php if (!empty($curso['imagem'])): ?>
                    <p class="mt-2 text-muted">Deixe em branco para manter a imagem atual:</p>
                    <img src="../uploads/cursos/<?php echo htmlspecialchars($curso['imagem']); ?>" width="150" class="img-thumbnail">
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="gerenciar_cursos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>