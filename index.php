<?php

require_once("config.php");

//Carrega um usuário
//$root = new User();
//$root->loadById(12);
//echo $root;

//Carrega uma lista de usuário
//$list = User::getList();
//echo json_encode($list);

//Carrega uma lista de usuários buscando pelo login
//$search = User::search("root");
//echo json_encode($search);

//Faz login
//$user = new User();
//$user->login("root","!##$");

//echo $user;

$estudante = new User();
$estudante->setDeslogin("aluno");
$estudante->setDessenha("@alun0");
$estudante->insert();

echo $estudante;

?>