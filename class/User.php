<?php

class User {

    private $id_usuario;
    private $des_login;
    private $des_senha;
    private $dt_cadastro;


    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getIdUsuario(){
        return $this->id_usuario;
    }

    public function setDeslogin($des_login){
         $this->des_login = $des_login;
    }

    public function getDeslogin(){
        return $this->des_login;
    }

    public function setDessenha($des_senha){
        $this->des_senha = $des_senha;
    }

    public function getDessenha(){
        return $this->des_senha;
    }

    public function setDtCadastro($dt_cadastro){        
        $this->dt_cadastro = $dt_cadastro;
    }

    public function getDtCadastro(){  
        return $this->dt_cadastro;
    
    }

    public function loadById($id){

        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_usuario WHERE id_usuario = :ID", array(
            ":ID"=>$id
        )); 

        if(count($result) > 0){

            //Recebe a linha do id
            $row = $result[0];

            //Seto nos métodos os valores do banco de dados
            $this->setIdUsuario($row['id_usuario']);
            $this->setDeslogin($row['des_login']);
            $this->setDessenha($row['des_senha']);
            $this->setDtCadastro(new DateTime($row['dt_cadastro']));
        }
    }

    public function __toString(){

        return json_encode(array(
            "id_usuario"=>$this->getIdUsuario(),
            "des_login"=>$this->getDeslogin(),
            "des_senha"=>$this->getDessenha(),
            "dt_cadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
        ));
    }
}
?>