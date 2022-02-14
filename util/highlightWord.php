<?php
////////////////////////////////////////////////
//
//  Script : highlightWord.php
//
////////////////////////////////////////////////

/*
	Déclaration de la méthode :	Attention méthode sensible à la casse et mot exact
	---------------------------

	Paramètres d'entrée :

	$stringIN  ==>		Contient la string avec le/les mot(s) à surligner

	$searchWord  ==>	Contient le mot à chercher dans la string et à surligner dès que trouvé(s)

	A NOTER :
	Il est nécessaire d'avoir une feuille de style dans le script principal de la forme :
		<style type="text/css">
			span {
		    	background-color: yellow;
			}
		</style>


	Appel de la méthode de la forme :
	---------------------------------

	La méthode retourne la string formatée, ie avec tous les mots surlignés et trouvés

    $stringApresMiseEnForme = highlightWord($stringIN, $searchWord);
*/

// Récupérer une chaine de caractères avec le mot recherché surligné dans la chaine
function highlightWord($stringIN, $searchWord) {

	$pattern = '/\b' . $searchWord . '\b/';	// Recherche mot exact
	$replace = '<span>' . $searchWord . '</span>';	// Ajout mise en forme dans la string
	$length = strlen($searchWord);	// Longueur du mot à remplacer avec balise surlignée
	$pos = 0;

	for ($i = 0; $i < preg_match_all($pattern, $stringIN, $match); $i++) {
		if (preg_match($pattern, $stringIN)) {
			// Cherche la position de la première (et suivante) occurrence dans une chaîne
			$posStringIN = strpos($stringIN, $searchWord, $pos);
			$stringIN = substr_replace($stringIN, $replace, $posStringIN, $length);
			$pos = $posStringIN + $length;
		}	// End of if()
	}	// End of for()
	$stringOUT = $stringIN;

return ($stringOUT);
}
