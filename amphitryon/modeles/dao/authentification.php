<?php
require_once 'param.php';
require_once 'UserDAO.php';

//$_POST['login']= "nm";
//$_POST['mdp'] = "test";

print(json_encode(UserDAO::authentification($_POST['login'], $_POST['mdp'])));
