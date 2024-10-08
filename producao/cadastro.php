<?php

session_start();
include_once("conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){


    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];

    //Verificando se já tem algum usuario com esse login
    $sql = 'SELECT id FROM usuarios WHERE usuario = :USUARIO';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":USUARIO", $usuario);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $_SESSION['mensagem'] = "Usuário já existe!";
        header("Location: cadastro.php");
        exit();
    } else{
        $sql = "INSERT INTO usuarios VALUES(:NOME, :EMAIL, :USUARIO, :TELEFONE, :SENHA)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":NOME", $nome);
        $stmt->bindParam(":EMAIL", $email);
        $stmt->bindParam(":USUARIO", $usuario);
        $stmt->bindParam(":TELEFONE", $telefone);
        $stmt->bindParam(":SENHA", $senha);

        echo "<script> alert('USUARIO CADASTRADO COM SUCESSO') </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link rel="stylesheet" href="estilos/cadastro.css">
        <div>
            <a href="login.php" style="display: flex;"><button > Voltar</button></a>
            <h2 style="display: flex;">Faça parte você também</h2> 
        </div>
    </head>
    <body>
        <section>
            <form action="cadastro.php" method="post">
                <fieldset>
                    <legend><h2 style="color: rgb(255, 255, 255); font-size: 25pt;">Dados</h2></legend>
                    <strong>
                    <label>Nome:</label>
                    <input type="text" class="cadastro_input" name="nome" id="nome" placeholder="Digite seu nome" required>
                    <br><br><br>
                    <!-- <label>Sobrenome:</label>
                    <input type="text" class="cadastro_input" name="sobrenome" id="" placeholder="Digite seu sobrenome">
                    <br><br> -->
                    <label>E-mail:</label>
                    <input type="text" class="cadastro_input" name="email" id="email" placeholder="Digite seu email" required>
                    <br><br><br>
                    <label>Usuário:</label>
                    <input type="text" class="cadastro_input" name="usuario" id="usuario" placeholder="Digite um usuario" required>
                    <input type="button"class=check action="verificar_usuario.php" value="Checar" id="check" onclick="checar()"> 
                    <br><br><br>
                    <label>Telefone:</label>
                    <input type="tel" class="cadastro_input" name="telefone" id="telefone" placeholder="Digite seu telefone" required>
                    <br><br><br>
                    <label>Senha:</label>
                    <input type="password" class="cadastro_input" name="senha" id="senha" placeholder="Digite sua senha" required>
                    <br><br><br>
                    <!--<label>Confirmação de senha:</label>
                    <input type="text" class="cadastro_input" name="c_senha" id="" placeholder="Confirme a senha">
                    <br><br> -->
                    <input type="submit" class="login_entrar" value="Cadastrar" id="cad">
                    </strong>
                </fieldset>
            </form>
        </section>
    </body>
</html>