<?php
///////////////////////////////////////////////////////
//
//  Script : estUnDomaineValide.php
//
///////////////////////////////////////////////////////

function estUnDomaineValide($url){

    $validation = FALSE;
    /*Parse URL*/    
    $urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));
    /*Check host exist else path assign to host*/    
    if(!isset($urlparts['host'])){
        $urlparts['host'] = $urlparts['path'];
    }

    if($urlparts['host'] != ''){
       /*Add scheme if not found*/        
       if (!isset($urlparts['scheme'])){
            $urlparts['scheme'] = 'http';
        }
        /*Validation*/        
        if(checkdnsrr($urlparts['host'], 'A') AND 
            in_array($urlparts['scheme'],array('http','https')) AND 
            ip2long($urlparts['host']) === FALSE){ 

            $urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
            $url = $urlparts['scheme'] . '://' . $urlparts['host'] . "/";            
            
            if (filter_var($url, FILTER_VALIDATE_URL) !== FALSE AND @get_headers($url)) {
                $validation = TRUE;
            }
        }
    }

    // Retour selon besoins
    if(!$validation){
        // Procedure
        echo "<br>Ce nom de domaine est invalide !";
        // ou Fonction
        //return FALSE;
    }else{
        // Procedure
        echo "<br> <b>$url</b> est un nom de domaine valide !";
        // ou Fonction
        //return TRUE;
    }
}
