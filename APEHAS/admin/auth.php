<?php
session_start();
$senha_correta_hash = '$2y$10$R95lQfLukMYHBYJnF0M5eOiKWmsvf9KxV0a4Chj5.LJbPC8y3PK66';
$senha_digitada = $_POST['senha'] ?? '';

// verifica o hash
if (password_verify($senha_digitada, $senha_correta_hash)) {
    $_SESSION['admin_logado'] = true;
    
    // Envia para a pag do adm
    header('Location: index.php');
    exit();
} else {
    // Mensagem de erro
    header('Location: login.php?erro=1');
    exit();
}
?>