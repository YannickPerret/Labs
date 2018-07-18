<?php
define ("CLEF_SECRETE", "6LdQkR8TAAAAAIxaH_Fof2J-C6UanaXizGU04qch");
// Connexion à la bas de donnée via PDO
function connexionbdd()
{
$PARAM_hote='yannickpgt1.mysql.db'; // le chemin vers le serveur
$PARAM_port='3306';
$PARAM_nom_bd='yannickpgt1'; // le nom de votre base de données
$PARAM_utilisateur='yannickpgt1'; // nom d'utilisateur pour se connecter
$PARAM_mot_passe='Suplivent27'; // mot de passe de l'utilisateur pour se connecter
	try
	{
			$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe, array(
           PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            //$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

		
	}
	 
	catch(Exception $e)
	{
			echo 'Une erreur est survenue !';
			die();
	}
	return $connexion;
}

// Fonction de cryptage et injection afin d'avoir un code sécurisé
function hashagePwd ($password)
{
	$passwordCrypt = MD5($password);
	$passwordCrypt = SHA1($passwordCrypt);
	$passwordCrypt = "Ldl3kf&*ç@05_".$passwordCrypt."_dfed*ç@%fs&4";
	$passwordCrypt = SHA1($passwordCrypt);	
	return $passwordCrypt;
} 

// Traitement des information du captcha depuis google
function CaptchaisValid($code, $ip = null)
{
    if (empty($code)) {
        return false; // Si aucun code n'est entré, on ne cherche pas plus loin
    }
    $params = [
        'secret'    => CLEF_SECRETE,
        'response'  => $code
    ];
    if( $ip ){
        $params['remoteip'] = $ip;
    }
    $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
    if (function_exists('curl_version')) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
        $response = curl_exec($curl);
    } else {
        // Si curl n'est pas dispo, un bon vieux file_get_contents
        $response = file_get_contents($url);
    }

    if (empty($response) || is_null($response)) {
        return false;
    }

    $json = json_decode($response);
    return $json->success;
}

//Autocomplétion grâce au Jquery plugin des villes prises depuis la base de données
    if(isset($_GET['query'])) {
        // Mot tapé par l'utilisateur
        $q = htmlentities($_GET['query']);
 
        // Connexion à la base de données
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=mydb', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));

        } catch(Exception $e) {
            exit('Impossible de se connecter à la base de données.');
        }
 
        // Requête SQL
        $requete = "SELECT nomVille, codePostal FROM ville WHERE nomVille LIKE '%" . addslashes($q) . "%'";
 
        // Exécution de la requête SQL
        $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
 
        // On parcourt les résultats de la requête SQL
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // On ajoute les données dans un tableau
            $suggestions['suggestions'][] = $donnees['nomVille'].$donnees['codePostal'];

        }
 
        // On renvoie le données au format JSON pour le plugin
        echo json_encode($suggestions);
    }

    function genre($genre)
    {
        if ($genre == 1)
            return "Masculin";
        else
            return "Feminin";
    }
    function actif($actif)
    {
        if($actif == 1)
            return "Compte actif";
        else
            return "compte non actif";
    }


function getPaypalUrl($token) {    
        $payPalURL = "https://www.paypal.com/incontext?token={$token}";
        if("sandbox" === $this->environment || "beta-sandbox" === $this->environment) {        
            $payPalURL = "https://www.sandbox.paypal.com/incontext?token={$token}";
        }
        return $payPalURL;
    }

