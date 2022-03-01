<?php
// CRUD LANGUE
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class LANGUE{


	function get_1Langue($numLang){
		global $db;

		// select
		$query = 'SELECT * FROM LANGUE WHERE numLang = ?';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numLang]);

		return($result->fetch());
	}

	function get_1LangueByPays($numLang){
		global $db;

		// select
		$query = 'SELECT * FROM LANGUE LA INNER JOIN PAYS PA ON LA.numPays = PA.numPays WHERE numLang = ?;';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numLang]);

		return($result->fetch());
	}

	function get_AllLangues(){
		global $db;

		// select
		$query = 'SELECT * FROM LANGUE';
		// prepare
		$result = $db->query($query);
		// execute
		$allLangues = $result->fetchAll();
		
		return($allLangues);
	}

	function get_AllLanguesByPays(){
		global $db;

		// select
        $query = 'SELECT * FROM LANGUE LA INNER JOIN PAYS PA ON LA.numPays = PA.numPays';
		// prepare
		$result = $db->query($query);
		// execute
		$allLanguesByPays = $result->fetchAll();
		return($allLanguesByPays);
	}

	function get_AllLanguesOrderByLib1Lang(){
		global $db;

		// select
		$query = 'SELECT * FROM LANGUE ORDER BY lib1Lang;';
		// prepare
		$result = $db->query($query);
		// execute
		$allLanguesByLib1Lang = $result->fetchAll();

		return($allLanguesByLib1Lang);
	}

	// Récup dernière Primary Key NumLang
	function getNextNumLang($numPays) {
		global $db;
	
		// Les 4 premiers caractères de la PK concernent le pays
		// les 4 suivants représentent un numéro de séquence
		// Récup dernière PK utilisée pour le pays concerné
		$numPaysSelect = $numPays;  // exemple : 'CHIN'
		$parmNumLang = $numPaysSelect . '%';
	
		$requete = "SELECT MAX(numLang) AS numLang FROM LANGUE WHERE numLang LIKE '$parmNumLang';";
	
		$result = $db->query($requete);
	
		$numSeqLang = 0;
		if ($result) {
			// Récup résultat requête
			$tuple = $result->fetch();
			$numLang = $tuple["numLang"];
			if (is_null($numLang)) {
				$numLang = 0;
				$strLang = $numPaysSelect;
			} else {
				// Récup dernière PK attribuée
				$numLang = $tuple["numLang"];
				$strLang = substr($numLang, 0, 4);
				$numSeqLang = (int)substr($numLang, 4);
			}
			$numSeqLang++;
	
			// PK reconstituée
			if ($numSeqLang < 10) {
				$numLang = $strLang . "0" . $numSeqLang;
			} else {
				$numLang = $strLang . $numSeqLang;
			}
		}   // End of if ($result)
	
		return $numLang;
	} // End of function

	function create($numLang, $lib1Lang, $lib2Lang, $numPays){
		global $db;

		try {
			$db->beginTransaction();
			$query = 'INSERT INTO LANGUE (numLang, lib1Lang, lib2Lang, numPays) VALUES (?, ?, ?, ?)';
            $request = $db->prepare($query);
            $request->execute([$numLang, $lib1Lang, $lib2Lang, $numPays]);
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert LANGUE : ' . $e->getMessage());
		}
	}

	function update($numLang, $lib1Lang, $lib2Lang, $numPays){
		global $db;

		try {
			$db->beginTransaction();

			// update
			$query = "UPDATE LANGUE SET lib1Lang = ?, lib2Lang = ?, numPays = ? WHERE numLang = ?";
			// prepare
			$request = $db->prepare($query);
			// execute
			$request->execute([$lib1Lang, $lib2Lang, $numPays, $numLang]);

			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur update LANGUE : ' . $e->getMessage());
		}
	}

	// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
	function delete($numLang){
		global $db;

		try {
			$db->beginTransaction();

			// delete
			$query="DELETE FROM LANGUE WHERE numLang = ?";
			// prepare
			$request=$db->prepare($query);
			// execute
			$request->execute([$numLang]);

			$count = $request->rowCount();
			$db->commit();
			$request->closeCursor();
			return($count);
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete LANGUE : ' . $e->getMessage());
		}
	}
}	// End of class

class PAYS {
	function get_AllPays(){
        global $db;

        $query = 'SELECT * FROM PAYS;';
        $result = $db->query($query);
        $allPays = $result->fetchAll();
        return($allPays);
    }
	
	function get_1Pays($numPays){
        global $db;

        $query = 'SELECT * FROM PAYS WHERE numPays =?';
        $result = $db->prepare($query);
		$result->execute([$numPays]);

		return($result->fetch());
    }

	function get_AllPaysOrderByNumPays(){
		global $db;

		// select
		$query = 'SELECT * FROM PAYS ORDER BY numPays;';
		// prepare
		$result = $db->query($query);
		// execute
		$allPaysOrderBynumPays = $result->fetchAll();

		return($allPaysOrderBynumPays);
	}
}