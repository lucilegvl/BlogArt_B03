<?php
/*
*   Script : ajaxEtudiant.php
*   Example : 2 listbox dynamiques liées via AJAX
*/
// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// connexion
require_once __DIR__ . '/../../CONNECT/database.php';

require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';

?>
<select name='TypAngl' style='padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;' >
<?php
$TypLang = $_REQUEST["numLang"];

if (isset($TypLang)) {
	$query = "SELECT numAngl, libAngl FROM ANGLE WHERE numLang = ?" ; 
	$result = $db->prepare($query);
	$result->execute([$TypLang]);
	$allAnglesByLang = $result->fetchAll();

	if ($allAnglesByLang) {
?>
			<option value='-1'>- - - Choisissez un angle - - -</option>
<?php
			foreach($allAnglesByLang as $row){
?>
				<option value="<?php $row['numAngl']; ?>">
					<?php echo $row['libAngl'] ?>
				</option>
<?php
			}	// End of foreach
	} else {
?>
			<option value='-1'>- - - Choisissez un angle - - -</option>
<?php
	}	// else
}	// End of if (isset($classe))
?>
</select>