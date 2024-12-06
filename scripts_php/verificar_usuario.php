<?php
include_once("conexao.php");

$usuario = $_POST['usuario'];

$sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':USUARIO',$usuario);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se o nome de usuário foi enviado
if (isset($_POST['usuario']) && $_POST['usuario'] != "" ){
    // Checa se o usuário já está cadastrado
    if (count($result) > 0){
        echo "O usuário '$usuario' já está em uso.";
    } else {
        echo "O usuário '$usuario' está disponível!";
    }
} else {
    echo "Nenhum nome de usuário foi enviado.";
}
?>
