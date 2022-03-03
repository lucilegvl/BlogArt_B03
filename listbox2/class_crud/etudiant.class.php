<?php
// CRUD ETUDIANT (PARTIEL)
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class ETUDIANT{
	function get1Etudiant(string $numEtu) {
		global $db;

		$query = 'SELECT * FROM ETUDIANT WHERE numEtu = ?;';
		$result = $db->prepare($query);
		$result->execute([$numEtu]);
		return($result->fetch());
	}

	function get1EtudiantByClas(string $numEtu) {
		global $db;

		$query = 'SELECT * FROM ETUDIANT ET INNER JOIN CLASSE CL ON ET.numClas = CL.numClas WHERE numEtu = ?;';
		$result = $db->prepare($query);
		$result->execute([$numEtu]);
		return($result->fetch());
	}

	function getAllEtudiants() {
		global $db;

		$query = 'SELECT * FROM ETUDIANT;';
		$result = $db->query($query);
		$allEtudiants = $result->fetchAll();
		return($allEtudiants);
	}

	function getAllEtudiantsByClas() {
		global $db;

		$query = 'SELECT * FROM ETUDIANT ET INNER JOIN CLASSE CL ON ET.numClas = CL.numClas;';
		$result = $db->query($query);
		$allEtudiantsByClas = $result->fetchAll();
		return($allEtudiantsByClas);
	}

	// Récupérer la prochaine PK de la table ETUDIANT
	function getNextNumEtu() {
		global $db;

		$requete = "SELECT MAX(numEtu) AS numEtu FROM ETUDIANT;";
		$result = $db->query($requete);

		if ($result) {
			$tuple = $result->fetch();
			$numEtu = $tuple["numEtu"];
			// No PK suivante ETUDIANT
			$numEtu++;
		}   // End of if ($result)
		return $numEtu;
	} // End of function

}		// End of class
