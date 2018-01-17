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

    public static function getList(){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuario ORDER BY des_login;");
    }

    public static function search($login){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuario WHERE des_login LIKE :SEARCH ORDER BY des_login;", array(
            ":SEARCH"=>"%".$login."%" 
        ));
    }

    public function login($login, $password){

        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_usuario WHERE des_login = :LOGIN AND des_senha = :PASSWORD;", array(
            ":LOGIN" =>$login,
            ":PASSWORD"=>$password  
        ));

        if(count($result) > 0){

            $data = $result[0];
            $this->setData($data);
        }
        else {
            
            throw new Exception("Login e/ou Senha inválidos.");
        }
    } 

    public function loadById($id){

        $sql = new Sql();
        $result = $sql->select("SELECT * FROM tb_usuario WHERE id_usuario = :ID", array(
            ":ID"=>$id
        )); 

        if(count($result) > 0){

            //Recebe a linha do id
            $data = $result[0];
            $this->setData($data);
        }
    }

    private function setData($data){

        //Seto nos métodos os valores do banco de dados
        $this->setIdUsuario($data['id_usuario']);
        $this->setDeslogin($data['des_login']);
        $this->setDessenha($data['des_senha']);
        $this->setDtCadastro(new DateTime($data['dt_cadastro']));
    }

    public function insert(){

        $sql = new Sql();

        $result = $sql->select("CALL sp_usuario_insert(:LOGIN,:PASSWORD)", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha()
        ));

        if(count($result) > 0){
            $data = $result[0];
            $this->setData($data);
        }
    }

    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuario SET des_login = :LOGIN, des_senha = :PASSWORD WHERE id_usuario = :ID", array(
            ":LOGIN"=>$this->getDeslogin(),
            ":PASSWORD"=>$this->getDessenha(),
            ":ID"=>$this->getIdUsuario()
        ));
    }

    public function delete(){

        $sql = new Sql();
        $sql->query("DELETE FROM tb_usuario WHERE id_usuario = :ID",array(
            ":ID"=>$this->getIdUsuario()
        ));

        $this->setIdUsuario(0);
        $this->setIdUsuario("");
        $this->setIdUsuario("");
        $this->setIdUsuario(new DateTime());
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