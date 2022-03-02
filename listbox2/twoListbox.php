<?php
/*
*   Script : twoListbox.php
*   Example : 2 listbox dynamiques liées via AJAX
*/
// Mode DEV
require_once __DIR__ . '/util/utilErrOn.php';

// Insertion classe PDO Classe
require_once __DIR__ . '/CLASS_CRUD/classe.class.php';
$maClasse = new CLASSE();
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<!-- PHP & AJAX -->
	<title>Deux Listbox dynamiques liées</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="./css/style.css" rel="stylesheet" type="text/css" />
</head>
<body style="font-family: verdana, helvetica, sans-serif; font-size: 85%">
    <h1>Deux Listbox dynamiques liées</h1>
    <h2>Sélectionner une classe puis un(e) étudiant(e)</h2>
    <br />
		<form method="POST" name="formulaire" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

		<fieldset style="width: 550px; border: 3px double #333399">
      	  <legend class="legend1">Sélectionnez les étudiants de votre classe :&nbsp;&nbsp;&nbsp;</legend>
		  <br/>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox classe -->
		  <label for="LibTypClas" title="Sélectionnez la classe !" >
            <b>&nbsp;&nbsp;&nbsp;Quelle classe :&nbsp;&nbsp;&nbsp;</b>
      	  </label>

      	  <select size="1" name="classe" id="classe" title="Sélectionnez la classe !" style="padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;" onchange='change()'>
        	<option value="-1">- - - Choisissez une classe - - -</option>
<?php
	          $listNumClas = "";
	          $listLibClas = "";

          	  $result = $maClasse->getAllClassesByLibClas();
          	  if($result){
	            foreach($result as $row) {
	                $listNumClas = $row["numClas"];
	                $listLibClas = $row["libClas"];
?>
		            <option value="<?= $listNumClas; ?>">
		               <?= $listLibClas; ?>
		            </option>
<?php
	            } // End of foreach
          	  }   // if ($result)
?>
      	  </select>
      	  &nbsp;&nbsp;&nbsp;
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox étudiant -->
      	  <br/><br/>
      	  <label><b>&nbsp;&nbsp;&nbsp;Quel étudiant :&nbsp;&nbsp;</b></label>
		  <div id='etudiant' style='display:inline'>
      	    <select size="1" name="etudiant" title="Sélectionnez l'étudiant !" style="padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;">
			  <option value='-1'>- - - Aucun - - -</option>
      	    </select>
      	  </div>
      	  <br /><br /><br />
		</fieldset>
		<br/><br/>
		</form>
  	<h3><a href="./twoListbox.php" title="Réinit du formulaire">Réinit du formulaire</a></h3>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
  <!-- Script JS/AJAX -->
  <script type='text/javascript'>
		function getXhr() {
      		var xhr = null;
			if(window.XMLHttpRequest){ // Firefox & autres
			   xhr = new XMLHttpRequest();
			}else
				if(window.ActiveXObject){ // IE / Edge
				   try {
						xhr = new ActiveXObject("Msxml2.XMLHTTP");
				   }catch(e){
						xhr = new ActiveXObject("Microsoft.XMLHTTP");
				   }
				}else{
				   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
				   xhr = false;
				}
        	return xhr;
		}	// End of function

		/**
		* Méthode appelée sur le click du bouton/listbox
		*/
		function change() {
			var xhr = getXhr();
			// On définit quoi faire quand réponse reçue
			xhr.onreadystatechange = function() {
				// test si tout est reçu et si serveur est ok
				if(xhr.readyState == 4 && xhr.status == 200){
					di = document.getElementById('etudiant');
					di.innerHTML = xhr.responseText;
				}
			}

			// Traitement en POST
			xhr.open("POST","./ajaxEtudiant.php",true);
			// pour le post
			xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numClas
			numClas = document.getElementById('classe').options[document.getElementById('classe').selectedIndex].value;

			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhr.send("numClas="+numClas);
		}	// End of function
  </script>
<!-- --------------------------------------------------------------- -->
</body>
</html>
