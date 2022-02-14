<?php
// CRUD LIKECOM
// ETUD
require_once __DIR__ . '../../CONNECT/database.php';

class LIKECOM{
	function get_1LikeCom($numMemb, $numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_1LikeComPlusMemb($numMemb, $numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_1LikeComPlusCom($numMemb, $numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_1LikeComPlusArt($numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetch());
	}

	function get_AllLikesCom(){
		global $db;

		// select
		// prepare
		// execute
		return($allLikesCom);
	}

	function get_AllLikesComByComment($numSeqCom, $numArt){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}

	function get_AllLikesComByMembre($numMemb){
		global $db;

		// select
		// prepare
		// execute
		return($result->fetchAll());
	}

	function create($numMemb, $numSeqCom, $numArt, $likeC){
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
			die('Erreur insert LIKECOM : ' . $e->getMessage());
		}
	}

	function update($numMemb, $numSeqCom, $numArt, $likeC){
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
			die('Erreur update LIKECOM : ' . $e->getMessage());
		}
	}

	// Create et Update en même temps
	function createOrUpdate($numMemb, $numSeqCom, $numArt){
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
			die('Erreur insert Or Update LIKECOM : ' . $e->getMessage());
		}
	}

	// AUTORISE UNIQUEMENT POUR le super-admin / admin
	function delete($numMemb, $numSeqCom, $numArt){
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
			die('Erreur delete LIKECOM : ' . $e->getMessage());
		}
	}
}	// End of class
