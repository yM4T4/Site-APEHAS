<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt_select = $pdo->prepare("SELECT imagem FROM eventos WHERE id = ?");
    $stmt_select->execute([$id]);
    $evento = $stmt_select->fetch(PDO::FETCH_ASSOC);

    if ($evento && !empty($evento['imagem'])) {
        $caminho_imagem = '../uploads/eventos/' . $evento['imagem'];
        if (file_exists($caminho_imagem)) {
            unlink($caminho_imagem);
        }
    }
    
    $stmt_delete = $pdo->prepare("DELETE FROM eventos WHERE id = ?");
    $stmt_delete->execute([$id]);

    header('Location: gerenciar_eventos.php');
    exit;
}
?>