<?php
require_once 'param.php';
require_once 'UserDAO.php';

print(json_encode(UserDAO::commande($_POST['table'])));