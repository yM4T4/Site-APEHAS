<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Pega o nome do arquivo de imagem para apagar o arquivo de verdade
    $stmt_select = $pdo->prepare("SELECT imagem FROM cursos WHERE id = ?");
    $stmt_select->execute([$id]);
    $curso = $stmt_select->fetch(PDO::FETCH_ASSOC);

    if ($curso && !empty($curso['imagem'])) {
        // Apaga o arq de verdade
        $caminho_imagem = '../uploads/cursos/' . $curso['imagem'];
        if (file_exists($caminho_imagem)) {
            unlink($caminho_imagem);
        }
    }
    
    // Apaga o registro
    $stmt_delete = $pdo->prepare("DELETE FROM cursos WHERE id = ?");
    $stmt_delete->execute([$id]);

    // Manda de volta para lista
    header('Location: gerenciar_cursos.php');
    exit;
}
?>