<?php
define ("CLEF_SECRETE", "6LdQkR8TAAAAAIxaH_Fof2J-C6UanaXizGU04qch");
// Connexion � la bas de donn�e via PDO
function connexionbdd()
{
$PARAM_hote='yannickpgt1.mysql.db'; // le chemin vers le serveur
$PARAM_port='3306';
$PARAM_nom_bd='yannickpgt1'; // le nom de votre base de donn�es
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

// Fonction de cryptage et injection afin d'avoir un code s�curis�
function hashagePwd ($password)
{
	$passwordCrypt = MD5($password);
	$passwordCrypt = SHA1($passwordCrypt);
	$passwordCrypt = "Ldl3kf&*�@05_".$passwordCrypt."_dfed*�@%fs&4";
	$passwordCrypt = SHA1($passwordCrypt);	
	return $passwordCrypt;
} 

// Traitement des information du captcha depuis google
function CaptchaisValid($code, $ip = null)
{
    if (empty($code)) {
        return false; // Si aucun code n'est entr�, on ne cherche pas plus loin
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
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les probl�mes, si le ser
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

//Autocompl�tion gr�ce au Jquery plugin des villes prises depuis la base de donn�es
    if(isset($_GET['query'])) {
        // Mot tap� par l'utilisateur
        $q = htmlentities($_GET['query']);
 
        // Connexion � la base de donn�es
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=mydb', 'root', '',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));

        } catch(Exception $e) {
            exit('Impossible de se connecter � la base de donn�es.');
        }
 
        // Requ�te SQL
        $requete = "SELECT nomVille, codePostal FROM ville WHERE nomVille LIKE '%" . addslashes($q) . "%'";
 
        // Ex�cution de la requ�te SQL
        $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
 
        // On parcourt les r�sultats de la requ�te SQL
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // On ajoute les donn�es dans un tableau
            $suggestions['suggestions'][] = $donnees['nomVille'].$donnees['codePostal'];

        }
 
        // On renvoie le donn�es au format JSON pour le plugin
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

