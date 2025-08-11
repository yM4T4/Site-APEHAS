<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $nome_imagem = '';

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $diretorio_uploads = '../uploads/cursos/';
        $nome_imagem = uniqid() . '-' . basename($_FILES['imagem']['name']);
        $caminho_arquivo = $diretorio_uploads . $nome_imagem;

        if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_arquivo)) {
            die('Erro ao fazer upload da imagem.');
        }
    }

    if (empty($id)) {
        // Inseri o novo curso etc
        $sql = "INSERT INTO cursos (titulo, descricao, imagem) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $descricao, $nome_imagem]);
    } else {
        //  Atualiza o curso etc
        if (!empty($nome_imagem)) {
            $sql = "UPDATE cursos SET titulo = ?, descricao = ?, imagem = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titulo, $descricao, $nome_imagem, $id]);
        } else {
            $sql = "UPDATE cursos SET titulo = ?, descricao = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titulo, $descricao, $id]);
        }
    }

    // Manda de volta para a lista de cursos
    header('Location: gerenciar_cursos.php');
    exit;
}
?>