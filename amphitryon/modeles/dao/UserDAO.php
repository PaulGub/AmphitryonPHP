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

	public static function commande($table){
		try{
			$sql = "INSERT INTO commande (dateHeureCommande, etatCommande, numTable) VALUES (NOW(), 1, :table);" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("table", $table);
			$requetePrepa->execute();
			return  DBConnex::getInstance()->lastInsertId();
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	public static function commandePlat($idcommande, $plat , $quantitee, $infos){
		try{
			$sql = "INSERT INTO `platcommander` (`idCommande`, `idPlat`, `quantiteedemandee`, `infosComplementaires`, `etatPlat`) VALUES (:id, :plat, :quantitee, :infos, 1);" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("id",$idcommande);
			$requetePrepa->bindParam("plat", $plat);
			$requetePrepa->bindParam("quantitee", $quantitee);
			$requetePrepa->bindParam("infos", $infos);
			$requetePrepa->execute();
			return  DBConnex::getInstance()->lastInsertId();
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
}