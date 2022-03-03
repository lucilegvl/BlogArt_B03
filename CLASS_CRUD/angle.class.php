<?php
// CRUD ANGLE
// ETUD
require_once __DIR__ . '../../connect/database.php';

class ANGLE{
	function get_1Angle(string $numAngl) {
		global $db;

		// select
		$query = 'SELECT * FROM ANGLE WHERE numAngl = ?';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numAngl]);
			return($result->fetch());
	}

	function get_1AngleByLang(string $numAngl) {
		global $db;

		// select
		$query = 'SELECT * FROM ANGLE AN INNER JOIN LANGUE LA ON AN.numLang = LA.numLang WHERE numAngl = ?;';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numAngl]);
		return($result->fetch());
	}

	function get_1LangByAngle( string $numAngl){
		global $db;
		$query = 'SELECT * FROM LANGUE INNER JOIN ANGLE ON LANGUE.numLang = ANGLE.numLang WHERE numAngl = ?;';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numAngl]);
		return($result->fetch());
	}

	function get_AllAngles() {
		global $db;

		// select
		$query = 'SELECT * FROM ANGLE';
		// prepare
		$result = $db->query($query);
		// execute
		$allAngles = $result->fetchAll();
		return($allAngles);
	}

	function get_AllAnglesByLang() {
		global $db;

		// select
        $query = 'SELECT * FROM ANGLE AN INNER JOIN LANGUE LA ON AN.numLang = LA.numLang';
		// prepare
        $result = $db->query($query);
		// execute
		$allAnglesByLang = $result->fetchAll();
		return($allAnglesByLang);
	}

	//function get_AllLanguesOrderByLibLang(){
   //     global $db;
		// select
		// prepare
		// execute
  //      $allLanguesOrderByLibLang = $result->fetchAll();
   //     return($allLanguesOrderByLibLang);
   // }

	function get_AllAnglesByLibAngl(){
		global $db;

		// select
		$query = 'SELECT * FROM ANGLE ORDER BY libAngl;';
		// prepare
		$result = $db->query($query);
		// execute
		$allAnglesByLibAngl = $result->fetchAll();

		return($allAnglesByLibAngl);
	}

	function get_NbAllAnglesBynumLang(string $numLang) {
		global $db;

		// select
		$query = 'SELECT * FROM ANGLE WHERE numLang = ?';
		// prepare
		$allNbAnglesBynumLang = $db->prepare($query);
		// execute
		$allNbAnglesBynumLang->execute([$numLang]);
		$count = $allNbAnglesBynumLang->rowCount();
		return($count);
	}

	//  Récupérer la prochaine PK de la table ANGLE
	function getNextNumAngl($numLang) {
		global $db;
	
		// Découpage FK LANGUE
		$libLangSelect = substr($numLang, 0, 4);
		$parmNumLang = $libLangSelect . '%';
	
		$requete = "SELECT MAX(numLang) AS numLang FROM ANGLE WHERE numLang LIKE '$parmNumLang';";
		$result = $db->query($requete);
	
		if ($result) {
			$tuple = $result->fetch();
			$numLang = $tuple["numLang"];
			if (is_null($numLang)) {    // New lang dans ANGLE
				// Récup dernière PK utilisée
				$requete = "SELECT MAX(numAngl) AS numAngl FROM ANGLE;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numAngl = $tuple["numAngl"];
	
				$numAnglSelect = (int)substr($numAngl, 4, 2);
				// No séquence suivant LANGUE
				$numSeq1Angl = $numAnglSelect + 1;
				// Init no séquence ANGLE pour nouvelle lang
				$numSeq2Angl = 1;
			} else {
				// Récup dernière PK pour FK sélectionnée
				$requete = "SELECT MAX(numAngl) AS numAngl FROM ANGLE WHERE numLang LIKE '$parmNumLang' ;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numAngl = $tuple["numAngl"];
	
				// No séquence actuel LANGUE
				$numSeq1Angl = (int)substr($numAngl, 4, 2);
				// No séquence actuel LANGUE
				$numSeq2Angl = (int)substr($numAngl, 6, 2);
				// No séquence suivant ANGLE
				$numSeq2Angl++;
			}
	
			$libAnglSelect = "ANGL";
			// PK reconstituée : ANGL + no seq langue
			if ($numSeq1Angl < 10) {
				$numAngl = $libAnglSelect . "0" . $numSeq1Angl;
			} else {
				$numAngl = $libAnglSelect . $numSeq1Angl;
			}
			// PK reconstituée : ANGL + no seq langue + no seq angle
			if ($numSeq2Angl < 10) {
				$numAngl = $numAngl . "0" . $numSeq2Angl;
			} else {
				$numAngl = $numAngl . $numSeq2Angl;
			}
		}   // End of if ($result) / no seq angle
		return $numAngl;
	} // End of function

	function create(string $numAngl, string $libAngl, string $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO ANGLE (numAngl, libAngl, numLang) VALUES (?, ?, ?)';
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numAngl, $libAngl, $numLang]);
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert ANGLE : ' . $e->getMessage());
		}
	}

	function update(string $numAngl, string $libAngl, string $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = "UPDATE ANGLE SET numLang = ?,  libAngl = ? WHERE numAngl = ?";
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numLang, $libAngl, $numAngl]);
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update ANGLE : ' . $e->getMessage());
		}
	}

	// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
	function delete(string $numAngl){
		global $db;

		try {
			$db->beginTransaction();

			// delete
			$query="DELETE FROM ANGLE WHERE numAngl = ?";
			// prepare
			$request=$db->prepare($query);
			// execute
			$request->execute([$numAngl]);
			$count = $request->rowCount();
			$db->commit();
			$request->closeCursor();
			return($count);
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete ANGLE : ' . $e->getMessage());
		}
	}
}		// End of class

