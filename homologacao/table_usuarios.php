<?php

session_start();
include_once("conexao.php");

$usuario = $_SESSION['username'];

$sql = 'SELECT * FROM usuarios WHERE usuario = :USUARIO';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':USUARIO',$usuario);
$stmt->execute();
$user =$stmt->fetch(PDO::FETCH_ASSOC);

    if($user['adm'] == "S"){
        $sql ="SELECT id,nome,email,usuario,telefone,adm,Ativo FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
            
            if($stmt->rowCount()>0){

                echo "
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'>
                <aside>
            </aside>
            <script src='scripts/form_mudar.js'></script>";

                echo "<table height='100%' width='100%' class='table_usuarios' border ='1'>";
                echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Usuário</th><th>Telefone</th><th>Adm</th><th>Ativo</th></tr>";
                
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['nome'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['usuario'] . "</td>";
                    echo "<td>" . $row['telefone'] . "</td>";
                    echo "<td>" . $row['adm'] . "</td>";
                    echo "<td>" . $row['Ativo'] . "</td>";
                    echo "</tr>";

                    }
            echo "</table>";
        } else{
            echo "Nenhum resultado encontrado";
        }
    }            
?>