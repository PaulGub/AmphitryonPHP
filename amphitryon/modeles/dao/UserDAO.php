<?php

require_once 'DBConnex.php';

class UserDAO{
	public static function authentification($login , $mdp){
		try{
			$sql = "select iduser, nom , prenom , tel ,
			mail, statut from utilisateur 
			where mail= :login and mdp = :mdp " ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$mdp =  md5($mdp);
			$requetePrepa->bindParam("login", $login);
			$requetePrepa->bindParam("mdp", $mdp);
			$requetePrepa->execute();
			$reponse = $requetePrepa->fetch(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			$reponse = "";
		}
		return $reponse;
	}
}