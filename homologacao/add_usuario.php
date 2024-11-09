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
    $adm = "N";
    $ativo = "S";

    if(isset($_POST['adm'])){
        $adm = $_POST['adm'];
    }

    // Verificando se já tem algum usuário com esse login
    $stmt = $querys->select("SELECT * FROM usuarios WHERE usuario = :USUARIO", array(":USUARIO" => $usuario));


    if (count($stmt) > 0 ) {
        echo "Usuário Indisponível";
    
    } else {
        $sql = "INSERT INTO usuarios (nome, email, usuario, telefone, senha, adm, Ativo) VALUES (:NOME, :EMAIL, :USUARIO, :TELEFONE, :SENHA, :ADM, :ATIVO)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":NOME", $nome);
        $stmt->bindParam(":EMAIL", $email);
        $stmt->bindParam(":USUARIO", $usuario);
        $stmt->bindParam(":TELEFONE", $telefone);
        $stmt->bindParam(":SENHA", $senha);
        $stmt->bindParam(":ADM", $adm);
        $stmt->bindParam(":ATIVO", $ativo);
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
            $mail->Body = 'Usuário criado';
    
            // Envia o e-mail
            $mail->send();
            echo '<script>window.location.reload();</script>';
            exit();
        } catch (Exception $e) {
            echo "Erro ao enviar email: $mail->ErrorInfo";
        }
    }
}
exit();
?>

