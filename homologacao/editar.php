<?php

session_start();
include_once('conexao.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':USUARIO', $_SESSION['username']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $id = $user['id'];
    $usuario = $_SESSION['username'];

    $new_nome = $_GET['new_nome'];
    $new_email = $_GET['new_email'];
    $new_telefone = $_GET['new_telefone'];

    $new_nome = $new_nome ?: $user['nome'];
    $new_email = $new_email ?: $user['email'];
    $new_telefone = $new_telefone ?: $user['telefone'];

    $sql = "UPDATE usuarios SET nome = :NOME, email = :EMAIL, telefone = :TELEFONE WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':NOME', $new_nome);
    $stmt->bindParam(':EMAIL', $new_email);
    $stmt->bindParam(':TELEFONE', $new_telefone);
    $stmt->execute();

    header("Location: /projeto/indexh.php");

}

?>