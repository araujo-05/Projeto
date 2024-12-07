<?php

include_once('conexao.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $busca = "%". $_POST['busca'] ."%";
    $total_usuarios = 0;

    $sql ='SELECT * FROM usuarios WHERE CONCAT(nome, "", email, "", usuario, "", telefone, "") LIKE :BUSCA';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":BUSCA", $busca);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        while($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr class='tr_busca' >";
            echo "<td>" . $resultado['id'] . "</td>";
            echo "<td>" . $resultado['nome'] . "</td>";
            echo "<td>" . $resultado['email'] . "</td>";
            echo "<td>" . $resultado['usuario'] . "</td>";
            echo "<td>" . $resultado['telefone'] . "</td>";
            echo "<td>" . $resultado['adm'] . "</td>";
            echo "<td>" . $resultado['Ativo'] . "</td>";
            echo "<td><form method='post' action='excluir.php'><input type='hidden' name='id' value=" . $resultado['id'] . "><button id='apagar'><img height='20px' width='20px' src='imagens/icone-lixeira.png'></button></form></td>";
            echo "</tr>";
            $total_usuarios++;
        }
        echo "<tr>
                <td colspan='7'><strong>Total</strong></td>
                <td><strong>".$total_usuarios."</strong></td>
            </tr>";
    } else{
        echo"<tr><td colspan='8'>Nenhum usuário encontrado</td></tr>";
    }
}
exit();
?>

