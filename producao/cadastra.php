<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$mail = new PHPMailer(true);
include_once("conexao.php");
require_once("config.php");

$querys = new Sql();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

    // Verificando se já tem algum usuário com esse login
    
    $stmt = $querys->select("SELECT * FROM usuarios WHERE usuario = :USUARIO", array(":USUARIO" => $usuario));


    if (count($stmt) > 0 ) {
        echo "O usuário já está em uso";
    
    } else {
        $sql = "INSERT INTO usuarios (nome, email, usuario, telefone, senha) VALUES (:NOME, :EMAIL, :USUARIO, :TELEFONE, :SENHA)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":NOME", $nome);
        $stmt->bindParam(":EMAIL", $email);
        $stmt->bindParam(":USUARIO", $usuario);
        $stmt->bindParam(":TELEFONE", $telefone);
        $stmt->bindParam(":SENHA", $senha);
        $stmt->execute();
            // Cadastro bem-sucedido
        try {
            // Configurações do servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'naoresponda.blip@gmail.com'; // E-mail SMTP
            $mail->Password = 'isml vpgt rmge zpev'; // Senha SMTP
            $mail->SMTPSecure = 'tls'; // Segurança
            $mail->Port = 587; // Porta
    
            // Remetente e Destinatário
            $mail->setFrom('naoresponda.blip@gmail.com', 'naoresponda');
            $mail->addAddress($email);
    
            // Conteúdo do e-mail
            $mail->isHTML(true); // Permite HTML
            $mail->Subject = 'Email';
            $mail->Body    = 'Email criado';
    
            // Envia o e-mail
            $mail->send();
            echo 'E-mail enviado com sucesso';
            header("Location: login.php");
            exit();
        } catch (Exception $e) {
            echo "O e-mail não pôde ser enviado. Erro: {$mail->ErrorInfo}";
        }
    }
    exit();
}
?>

