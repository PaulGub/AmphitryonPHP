<?php
require_once 'param.php';
require_once 'UserDAO.php';

print(json_encode(UserDAO::commandePlat($_POST['plat'],$_POST['quantitee'],$_POST['infos'])));