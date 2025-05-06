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
            "INSERT INTO usuario (nome, email, senha, imagem)
            VALUES (:nome, :email, :senha, :imagem)"
        );
        $sql->bindValue(":nome", $obj->getNome());
        $sql->bindValue(":email", $obj->getEmail());
        $sql->bindValue(":senha", $obj->getSenha());
        $sql->bindValue(":imagem", $obj->getImagem());
        return $sql->execute();
    }
    public function listar(){
        $sql = $this->conexao->prepare(
            "SELECT * FROM usuario");
        $sql->execute();
        return $sql->fetchAll();
    }
    public function login(usuario $obj){
        $sql= $this->conexao->prepare("
        SELECT * FROM usuario WHERE email=:email");
        $sql->bindValue(":email", $obj->getEmail());
        $sql->execute();
        if($sql->rowCount()>0){
            //tem alguem com esse email
            while($retorno = $sql->fetch()){
                if($retorno["senha"] == $obj->getSenha()){
                    return $retorno; //email e senha ok
                }
            }
            return 1; //senha nao bate
        }
        else{
            return 0; //email nao cadastrado
        }
    }
    public function retornarUnico($id){
        $sql = $this->conexao->prepare("
            SELECT * FROM usuario WHERE id=:id
        ");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetch();
    }
    public function editar(usuario $obj){
        $sql = $this->conexao->prepare(
            "UPDATE usuario SET
            nome=:nome, senha=:senha, email=:email 
            WHERE id=:id"
        );
        $sql->bindValue(":nome", $obj->getNome());
        $sql->bindValue(":email", $obj->getEmail());
        $sql->bindValue(":senha", $obj->getSenha());
        $sql->bindValue(":id", $obj->getId());
        return $sql->execute();
    }
    public function delete($id){
        $sql = $this->conexao->prepare("
            DELETE FROM usuario WHERE id=:id
        ");
        $sql->bindValue(":id", $id);
        return $sql->execute();
    }

}