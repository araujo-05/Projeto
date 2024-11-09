<?php

include_once("conexao.php");
session_start();

if(isset($_SESSION['username'])){
    $usuario = $_SESSION['username'];
}

$sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
$stmt = $conn->prepare($sql);
$stmt->bindParam(":USUARIO", $usuario);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link rel="icon" href="imagens/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="estilos/style.css">
        <script src="scripts/jquery-3.6.0.min.js"></script>
        
    </head>
    <br>
    <body class="body_cadastro">
        <section class="main_cadastro">
            <form id="formCadastro" action="add_usuario.php" method="post">
                    <legend><h2 style="color: rgb(255, 255, 255); font-size: 25pt;"></h2></legend>
                    <strong>
                    <label class="label_cadastro">Nome:</label>
                    <input type="text" class="cadastro_input" name="nome" placeholder="Digite seu nome" required>
                    <br><br><br>
                    <label class="label_cadastro">E-mail:</label>
                    <input type="text" class="cadastro_input" name="email" id="email" placeholder="Digite seu email" required>
                    <br><br><br>
                    <label class="label_cadastro">Usuário:</label>
                    <input type="text" class="cadastro_input" name="usuario" id="usuario" placeholder="Digite um usuário" required>
                    <br><br>    
                    <button type="button" class="check" id="check">Checar</button>
                    <br><br>
                    <div class="aviso"></div>
                    <br>
                    <label class="label_cadastro">Telefone:</label>
                    <input type="tel" class="cadastro_input" name="telefone" placeholder="Digite seu telefone" required>
                    <br><br><br>
                    <label class="label_cadastro">Senha:</label>
                    <input type="password" class="cadastro_input" name="senha" placeholder="Digite sua senha" required>
                    <br><br><br>
                    <center><input type="submit" class="btn_form_cadastro" value="Cadastrar" id="cad"> 
                    <div class="loader hidden" id="loader"></div></center>
                    </strong>
            </form>
        </section>
        <script>
            $(document).ready(function() {
            $('#check').click(function() {
                // Captura o valor do campo de entrada
                const usuario = $('#usuario').val();

                // Faz uma requisição AJAX para o script PHP
                $.ajax({
                    url: 'verificar_usuario.php', // Caminho para o arquivo PHP
                    type: 'POST',
                    data: { usuario: usuario },
                    success: function(response) {
                        // Exibe a resposta do PHP na div .aviso
                        $('.aviso').html(response);
                    },
                    error: function() {
                        $('.aviso').html('Erro ao verificar o usuário.');
                    }
                });
            });
        });
        </script>
    </body>
</html>
