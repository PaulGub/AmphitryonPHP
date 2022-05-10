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

	public static function commandePlat($idCommandeValider, $plat , $quantitee, $infos){
		try{
			$sql = "INSERT INTO `platcommander` (`idCommande`, `idPlat`, `quantiteedemandee`, `infosComplementaires`, `etatPlat`) VALUES (:idCommandeValider, :plat, :quantitee, :infos, 1);" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("idCommandeValider", $idCommandeValider);
			$requetePrepa->bindParam("plat", $plat);
			$requetePrepa->bindParam("quantitee", $quantitee);
			$requetePrepa->bindParam("infos", $infos);
			return $requetePrepa->execute();
		
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	public static function ListePlat(){
		try{
			$sql = "SELECT platproposer.idPlat, plat.nomPlat
			FROM platproposer, plat
			WHERE plat.idPlat = platproposer.idPlat; " ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->execute();
			$reponse = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			$reponse = "";
		}
		return $reponse;
	}

	public static function modifCommande($idCommande, $idPlat , $quantiteeDemandee, $infosComplementaires, $etatPlat){
		try{
			$sql = "UPDATE `platcommander` SET `idPlat` = :idPlat, `quantiteedemandee` = :quantiteeDemandee, `infosComplementaires` = :infosComplementaires, `etatPlat` = :etatPlat WHERE `platcommander`.`idCommande` = :idCommande AND `platcommander`.`idPlat` = :idPlat;" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("idCommande", $idCommande);
			$requetePrepa->bindParam("idPlat", $idPlat);
			$requetePrepa->bindParam("quantiteeDemandee", $quantiteeDemandee);
			$requetePrepa->bindParam("infosComplementaires", $infosComplementaires);
			$requetePrepa->bindParam("etatPlat", $etatPlat);
			return $requetePrepa->execute();
		
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	public static function supprimerCommande($idCommande){
		try{
			$sql = "DELETE FROM `commande` WHERE `commande`.`idCommande` = :idCommande;" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("idCommande", $idCommande);
			return $requetePrepa->execute();
		
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	public static function paiementCommande($idCommande){
		try{
			$sql = "UPDATE `commande` SET `etatCommande` = '2' WHERE `commande`.`idCommande` = :idCommande;" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("idCommande", $idCommande);
			return $requetePrepa->execute();
		
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	public static function etatPlat($etatPlat, $idCommande, $idPlat){
		try{
			$sql = "UPDATE `platcommander` SET `etatPlat` = :etatPlat WHERE `platcommander`.`idCommande` = :idCommande AND `platcommander`.`idPlat` = :idPlat ;" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("etatPlat", $etatPlat);
			$requetePrepa->bindParam("idCommande", $idCommande);
			$requetePrepa->bindParam("idPlat", $idPlat);
			return $requetePrepa->execute();
		
		}catch(Exception $e){
			return $e->getMessage();
		}
	}

	public static function afficherCommande(){
		try{
			$sql = "SELECT commande.idCommande, plat.nomPlat, platcommander.quantiteedemandee, platcommander.infosComplementaires, commande.dateHeureCommande, commande.numTable, etat_plat.libellePlat, etat_commande.libelleCommande
			FROM plat, platcommander, platproposer, commande, etat_plat, etat_commande
			WHERE platcommander.idPlat = platproposer.idPlat
			AND platproposer.idPlat = plat.idPlat
			AND platcommander.idCommande=commande.idCommande
            AND platcommander.etatPlat= etat_plat.id
            AND commande.etatCommande = etat_commande.id
			/*AND commande.idCommande=:idCommande;  */"
			;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			//$requetePrepa->bindParam("idCommande", $idCommande);
			$requetePrepa->execute();
			$reponse = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			$reponse = "";
		}
		return $reponse;
	}

	public static function idPlat($selected){
		try{
			$sql = "SELECT plat.idPlat 
			FROM plat
			WHERE plat.nomPlat=:selected; " ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("selected", $selected);
			$requetePrepa->execute();
			$reponse = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			$reponse = "";
		}
		return $reponse;
	}

	public static function listeCommande(){
		try{
			$sql = "SELECT idCommande
			FROM commande;" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->execute();
			$reponse = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			$reponse = "";
		}
		return $reponse;
	}

	public static function listeEtatPlat(){
		try{
			$sql = "SELECT libellePlat 
			FROM etat_plat;" ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->execute();
			$reponse = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			$reponse = "";
		}
		return $reponse;
	}

	public static function idEtatPlat($etatPlat){
		try{
			$sql = "SELECT id 
			FROM etat_plat
			WHERE libellePlat=:idEtatPlat; " ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->bindParam("idEtatPlat", $etatPlat);
			$requetePrepa->execute();
			$reponse = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			$reponse = "";
		}
		return $reponse;
	}

	public static function commandeNonPayer(){
		try{
			$sql = "SELECT idCommande
			FROM commande
			WHERE etatCommande = 1; " ;
			$requetePrepa = DBConnex::getInstance()->prepare($sql);
			$requetePrepa->execute();
			$reponse = $requetePrepa->fetchAll(PDO::FETCH_ASSOC);
		}catch(Exception $e){
			$reponse = "";
		}
		return $reponse;
	}
}