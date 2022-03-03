<?php
// CRUD MEMBRE
// ETUD
// A tester sur Blog'Art
require_once __DIR__ . '../../connect/database.php';

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

	function get_AllMembresByEmail($eMailMemb){
		global $db;

		// select
		$query = 'SELECT * FROM MEMBRE WHERE eMailMemb = ?';
		// prepare
		$allNbMembersByEMail = $db->prepare($query);
		// execute
		$allNbMembersByEMail->execute([$eMailMemb]);
		$count = $allNbMembersByEMail->rowCount(); 

		return($count);
	}

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

	function update($numMemb, $prenomMemb, $nomMemb, $passMemb, $eMailMemb, $idStat, $testPass2Memb, $testEMail2Memb) {
		global $db;

		try {
			$db->beginTransaction();
			
			if ($testPass2Memb == -1 AND $testEMail2Memb == -1) {
				// update
				$query = "UPDATE MEMBRE SET prenomMemb = ?,  nomMemb = ?, idStat = ? WHERE numMemb = ?";
				// prepare
				$request = $db->prepare($query);
				// execute
				$request->execute([$prenomMemb, $nomMemb, $idStat, $numMemb]);
				$db->commit();
				$request->closeCursor();
			} else {
				if ($testPass2Memb != -1 AND $testEMail2Memb == -1) {
					// update
					$query = "UPDATE MEMBRE SET prenomMemb = ?, nomMemb = ?, passMemb = ?, idStat = ? WHERE numMemb = ?";
					// prepare
					$request = $db->prepare($query);
					// execute
					$request->execute([$prenomMemb, $nomMemb, $passMemb, $idStat, $numMemb]);
					$db->commit();
					$request->closeCursor();
				}
				if ($testPass2Memb == -1 AND $testEMail2Memb != -1) {
					// update
					$query = "UPDATE MEMBRE SET prenomMemb = ?, nomMemb = ?, eMailMemb = ?, idStat = ? WHERE numMemb = ?";
					// prepare
					$request = $db->prepare($query);
					// execute
					$request->execute([$prenomMemb, $nomMemb, $eMailMemb, $idStat, $numMemb]);
					$db->commit();
					$request->closeCursor();
				}
				if ($testPass2Memb != -1 AND $testEMail2Memb != -1) {
					// update
					$query = "UPDATE MEMBRE SET prenomMemb = ?,  nomMemb = ?,  passMemb = ?,  eMailMemb = ?,  idStat = ? WHERE numMemb = ?";
					// prepare
					$request = $db->prepare($query);
					// execute
					$request->execute([$prenomMemb, $nomMemb, $passMemb, $eMailMemb, $idStat, $numMemb]);
					$db->commit();
					$request->closeCursor();
				}
			}

		} catch (PDOException $e) {
			$db->rollBack();
			if ($passMemb == -1) {
				$request->closeCursor();
			} else {
				$request->closeCursor();
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
			$query="DELETE FROM MEMBRE WHERE numMemb = ?";
			// prepare
			$request=$db->prepare($query);
			// execute
			$request->execute([$numMemb]);
			
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
	} 
}	// End of class
