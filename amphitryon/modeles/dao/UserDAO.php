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

	public static function commande($date , $heure, $etat, $table){
		try{
			$sql = "INSERT INTO commande (Date_C, heureCommande, etatCommande, numTable) VALUES (:date, :heure, :etat, :table);" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("date", $date);
			$requetePrepa->bindParam("heure", $heure);
			$requetePrepa->bindParam("etat", $etat);
			$requetePrepa->bindParam("table", $table);
			$requetePrepa->execute();
			return "SUCCES";
		}catch(Exception $e){
			return "ECHEC";
		}
	}
}