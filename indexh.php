<?php
session_start();
include_once("homologacao/conexao.php");

if (!isset($_SESSION['username'])) {
    header("Location: homologacao/login.php");
    exit();
}

$usuario = $_SESSION['username'];

$sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':USUARIO',$usuario);
$stmt->execute();
$user =$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Olá</title>
        <link rel="stylesheet" href="homologacao/estilos/index.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <a href="homologacao/logout.php"><button class="btn_form">Sair</button></a>
    </head>
    <body>
        <center>
                <h1 >Olá <?php echo $user['nome']; ?></h1>
            <br><br>
            <section>
                <form action="homologacao/editar.php" id="form_editar" mehtod="GET">
                    <table>
                        <thead>
                            <td>Dados</td>
                            <td></td>
                            <td></td>
                        </thead>
                        <tr id="linha_dados">
                            <td>Nome:</td>
                            <td id="nome" class="dado"><?php echo $user['nome'];?></td>
                            <td class="new_dado" style="display: none;">Novo nome: <input type="text" name="new_nome" id="new_name"></td>
                        </tr>
                        <br>
                        <tr id="linha_dados">
                            <td>Email:</td>
                            <td id="email" class="dado"><?php echo $user['email']; ?></td>
                            <td class="new_dado" style="display: none;">Novo Email: <input type="text" name="new_email" id="new_email"></td>
                        </tr>
                        <br>
                        <!--<tr id="linha_dados">
                            <td>Usuario:</td>
                            <td id="usuario" class="dado"><?php //echo $user['usuario']; ?></td>
                            <td class="new_dado" style="display: none;">Novo usuario: <input type="text" name="new_name" id="new_name"></td>
                        </tr>
                        <br>-->
                        <tr id="linha_dados">
                            <td>Telefone:</td>
                            <td id="telefon" class="dado"><?php echo $user['telefone']; ?></td>
                            <td class="new_dado" style="display: none;">Novo Telefone: <input type="text" name="new_telefone" id="new_name"></td>
                        </tr>
                        <tr style="height: 30px;">
                            <td></td>
                            <td></td>
                            <td><input type="submit" style="display: none; " class="btn_form" id="salvar" onclick="salvar()" value="Salvar" ></td>
                        </tr>
                    </table>
                    <br>
                    <div>
                        <input type="button" onclick="mostrar()"  class="btn_form" value="Alterar dados">
                    </div>
                </form>
                <br>
            </section>
            <br>
            <?php
                if($user['adm'] == "S"){
                    echo "<iframe src='homologacao/table_usuarios.php' frameborder='0' height='500px' width='60%'></iframe>";
                }
                ?>
        </center>
    <script src="homologacao/scripts/index.js"></script>
    </body>
</html>