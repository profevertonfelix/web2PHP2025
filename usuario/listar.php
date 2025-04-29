<?php
    include_once "../class/usuario.class.php";
    include_once "../class/usuarioDAO.class.php";

    $objDAO = new usuarioDAO();
    $retorno = $objDAO->listar();
?>
<table border>
    <thead>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
    </thead>
    <tbody>
        <?php
        foreach($retorno as $linha){
            echo "<tr>";
            echo "<td>".$linha["id"]."</td>";
            echo "<td>".$linha["nome"]."</td>";
            echo "<td>".$linha["email"]."</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>