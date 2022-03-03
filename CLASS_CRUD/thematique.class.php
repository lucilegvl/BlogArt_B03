<?php
// CRUD THEMATIQUE
// ETUD
require_once __DIR__ . '../../connect/database.php';

class THEMATIQUE{
	function get_1Thematique($numThem){
		global $db;

	// select
	$query = 'SELECT * FROM THEMATIQUE WHERE numThem = ?';
	// prepare
	$result = $db->prepare($query);
	// execute
	$result->execute([$numThem]);
			return($result->fetch());
		}

	function get_1ThematiqueByLang($numThem){
		global $db;

		// select
		$query = 'SELECT * FROM THEMATIQUE THE INNER JOIN LANGUE LA ON THE.numLang = LA.numLang WHERE numThem = ?;';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numThem]);
		return($result->fetch());
	}

	function get_AllThematiques(){
		global $db;

		// select
		$query = 'SELECT * FROM THEMATIQUE';
		// prepare
		$result = $db->query($query);
		// execute
		$allThematiques = $result->fetchAll();

		return($allThematiques);
	}

	function get_AllThematiquesByLang(){
		global $db;

		// select
        $query = 'SELECT * FROM THEMATIQUE TH INNER JOIN LANGUE LA ON TH.numLang = LA.numLang';
		// prepare
        $result = $db->query($query);
		// execute
		$allThematiquesByLang = $result->fetchAll();
		return($allThematiquesByLang);
	}

	function get_AllThematiquesByLibThem(){
		global $db;

		// select
		$query = 'SELECT * FROM THEMATIQUE ORDER BY libThem;';
		// prepare
		$result = $db->query($query);
		// execute
		$allThematiquesByLibThem = $result->fetchAll();

		return($allThematiquesByLibThem);
	}
	function get_AllLanguesOrderByLibLang(){
        global $db;

        $query = 'SELECT * FROM LANGUE ORDER BY lib1Lang;';
        $result = $db->query($query);
        $allLanguesOrderByLibLang = $result->fetchAll();
        return($allLanguesOrderByLibLang);
    }
	function get_NbAllThematiquesBynumLang($numLang){
		global $db;

		// select
		$query = 'SELECT * FROM THEMATIQUE WHERE numLang = ?';
		// prepare
		$allNbThematiqueBynumLang = $db->prepare($query);
		// execute
		$allNbThematiqueBynumLang->execute([$numLang]);
		$count = $allNbThematiqueBynumLang->rowCount();
		return($count);
	}

	// Récup dernière PK NumThem
	function get_NextNumThem($numLang) {
		global $db;
	
		// Découpage FK LANGUE
		$libLangSelect = substr($numLang, 0, 4);
		$parmNumLang = $libLangSelect . '%';
	
		$requete = "SELECT MAX(numLang) AS numLang FROM THEMATIQUE WHERE numLang LIKE '$parmNumLang';";
		$result = $db->query($requete);
	
		if ($result) {
			$tuple = $result->fetch();
			$numLang = $tuple["numLang"];
			if (is_null($numLang)) {    // New lang dans THEMATIQUE
				// Récup dernière PK utilisée
				$requete = "SELECT MAX(numThem) AS numThem FROM THEMATIQUE;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numThem = $tuple["numThem"];
	
				$numThemSelect = (int)substr($numThem, 4, 2);
				// No séquence suivant LANGUE
				$numSeq1Them = $numThemSelect + 1;
				// Init no séquence THEMATIQUE pour nouvelle lang
				$numSeq2Them = 1;
			} else {
				// Récup dernière PK pour FK sélectionnée
				$requete = "SELECT MAX(numThem) AS numThem FROM THEMATIQUE WHERE numLang LIKE '$parmNumLang' ;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numThem = $tuple["numThem"];
	
				// No séquence actuel LANGUE
				$numSeq1Them = (int)substr($numThem, 4, 2);
				// No séquence actuel LANGUE
				$numSeq2Them = (int)substr($numThem, 6, 2);
				// No séquence suivant THEMATIQUE
				$numSeq2Them++;
			}
	
			$libThemSelect = "THEM";
			// PK reconstituée : THE + no seq langue
			if ($numSeq1Them < 10) {
				$numThem = $libThemSelect . "0" . $numSeq1Them;
			} else {
				$numThem = $libThemSelect . $numSeq1Them;
			}
			// PK reconstituée : THE + no seq langue + no seq thématique
			if ($numSeq2Them < 10) {
				$numThem = $numThem . "0" . $numSeq2Them;
			} else {
				$numThem = $numThem . $numSeq2Them;
			}
		}   // End of if ($result) / no seq LANGUE
		return $numThem;
	} // End of function

	function create($numThem, $libThem, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query = 'INSERT INTO THEMATIQUE (numThem, libThem, numLang) VALUES (?, ?, ?)';
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$numThem, $libThem, $numLang]);

			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert THEMATIQUE : ' . $e->getMessage());
		}
	}

	function update($numThem, $libThem, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = "UPDATE THEMATIQUE SET libThem = ?, numLang = ? WHERE numThem = ?;"; //se référencer à la photo de toutes les tables (clé primaire, étrangères,...)
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$libThem, $numLang, $numThem]); // ordre de $query obligatoire mais pas de function update

			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update THEMATIQUE : ' . $e->getMessage());
		}
	}

	// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
	function delete($numThem){
		global $db;
		
		try {
			$db->beginTransaction();

			// delete
			$query="DELETE FROM THEMATIQUE WHERE numThem = ?";
			// prepare
			$request=$db->prepare($query);
			// execute
			$request->execute([$numThem]);

			$count = $request->rowCount();
			$db->commit();
			$request->closeCursor();
			return($count);
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete THEMATIQUE : ' . $e->getMessage());
		}
	}
}		// End of class
