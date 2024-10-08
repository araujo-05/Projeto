<?php

session_start();
include_once('conexao.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $sql = 'SELECT * FROM usuarios WHERE usuario = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $id = $user['id'];
    

    $usuario = $_SESSION['username'];
    $new_nome = $_GET['new_nome'];
    $new_email = $_GET['new_email'];
    $new_telefone = $_GET['new_telefone'];

    $new_nome = $new_nome ?: $user['nome'];
    $new_email = $new_email ?: $user['email'];
    $new_telefone = $new_telefone ?: $user['telefone'];

    $sql = "UPDATE usuarios SET nome = '$new_nome', email = '$new_email', telefone = '$new_telefone' WHERE id = '$id'";

    /*
    Algo de errado não está certo no código abaixo, não sei o que, mas tem algo errado.

    $sql = "UPDATE usuarios SET nome = ?, email = ?, telefone = ? WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $new_nome, $new_email, $new_telefone);
    $stmt->execute();
    */


    $resultado = mysqli_query($conn, $sql);
    
    if (mysqli_insert_id($conn)) {
        echo "<script> alert('USUARIO CADASTRADO COM SUCESSO') </script>";
        header("Location: /index.php");
    }
    else{
        echo "<script> alert('[ERRO]') </script>";
        header("Location: /index.php");
    }



}

?>