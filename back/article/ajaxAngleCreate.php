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
<select name='TypAngl' style='padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;' >
<?php
$TypAngl = $_REQUEST["numAngl"];

if (isset($TypAngl)) {
	$query = "SELECT numAngl, libAngl FROM ANGLE WHERE numAngl = ?;" ; 
	$result = $db->prepare($query);
	$result->execute([$TypAngl]);
	$get_AllAnglesByLang = $result->fetchAll();

	if ($get_AllAnglesByLang) {
?>
			<option value='-1'>- - - Choisissez un angle - - -</option>
<?php
			foreach($allAnglesByLang as $row){
?>
				<option value="<?= $row['numAngl']; ?>">
					<?= $row['libAngl'] ?>
				</option>
<?php
			}	// End of foreach
	}else {
?>
			<option value='-1'>- - - Choisissez un angle - - -</option>
<?php
	}	// else
}	// End of if (isset($classe))
?>
</select>