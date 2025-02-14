<?php
session_start();
include_once("scripts_php/conexao.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$usuario = $_SESSION['username'];

$sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':USUARIO',$usuario);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="icon" href="imagens/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="estilos/style.css">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
            <div>
                <h1 >Olá <?php echo $user['nome']; ?></h1>
                <br>
                <nav class="nav_index">
                    <ul>
                        <li><a href="dados.php" id="nav_home" class="nav_home">Home</a></li>
                        <li><a href="busca.php" class="nav_home">Busca</a></li>
                        <?php
                            if($user['adm'] == "S"){
                                echo "<li><a href='usuarios.php' id='nav_usuarios' class='nav_usuarios'>Usuários</a></li>";
                                //echo "<li><a href='homologacao/cadastro.php' id='nav_cadastro' class='nav_cadastro'>Cadastro</a></li>";
                            }
                        ?>
                        <li><a href="scripts_php/logout.php">Sair</a></li>
                    </ul>
                </nav>
            </div>
    </head>
    <br>
    <body>
        <br>
        <section>
            <div class="saldo" id="m_saldo"></div>
        </section>
    <script src="scripts/index.js"></script>
    </body>
</html>