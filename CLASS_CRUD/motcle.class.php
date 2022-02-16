<?php
// CRUD MOTCLE
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class MOTCLE{
	function get_1MotCle($numMotCle){
		global $db;

		// select
		$query = 'SELECT * FROM MOTCLE WHERE numMotCle = ?';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numMotCle]);

		return($result->fetch());
	}

	function get_1MotCleByLang($numMotCle){
		global $db;

		// select
		$query = 'SELECT * FROM MOTCLE WHERE numMotCle = ?';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numMotCle]);

		return($result->fetch());
	}

	function get_AllMotCles(){
		global $db;

		// select
		$query = 'SELECT * FROM MOTCLE';
		// prepare
		$result = $db->query($query);
		// execute
		$allMotCles = $result->fetchAll();

		return($allMotCles);
	}

	function get_AllMotsClesByLang(){
		global $db;

		// select
		$query = 'SELECT * FROM MOTCLE WHERE numMotCle=?';
		// prepare
		$result = $db->query($query);
		// execute
		$allMotsClesByPays = $result->fetchAll();

		return($allMotsClesByLang);
	}

	function get_NbAllMotsClesBynumLang($numLang){
		global $db;

		// select
		$query = 'SELECT * FROM MOTCLE ORDER BY libMotCle;';
		// prepare
		$result = $db->query($query);
		// execute
		$NbAllMotsClesBynumLang = $result->fetchAll();

		return($allNbMotsClesBynumLang);
	}

	// Sortir mots clés déjà sélectionnés dans MOTCLE (TJ) dans ARTICLE
	// ppour le drag and drop
	function get_MotsClesNotSelect($listNumMotcles) {
		global $db;

		/*
		Pour numArt = 1 :
		SELECT numMotCle, libMotCle FROM MOTCLE WHERE numMotCle NOT IN (1, 6, 8, 9, 10, 11, 12, 13);
		*/
		// Recherche mot clé (INNER JOIN) dans tables MOTCLEARTICLE
		$textQuery = 'SELECT numMotCle, libMotCle FROM MOTCLE WHERE numMotCle NOT IN (' . $listNumMotcles . ');';
		$result = $db->prepare($textQuery);
		$result->execute([$listNumMotcles]);
		$allMotsClesNotSelect = $result->fetchAll();
		return($allMotsClesNotSelect);
	}

	// Récupérer next PK de la table MOTCLE
	function getNextNumMoCle($numLang) {
		global $db;
	
		// Découpage FK LANGUE
		$libLangSelect = substr($numLang, 0, 4);
		$parmNumLang = $libLangSelect . '%';
	
		$requete = "SELECT MAX(numLang) AS numLang FROM MOTCLE WHERE numLang LIKE '$parmNumLang';";
		$result = $db->query($requete);
	
		if ($result) {
			$tuple = $result->fetch();
			$numLang = $tuple["numLang"];
			if (is_null($numLang)) {    // New lang dans MOTCLE
				// Récup dernière PK utilisée
				$requete = "SELECT MAX(numMoCle) AS numMoCle FROM MOTCLE;";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numMoCle = $tuple["numMoCle"];
	
				$numMoCleSelect = (int)substr($numMoCle, 4, 2);
				// No séquence suivant LANGUE
				$numSeq1MoCle = $numMoCleSelect + 1;
				// Init no séquence MOTCLE pour nouvelle lang
				$numSeq2MoCle = 1;
			} else {
				// Récup dernière PK pour FK sélectionnée
				$requete = "SELECT MAX(numMoCle) AS numMoCle FROM MOTCLE WHERE numLang LIKE '$parmNumLang';";
				$result = $db->query($requete);
				$tuple = $result->fetch();
				$numMoCle = $tuple["numMoCle"];
	
				// No séquence actuel LANGUE
				$numSeq1MoCle = (int)substr($numMoCle, 4, 2);
				// No séquence actuel MOTCLE
				$numSeq2MoCle = (int)substr($numMoCle, 6, 2);
				// No séquence suivant MOTCLE
				$numSeq2MoCle++;
			}
	
			$libMoCleSelect = "MTCL";
			// PK reconstituée : MTCL + no seq langue
			if ($numSeq1MoCle < 10) {
				$numMoCle = $libMoCleSelect . "0" . $numSeq1MoCle;
			} else {
				$numMoCle = $libMoCleSelect . $numSeq1MoCle;
			}
			// PK reconstituée : MOCL + no seq langue + no seq mot clé
			if ($numSeq2MoCle < 10) {
				$numMoCle = $numMoCle . "0" . $numSeq2MoCle;
			} else {
				$numMoCle = $numMoCle . $numSeq2MoCle;
			}
		}   // End of if ($result) / no seq LANGUE
		return $numMoCle;
	} // End of function

	function create($libMotCle, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			$query='INSERT INTO MOTCLE (libMotCle, numLang) VALUES (?, ?)';
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$libMotCle, $numLang]);


			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert MOTCLE : ' . $e->getMessage());
		}
	}

	function update($numMotCle, $libMotCle, $numLang){
		global $db;

		try {
			$db->beginTransaction();

			// update
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update MOTCLE : ' . $e->getMessage());
		}
	}

	function delete($numMotCle){
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
			die('Erreur delete MOTCLE : ' . $e->getMessage());
		}
	}
}	// End of class
