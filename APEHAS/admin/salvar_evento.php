<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_evento = $_POST['data_evento'];
    $local_evento = $_POST['local_evento'];
    $nome_imagem_db = $_POST['imagem_antiga'] ?? '';

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $diretorio_uploads = '../uploads/eventos/';
        $nome_imagem_db = uniqid() . '-' . basename($_FILES['imagem']['name']);
        $caminho_arquivo = $diretorio_uploads . $nome_imagem_db;
        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_arquivo)) {
            die('Erro ao fazer upload da imagem.');
        }
    }

    if (empty($id)) {
        $sql = "INSERT INTO eventos (titulo, descricao, imagem, data_evento, local_evento) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $descricao, $nome_imagem_db, $data_evento, $local_evento]);
    } else {
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
            $sql = "UPDATE eventos SET titulo = ?, descricao = ?, imagem = ?, data_evento = ?, local_evento = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titulo, $descricao, $nome_imagem_db, $data_evento, $local_evento, $id]);
        } else {
            $sql = "UPDATE eventos SET titulo = ?, descricao = ?, data_evento = ?, local_evento = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titulo, $descricao, $data_evento, $local_evento, $id]);
        }
    }

    header('Location: gerenciar_eventos.php');
    exit;
}
?>