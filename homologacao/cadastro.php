<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$mail = new PHPMailer(true);
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

    // Verificando se já tem algum usuário com esse login
    $sql = 'SELECT id FROM usuarios WHERE usuario = :USUARIO';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':USUARIO', $usuario);
    $stmt->execute();



    if ($stmt->rowCount() > 0) {
        $_SESSION['msg'] = 'Usuário já cadastrado';
        header('Location: cadastro.php');
        exit();
    
    } else {
        $sql = "INSERT INTO usuarios (nome, email, usuario, telefone, senha) VALUES (:NOME, :EMAIL, :USUARIO, :TELEFONE, :SENHA)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":NOME", $nome);
        $stmt->bindParam(":EMAIL", $email);
        $stmt->bindParam(":USUARIO", $usuario);
        $stmt->bindParam(":TELEFONE", $telefone);
        $stmt->bindParam(":SENHA", $senha);
        if ($stmt->execute()) {
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
                $mail->addAddress($email, 'Abraão');
        
                // Conteúdo do e-mail
                $mail->isHTML(true); // Permite HTML
                $mail->Subject = 'Email';
                $mail->Body    = 'Email criado';
        
                // Envia o e-mail
                $mail->send();
                echo 'E-mail enviado com sucesso';
            } catch (Exception $e) {
                echo "O e-mail não pôde ser enviado. Erro: {$mail->ErrorInfo}";
            }
            header("Location: /projeto/indexh.php");
            exit();
        } else {
            echo "<script>alert('Erro ao cadastrar usuário'); window.location.href='cadastro.php';</script>";
        }
    }
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="estilos/cadastro.css">
</head>
<body>
    <section>
        <form id="formCadastro" action="cadastro.php" method="post">
            <fieldset>
                <legend><h2 style="color: rgb(255, 255, 255); font-size: 25pt;">Dados</h2></legend>
                <strong>
                <label>Nome:</label>
                <input type="text" class="cadastro_input" name="nome" placeholder="Digite seu nome" required>
                <br><br><br>
                <label>E-mail:</label>
                <input type="text" class="cadastro_input" name="email" id="email" placeholder="Digite seu email" required>
                <br><br><br>
                <label>Usuário:</label>
                <input type="text" class="cadastro_input" name="usuario" id="usuario" placeholder="Digite um usuário" required>
                <!-- <button type="button" class="check" id="check">Checar</button> -->
                <br><br><br>
                <label>Telefone:</label>
                <input type="tel" class="cadastro_input" name="telefone" placeholder="Digite seu telefone" required>
                <br><br><br>
                <label>Senha:</label>
                <input type="password" class="cadastro_input" name="senha" placeholder="Digite sua senha" required>
                <br><br><br>
                <input type="submit" class="login_entrar" value="Cadastrar" id="cad">
                </strong>
            </fieldset>
        </form>
    </section>
</body>
</html>
