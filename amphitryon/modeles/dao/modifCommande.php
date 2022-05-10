<?php
require_once 'param.php';
require_once 'UserDAO.php';

$i=UserDAO::idPlat($_POST['idPlat']);
$a=UserDAO::idEtatPlat($_POST['etatPlat']);

foreach($i as $is){
    foreach($is as $po){
        echo "plat".$po."<br>";
        $_POST['idPlat']=$po;
        foreach($a as $ap){
            foreach($ap as $lo)
            echo "etat".$lo;
            $_POST['etatPlat']=$lo;
            var_dump($_POST['idPlat']);
            var_dump($_POST['etatPlat']);
            print(json_encode(UserDAO::modifCommande($_POST['idCommande'],$_POST['idPlat'],$_POST['quantiteeDemandee'],$_POST['infosComplementaires'],$_POST['etatPlat'])));
        }
        
    }
}