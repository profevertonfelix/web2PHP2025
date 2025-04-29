<?php
include_once "usuario.class.php";
class usuarioDAO{
    private $conexao;
    public function __construct(){
        $this->conexao = new PDO(
            "mysql:host=localhost; dbname=bdeverton",
            "root", ""
        );
    }
    public function inserir(usuario $obj){
        $sql = $this->conexao->prepare(
            "INSERT INTO usuario (nome, email, senha)
            VALUES (:nome, :email, :senha)"
        );
        $sql->bindValue(":nome", $obj->getNome());
        $sql->bindValue(":email", $obj->getEmail());
        $sql->bindValue(":senha", $obj->getSenha());
        return $sql->execute();
    }
    public function listar(){
        $sql = $this->conexao->prepare(
            "SELECT * FROM usuario");
        $sql->execute();
        return $sql->fetchAll();
    }
}