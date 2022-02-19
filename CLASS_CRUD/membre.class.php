<?php
// CRUD MEMBRE
// ETUD
// A tester sur Blog'Art
require_once __DIR__ . '../../CONNECT/database.php';

class MEMBRE{
	function get_1Membre($numMemb){
		global $db;

		// select
		$query = 'SELECT * FROM MEMBRE WHERE numMemb = ?';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numMemb]);

		return($result->fetch());
	}

	function get_1MembreByEmail($eMailMemb){
		global $db;

		// select
		$query = 'SELECT * FROM MEMBRE WHERE eMailMemb = ?';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$eMailMemb]);

		return($result->fetch());
	}

	function get_AllMembres(){
		global $db;

		// select
		$query = 'SELECT * FROM MEMBRE';
		// prepare
		$result = $db->query($query);
		// execute
		$allMembres = $result->fetchAll();

		return($allMembres);
	}

	function get_ExistPseudo($pseudoMemb) {
		global $db;

		// select
		$query = 'SELECT * FROM MEMBRE WHERE pseudoMemb = ?';
		// prepare
		$allNbPseudo = $db->prepare($query);
		// execute
		$allNbPseudo->execute([$pseudoMemb]);
		$count = $allNbPseudo->rowCount();

		return($count);
	}

	function get_AllMembersByStat(){
		global $db;

		// select
		$query = "SELECT * FROM MEMBRE ME INNER JOIN STATUT ST ON ME.idStat = ST.idStat";
		// prepare
		$result=$db->query($query);
		// execute
		$allMembersByStat = $result->fetchAll();

		return($allMembersByStat);
	}

	function get_NbAllMembersByidStat($idStat){
		global $db;

		// select
		$query = 'SELECT * FROM MEMBRE WHERE idStat = ?';
		// prepare
		$allNbMembersByStat = $db->prepare($query);
		// execute
		$allNbMembersByStat->execute([$idStat]);
		$count = $allNbMembersByStat->rowCount(); 

		return($count);
	}

/*	function get_AllMembresByEmail($eMailMemb){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}*/

	// Inscription membre
	function create($prenomMemb, $nomMemb, $pseudoMemb, $passMemb, $eMailMemb, $dtCreaMemb, $accordMemb, $idStat){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO MEMBRE (prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, accordMemb, idStat) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$prenomMemb, $nomMemb, $pseudoMemb, $passMemb, $eMailMemb, $dtCreaMemb, $accordMemb, $idStat]);

			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert MEMBRE : ' . $e->getMessage());
		}
	}

/*	function update($numMemb, $prenomMemb, $nomMemb, $passMemb, $eMailMemb, $idStat){
		global $db;

		try {
			$db->beginTransaction();
			
			// update
			// prepare
			// execute
				$db->commit();
				$request2->closeCursor();
			}
		}
		catch (PDOException $e) {
			$db->rollBack();
			if ($passMemb == -1) {
				$request1->closeCursor();
			} else {
				$request2->closeCursor();
			}
			die('Erreur update MEMBRE : ' . $e->getMessage());
		}
	}

	// Ctrl FK sur COMMENT avec del
	function delete($numMemb){
		global $db;
		
		try {
			$db->beginTransaction();

			// delete
			// prepare
			// execute
			$count = $request->rowCount();
			$db->commit();
			$request->closeCursor();
			return($count);
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete MEMBRE : ' . $e->getMessage());
		}
	} */
}	// End of class
