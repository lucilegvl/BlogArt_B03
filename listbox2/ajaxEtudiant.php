<?php
/*
*   Script : ajaxEtudiant.php
*   Example : 2 listbox dynamiques liées via AJAX
*/
// Mode DEV
require_once __DIR__ . '/util/utilErrOn.php';
// connexion
require_once __DIR__ . '/CONNECT/database.php';
?>
<select name='etudiant' style='padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;' >
<?php
$classe = $_REQUEST["numClas"];

if (isset($classe)) {
	$query = "SELECT numEtu, nomEtu, prenomEtu FROM ETUDIANT WHERE numClas = ?;" ;
	$result = $db->prepare($query);
	$result->execute([$classe]);
	$allEtudiantsByClasse = $result->fetchAll();

	if ($allEtudiantsByClasse) {
?>
			<option value='-1'>- - - Choisissez un étudiant - - -</option>
<?php
			foreach($allEtudiantsByClasse as $row){
?>
				<option value="<?= $row['numEtu']; ?>">
					<?= $row['prenomEtu'] . " " . $row['nomEtu']; ?>
				</option>
<?php
			}	// End of foreach
	}else {
?>
			<option value='-1'>- - - Choisissez un étudiant - - -</option>
<?php
	}	// else
}	// End of if (isset($classe))
?>
</select>
