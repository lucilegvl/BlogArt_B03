<?php
// CRUD LIKEART
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class LIKEART{
	function get_1LikeArt($numMemb, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_AllLikesArt(){
		global $db;

		// select
		// prepare
		// execute
		return($allLikesArt);
	}

	function get_AllLikesArtByNumArt(){
		global $db;

		$query = 'SELECT * FROM MEMBRE ME INNER JOIN LIKEART LKA ON ME.numMemb = LKA.numMemb INNER JOIN ARTICLE ART ON LKA.numArt = ART.numArt GROUP BY ART.numArt;';
		$result = $db->query($query);
		$allLikesArtByNumArt = $result->fetchAll();
		return($allLikesArtByNumArt);
	}

	function get_AllLikesArtByNumMemb(){
		global $db;

		$query = 'SELECT * FROM MEMBRE ME INNER JOIN LIKEART LKA ON ME.numMemb = LKA.numMemb INNER JOIN ARTICLE ART ON LKA.numArt = ART.numArt GROUP BY ME.numMemb;';
		$result = $db->query($query);
		$allLikesArtByNumMemb = $result->fetchAll();
		return($allLikesArtByNumMemb);
	}

	function get_nbLikesArtByArticle($numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}

	function get_nbLikesArtByMembre($numMemb){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}

	function create($numMemb, $numArt, $likeA){
		global $db;

		try {
			$db->beginTransaction();

			// insert
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert LIKEART : ' . $e->getMessage());
		}
	}

	function update($numMemb, $numArt, $likeA){
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
			die('Erreur update LIKEART : ' . $e->getMessage());
		}
	}

	// Create et Update en même temps
	function createOrUpdate($numMemb, $numArt){
		global $db;

		try {
			$db->beginTransaction();

			// insert / update
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur insert Or Update LIKEART : ' . $e->getMessage());
		}
	}

	// AUTORISE UNIQUEMENT POUR le super-admin / admin => En mode DEV (avant la mise en prod)
	function delete($numMemb, $numArt){
		global $db;
		
		try {
			$db->beginTransaction();

			// delete
			// prepare
			// execute
			//$count = $request->rowCount();
			$db->commit();
			$request->closeCursor();
			//return($count);
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete LIKEART : ' . $e->getMessage());
		}
	}
}	// End of class
