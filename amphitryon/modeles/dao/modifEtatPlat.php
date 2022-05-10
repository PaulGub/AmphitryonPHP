<?php
require_once 'param.php';
require_once 'UserDAO.php';

print(json_encode(UserDAO::etatPlat($_POST['etatPlat'],$_POST['idCommande'],$_POST['idPlat'])));