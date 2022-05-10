<?php
require_once 'param.php';
require_once 'UserDAO.php';

$i=UserDAO::idPlat($_POST['selected']);

foreach($i as $is){
    foreach($is as $po){
        echo $po;
        $_POST['plat']=$po;
        var_dump($_POST['plat']);
        print(json_encode(UserDAO::commandePlat(json_decode($_POST['idCommandeValider']),$_POST['plat'],$_POST['quantitee'],$_POST['infos'])));
    }
}