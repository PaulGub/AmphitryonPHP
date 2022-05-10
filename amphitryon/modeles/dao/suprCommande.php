<?php
require_once 'param.php';
require_once 'UserDAO.php';


print(json_encode(UserDAO::supprimerCommande($_POST['idCommande'])));