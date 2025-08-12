<?php
session_start();
$senha_correta_hash = '$2y$10$we7qfcL.kX8A3Bqfx5ClAeBM3mQbFuofpch/5SvxaPUwwIeTCBdUS';
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