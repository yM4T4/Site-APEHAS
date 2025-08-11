<?php
session_start();

// Verifica se a credencial não existe ou não é verdadeira
if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
    header('Location: login.php');
    exit();
}
?>