<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php'; 
$stmt = $pdo->query('SELECT id, titulo, imagem FROM cursos ORDER BY id DESC');
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Cursos - Painel ADM</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gerenciar Cursos</h1>
            <a href="index.php" class="btn btn-secondary">Voltar ao Painel</a>
        </div>
        
        <a href="form_curso.php" class="btn btn-success mb-3">Adicionar Novo Curso</a>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($cursos) > 0): ?>
                    <?php foreach ($cursos as $curso): ?>
                        <tr>
                            <td>
                                <?php if (!empty($curso['imagem'])): ?>
                                    <img src="../uploads/cursos/<?php echo htmlspecialchars($curso['imagem']); ?>" alt="<?php echo htmlspecialchars($curso['titulo']); ?>" width="100">
                                <?php else: ?>
                                    Sem Imagem
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($curso['titulo']); ?></td>
                            <td>
                                <a href="form_curso.php?id=<?php echo $curso['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="excluir_curso.php?id=<?php echo $curso['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este curso?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Nenhum curso cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>