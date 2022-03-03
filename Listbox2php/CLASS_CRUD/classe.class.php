<?php
// CRUD CLASSE (PARTIEL)
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class CLASSE{
	function get1Classe(string $numClas){
		global $db;

		$query = 'SELECT * FROM CLASSE WHERE numClas = ?;';
		$result = $db->prepare($query);
		$result->execute([$numClas]);
		return($result->fetch());
	}

	function getAllClasses(){
		global $db;

		$query = 'SELECT * FROM CLASSE;';
		$result = $db->query($query);
		$allClasses = $result->fetchAll();
		return($allClasses);
	}

	function getAllClassesByLibClas(){
		global $db;

		$query = 'SELECT * FROM CLASSE ORDER BY libClas;';
		$result = $db->query($query);
		$allClasses = $result->fetchAll();
		return($allClasses);
	}

	// Fonction pour recupérer la dernière PK de CLASSE
	function getLastNumClas(){
		global $db;

		$requete = "SELECT MAX(numClas) AS numClas FROM CLASSE;";
		$result = $db->query($requete);

		if ($result) {
			$tuple = $result->fetch();
			$lastNumClas = $tuple["numClas"];
		}   // End of if ($result)
		return $lastNumClas;
	} // End of function

}	// End of class
