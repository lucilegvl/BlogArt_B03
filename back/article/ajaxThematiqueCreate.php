<?php
/*
*   Script : ajaxThematiqueCreate.php
*   Example : 2 listbox dynamiques liées via AJAX
*/
// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
// connexion
require_once __DIR__ . '/../../connect/database.php';

require_once __DIR__ . '/../../class_crud/thematique.class.php';
?>


<select name='TypThem' style='padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;' >
<?php
$Langue = $_REQUEST["numLang"];

if (isset($Langue)) {
	$query = "SELECT numThem, libThem FROM THEMATIQUE WHERE numLang = ?;" ;
	$result = $db->prepare($query);
	$result->execute([$Langue]);
	$allThematiquesByLangue = $result->fetchAll();

	if ($allThematiquesByLangue) {
?>
			<option value='-1'>- - - Choisissez une thematique - - -</option>
<?php
			foreach($allThematiquesByLangue as $row){
?>
				<option value="<?php $row['numThem']; ?>">
					<?php echo $row['libThem']; ?>
				</option>
<?php
			}	// End of foreach
	}else {
?>
			<option value='-1'>- - - Choisissez une thematique - - -</option>
<?php
	}	// else
}	// End of if (isset($Langue))
?>
</select>
