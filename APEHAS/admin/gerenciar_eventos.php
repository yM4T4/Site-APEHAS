<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php';

$stmt = $pdo->query('SELECT id, titulo, imagem, DATE_FORMAT(data_evento, "%d/%m/%Y") as data_formatada FROM eventos ORDER BY data_evento DESC');
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Eventos - Painel ADM</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gerenciar Eventos</h1>
            <a href="index.php" class="btn btn-secondary">Voltar ao Painel</a>
        </div>
        
        <a href="form_evento.php" class="btn btn-success mb-3">Adicionar Novo Evento</a>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Data do Evento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($eventos) > 0): ?>
                    <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <td>
                                <?php if (!empty($evento['imagem'])): ?>
                                    <img src="../uploads/eventos/<?php echo htmlspecialchars($evento['imagem']); ?>" alt="<?php echo htmlspecialchars($evento['titulo']); ?>" width="100">
                                <?php else: ?>
                                    Sem Imagem
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($evento['titulo']); ?></td>
                            <td><?php echo $evento['data_formatada']; ?></td>
                            <td>
                                <a href="form_evento.php?id=<?php echo $evento['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="excluir_evento.php?id=<?php echo $evento['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este evento?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhum evento cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>