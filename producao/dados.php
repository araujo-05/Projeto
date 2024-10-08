<?php

$usuario = [
    'id' => 1,
    'nome' => "Abraão",
    'idade' => 45,
    'login' => 'abraaoc',
    'senha' => '1234'
];


$usuariol = $_POST['usuariol'];
$senha = $_POST['senha'];

if ($senha != $usuario['senha'] || $usuariol != $usuario['login']) {
    echo "Login ou senha incorretos";
}else{
    echo "Conseguiu";
}

?>
