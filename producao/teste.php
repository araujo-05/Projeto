<?php

include_once('conexao.php');
$id = 16;
$sql = 'DELETE FROM usuarios WHERE id = :ID';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':ID',$id);
$stmt->execute();
?>