<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php';

$evento = ['id' => '', 'titulo' => '', 'descricao' => '', 'imagem' => '', 'data_evento' => '', 'local_evento' => ''];
$pageTitle = 'Adicionar Novo Evento';

if (isset($_GET['id'])) {
    $pageTitle = 'Editar Evento';
    $stmt = $pdo->prepare('SELECT * FROM eventos WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $evento = $stmt->fetch(PDO::FETCH_ASSOC);
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
        
        <form action="salvar_evento.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($evento['id']); ?>">
            <input type="hidden" name="imagem_antiga" value="<?php echo htmlspecialchars($evento['imagem']); ?>">
            
            <div class="form-group">
                <label for="titulo">Título do Evento</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($evento['titulo']); ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="data_evento">Data do Evento</label>
                    <input type="date" class="form-control" id="data_evento" name="data_evento" value="<?php echo htmlspecialchars($evento['data_evento']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="local_evento">Local do Evento</label>
                    <input type="text" class="form-control" id="local_evento" name="local_evento" value="<?php echo htmlspecialchars($evento['local_evento']); ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição Completa do Evento</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="10" required><?php echo htmlspecialchars($evento['descricao']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="imagem">Imagem do Evento</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem">
                <?php if (!empty($evento['imagem'])): ?>
                    <p class="mt-2 text-muted">Deixe em branco para manter a imagem atual.</p>
                    <img src="../uploads/eventos/<?php echo htmlspecialchars($evento['imagem']); ?>" width="150" class="img-thumbnail">
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar Evento</button>
            <a href="gerenciar_eventos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>