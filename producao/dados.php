<?php

session_start();
include_once("conexao.php");
include_once("config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$querys = new Sql();
$usuario = $_SESSION['username'];

// $user = $querys->select('SELECT * FROM usuarios WHERE usuario = :USUARIO', array(":USUARIO" => $usuario));
// echo json_encode($user);

$sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
 $stmt = $conn->prepare($sql);
 $stmt->bindParam(':USUARIO',$usuario);
 $stmt->execute();
 $user =$stmt->fetch(PDO::FETCH_ASSOC)
 /*if(count($row) > 0)
     $user = array(
         "Nome" => $row['nome'],
         "Email" => $row['email'],
         "Telefone" => $row['telefone']
     )
     echo "<table class='dados_home' border='1px'>";
     foreach ($user as $key=> $value) {
         echo "<tr>";
         echo "<td> ". $key . "</td><td>" .$value . "</td>";
         echo "</tr>";
     }
     echo "</table>";
 }
     */

?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dados</title>
            <link rel="icon" href="imagens/logo.png" type="image/x-icon">
            <link rel="stylesheet" href="estilos/style.css">
            <div>
                <h1 >Olá <?php echo $user['nome']; ?></h1>
                <br>
                <nav class="nav_index">
                    <ul>
                        <li><a href="dados.php" id="nav_home" class="nav_home">Home</a></li>
                        <?php
                            if($user['adm'] == "S"){
                                echo "<li><a href='usuarios.php' id='nav_usuarios' class='nav_usuarios'>Usuários</a></li>";
                                //echo "<li><a href='cadastro.php' id='nav_cadastro' class='nav_cadastro'>Cadastro</a></li>";
                            }
                        ?>
                        <li><a href="logout.php">Sair</a></li>
                    </ul>
                </nav>
            </div>
        </head>
        <body>
            <section>
                <form action="editar.php" id="form_editar" mehtod="GET">
                    <table class="table_dados">
                        <thead>
                            <td colspan="3">Dados</td>
                        </thead>
                        <tr height="20px"></tr>
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
                        <!-- <tr id="linha_dados">
                            <td>Usuario:</td>
                            <td id="usuario" class="dado"><?php //echo $user['usuario']; ?></td>
                            <td class="new_dado" style="display: none;">Novo usuario: <input type="text" name="new_name" id="new_name"></td>
                        </tr>
                        <br> -->
                        <tr id="linha_dados">
                            <td>Telefone:</td>
                            <td id="telefon" class="dado"><?php echo $user['telefone']; ?></td>
                            <td class="new_dado" style="display: none;">Novo Telefone: <input type="text" name="new_telefone" id="new_name"></td>
                        </tr>
                        <tr style="height: 30px;">
                            <td colspan="3"><input type="submit" style="display: none; " class="btn_form" id="salvar" onclick="salvar()" value="Salvar" ></td>
                        </tr>
                    </table>
                    <br>
                    <div>
                        <input type="button" onclick="mostrar()"  class="btn_form" value="Alterar dados">
                    </div>
                </form>
                <br>
            </section>
            <script src="scripts/index.js"></script>
        </body>
    </html>