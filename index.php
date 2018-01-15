<?php

require_once("config.php");

$root = new User();

$root->loadById(12);

echo $root;

?>