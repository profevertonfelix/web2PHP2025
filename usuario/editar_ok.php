<?php
    include_once "../class/usuario.class.php";
    include_once "../class/usuarioDAO.class.php";

    $obj = new usuario();
    $obj->setNome($_POST["nome"]);
    $obj->setEmail($_POST["email"]);
    $obj->setSenha($_POST["senha"]);
    $obj->setId($_POST["id"]);

    $objDAO = new usuarioDAO();
    $retorno = $objDAO->editar($obj);
    if($retorno)
        echo "Editado com sucesso";
    else
        echo "Erro ao editar";

?>