<?php
require_once 'verifica_login.php';
require_once '../php/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validações de tamanho antes de qualquer outra coisa
    if (strlen($_POST['titulo']) > 30) {
        die('Erro: O título não pode ter mais de 30 caracteres.');
    }
    if (strlen($_POST['categoria']) > 10) {
        die('Erro: A categoria não pode ter mais de 10 caracteres.');
    }
    if (strlen($_POST['descricao']) > 300) {
        die('Erro: A descrição não pode ter mais de 300 caracteres.');
    }
    
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $nome_imagem_db = $_POST['imagem_antiga'] ?? '';

    // Lógica de Upload da Imagem com Validação
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $diretorio_uploads = '../uploads/cursos/';
        $arquivo_tmp = $_FILES['imagem']['tmp_name'];
        $nome_arquivo = basename($_FILES['imagem']['name']);

        // Validação de Tamanho (50MB)
        $tamanho_maximo = 50 * 1024 * 1024; // 50MB em bytes
        if ($_FILES['imagem']['size'] > $tamanho_maximo) {
            die('Erro: O arquivo é muito grande. O tamanho máximo permitido é de 50MB.');
        }

        // Validação de Tipo de Arquivo (apenas imagens)
        $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
        if (!in_array($extensao, $tipos_permitidos)) {
            die('Erro: Tipo de arquivo não permitido. Por favor, envie apenas imagens (jpg, jpeg, png, gif, webp).');
        }

        $nome_imagem_db = uniqid() . '.' . $extensao;
        $caminho_arquivo = $diretorio_uploads . $nome_imagem_db;

        if (!move_uploaded_file($arquivo_tmp, $caminho_arquivo)) {
            die('Erro ao fazer upload da imagem.');
        }
    }

    // Lógica de Inserção/Atualização no Banco de Dados
    if (empty($id)) {
        // INSERIR
        $sql = "INSERT INTO cursos (titulo, descricao, imagem, categoria) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $descricao, $nome_imagem_db, $categoria]);
    } else {
        // ATUALIZAR
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
            $sql = "UPDATE cursos SET titulo = ?, descricao = ?, imagem = ?, categoria = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titulo, $descricao, $nome_imagem_db, $categoria, $id]);
        } else {
            $sql = "UPDATE cursos SET titulo = ?, descricao = ?, categoria = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titulo, $descricao, $categoria, $id]);
        }
    }

    header('Location: gerenciar_cursos.php');
    exit;
}
?>