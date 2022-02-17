<?php
// CRUD MOTCLEARTICLE
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class MOTCLEARTICLE{
	function get_AllMotClesByNumArt($numArt){
		global $db;

		// select
		// prepare
		// execute
		return($allCommentsByArt);
	}

	function get_AllMotClesByLibTitrArt($libTitrArt){
		global $db;

		// select
		// prepare
		// execute
		return($allCommentsByArt);
	}

	function get_AllArtsByNumMotCle($numMotCle){
		global $db;

		// select
		// prepare
		// execute
		return($allCommentsByArt);
	}

	function get_NbAllArtsByNumMotCle($numMotCle){
		global $db;

		// select
		$query = 'SELECT * FROM MOTCLEARTICLE WHERE numMotCle = ?';
		// prepare
		$result = $db->prepare($query);
		// execute
		$result->execute([$numMotCle]);
		$count = $result->rowCount();
		return($count);
	}

	function get_AllArtsByLibMotCle($libMotCle){
		global $db;

		// select
		// prepare
		// execute
		return($allCommentsByArt);
	}

	function create($numArt, $numMotCle){
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
			die('Erreur insert MOTCLEARTICLE : ' . $e->getMessage());
		}
	}

	function delete($numArt, $numMotCle){
		global $db;

		try {
			$db->beginTransaction();

			// delete
			// prepare
			// execute
			$db->commit();
			$request->closeCursor();
		}
		catch (PDOException $e) {
			$db->rollBack();
			$request->closeCursor();
			die('Erreur delete MOTCLEARTICLE : ' . $e->getMessage());
		}
	}
}	// End of class
