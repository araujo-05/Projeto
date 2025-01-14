<?php
session_start();
include_once("scripts_php/conexao.php");

$usuario = $_SESSION['username'];

// Carrega os dados do usuário 
$sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':USUARIO', $usuario);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$total_usuarios = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link rel="icon" href="imagens/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <script src="scripts/jquery-3.6.0.min.js"></script>
</head>

<body class="body_usuario">
    <div>
        <h1>Olá <?php echo $user['nome']; ?></h1>
        <br>
        <nav class="nav_index">
            <ul>
                <li><a href="dados.php" id="nav_home" class="nav_home">Home</a></li>
                <li><a href="busca.php" class="nav_home">Busca</a></li>
                <?php
                if ($user['adm'] == "S") {
                    echo "<li><a href='usuarios.php' id='nav_usuarios' class='nav_usuarios'>Usuários</a></li>";
                }
                ?>
                <li><a href="scripts_php/logout.php">Sair</a></li>
            </ul>
        </nav>
    </div>
    <br>
    <form class="busca_usuario">
        <input type="text" name="busca" id="busca" placeholder="Buscar usuário">
        <button class="btn_buscar" id="buscar">
            <img src="imagens/lupa.png" alt="Buscar" style="height: 100%; width: 100%;">
        </button>
    </form>

    <br>
    <table width='80%' class='table_usuarios' border='1'>
        <thead>
            <th>ID</th>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>USUÁRIO</th>
            <th>TELEFONE</th>
            <th>ADM</th>
            <th>ATIVO</th>
            <th></th>
        </thead>
        <tbody class="main_usuarios">
        <?php
        if ($user['adm'] == "S") {
            $sql = "SELECT id, nome, email, usuario, telefone, adm, Ativo FROM usuarios";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr calss='tr_usuarios'>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['usuario'] . "</td>";
                    echo "<td>" . $row['telefone'] . "</td>";
                    echo "<td>";
                    echo $row['adm'] == "S" ? "<input type='checkbox' checked>" : "<input type='checkbox'>";
                    echo "</td>";
                    echo "<td>";
                    echo $row['Ativo'] == "S" ? "<input type='checkbox' checked>" : "<input type='checkbox'>";
                    echo "</td>";
                    echo "<td><form method='post' action='scripts_php/excluir.php'><input type='hidden' name='id' value=" . $row['id'] . "><button id='apagar'><img height='20px' width='20px' src='imagens/icone-lixeira.png'></button></form></td>";
                    echo "</tr>";
                    $total_usuarios++;
                }
                echo "<tr>
                        <td colspan='7'><strong>Total</strong></td>
                        <td><strong>".$total_usuarios."</strong></td>
                    </tr>";

            } else {
                echo "<tr><td colspan='8'>Nenhum resultado encontrado</td></tr>";
            }
        }
        ?>
        </tbody>
            <td height="80px" colspan="8">
                <form class="add_usuario" action="add_usuario.php" method="post">
                    <input type="text" name="nome" class="nome_add" id="nome_add" placeholder="Nome" required>
                    <input type="text" name="email" class="email_add" id="email_add" placeholder="Email" required>
                    <input type="text" name="usuario" class="usuario_add" id="usuario_add" placeholder="Usuário" required>
                    <input type="number" name="telefone" class="telefone_add" id="telefone_add" placeholder="Telefone" required>
                    <input type="text" name="senha" class="senha_add" id="senha_add" placeholder="Senha" required>
                    <label for="ADM">ADM:<input type="checkbox" name="adm" id="adm" value="S"></label>
                    <input type="submit" name="add" id="add" value="Adicionar">
                </form>
            </td>
        </tfoor>
    </table>

    <div class="erro_cadastro"></div>
    <div class="loading" style="display: none;">
        <span></span>
        <p>Carregando...</p>
    </div>

    <script>
        $(document).ready(function() {
            $('#buscar').click(function(event){
                event.preventDefault();

                const busca = $('#busca').val();

                $.ajax({
                    url: 'scripts_php/busca_usuario.php',
                    type: 'POST',
                    data: { busca: busca},
                    success: function(response){
                        $('.main_usuarios').html(response);
                        $('.tr_usuarios').hide();
                        $('.tr_busca').show();
                    }
                });

            });
            $('#add').click(function(event) {
                event.preventDefault(); // Impede o envio tradicional do formulário

                // Exibe a div de loading
                $('.loading').show();

                // Captura os valores dos campos de entrada
                const nome = $('#nome_add').val();
                const email = $('#email_add').val();
                const usuario = $('#usuario_add').val();
                const telefone = $('#telefone_add').val();
                const senha = $('#senha_add').val();
                const adm = $('#adm').is(':checked') ? 'S' : 'N';

                // Faz uma requisição AJAX para o script PHP
                $.ajax({
                    url: 'scripts_php/add_usuario.php',
                    type: 'POST',
                    data: { 
                        nome: nome,
                        email: email,
                        usuario: usuario,
                        telefone: telefone,
                        senha: senha,
                        adm: adm
                    },
                    success: function(response) {
                        // Exibe a resposta do PHP na div .erro_cadastro e oculta o loading
                        $('.erro_cadastro').html(response);
                        $('.loading').hide();
                    },
                    error: function() {
                        $('.erro_cadastro').html('Erro ao verificar o usuário.');
                        $('.loading').hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
