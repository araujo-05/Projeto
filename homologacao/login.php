<?php
session_start();
include_once("conexao.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $usuariol = $_POST['usuariol'];
    $senha = $_POST['senha'];

    $sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':USUARIO', $usuariol);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user['usuario'] == $usuariol && $user['senha'] == $senha){

        $_SESSION['username'] = $user['usuario'];
        header("Location: /projeto/indexh.php");
        exit();

    } else{
        $_SESSION['msg'] = "Usuário ou senha inválida";
        //echo "<script>alert('Usuario ou senha incorreta');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="estilos/login.css" type="text/css">
    </head>
    <body>
        <div class="login_principal">
            <header>
                
            </header>
            <section>
                <center><form action="login.php" method="POST" class="login_form">
                    <div>
                        <label for="login" style="font-size: 15pt;"><strong>Login:</strong></label>
                        <br><br>
                        <input type="text" name="usuariol" placeholder="Digite seu usuário" id="usuario">
                    </div>
                    <br><br>
                    <div>
                        <label for="senha" style="font-size: 15pt;"><strong>Senha:</strong></label>
                        <br><br>
                        <input type="password" name="senha" placeholder="Digite sua senha" id="senha">
                    </div>
                    <br>
                    <div id="ent">
                        <a href="/index.php"><input type="submit" class="login_entrar" onclick="entrar()" id="login_entrar" value="Login" ></a>
                        <p style="display: none;">Usuário ou senha incorreta</p>
                    </div>
                    <br/><br>
                    <a href="cadastro.php" style="color: white;">Não tem cadastro? Clique aqui</a>
                </form></center>
            </section>
            <div>
                <footer>
                    <p>&copy;abraao.ar05@gmail.com</p>
                </footer>
            </div>
        </div> 
    </body>
</html>
