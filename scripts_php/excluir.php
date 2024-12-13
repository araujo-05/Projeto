<?php

include_once("conexao.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $sql = 'DELETE FROM usuarios WHERE id = :ID';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ID',$id);
    $stmt->execute();
    header('Location: ../usuarios.php');
}

?>