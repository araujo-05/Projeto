<?php
session_start();
include_once("conexao.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $usuariol = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':USUARIO', $usuariol);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user['usuario'] == $usuariol && $user['senha'] == $senha){

        $_SESSION['username'] = $user['usuario'];
        echo "<script>window.location.assign('index.php')</script>";

    } else{
        echo  "Usuario ou senha incorreta";
        
    }
}

?>
