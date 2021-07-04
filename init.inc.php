<?php
//creation/ouverture du fichier de session

//PREMIERE LIGNE DE CODE, se positionne en haut et en premier avant tout traitement php !

//-------------------------------------------
//connexion à la BDD 'boutique'
$pdo = new PDO('mysql:host=localhost;dbname=challenge_php', 'root', 'root', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING) );
//var_dump( $pdo );

//-------------------------------------------
//definition d'une constante 
define( 'URL', 'http://localhost:8888/challenge_php_bootstrap/' ); 
//correspond à l'URL de la racine de notre site 

//-------------------------------------------
//definition de variables :
$content = ''; //variable prévue pour recevoir du contenu
$error = ''; //variable prévue pour recevoir les messages d'erreurs


////////////////////////////////Functions:

function execute_requete( $req ){

	global $pdo;

	$pdostatement = $pdo->query( $req );

	return $pdostatement;
}
function debug( $arg ){

	echo "<div style='background:#fda500; z-index:1000; padding:15px;' >";

		$trace = debug_backtrace();
		//debug_backtrace() : fonction interne de php qui retourne un array avec des infos à liendroot où l'on fait appel a elle.

		echo "Debug demandé dans le fichier : ". $trace[0]['file'] ." à la ligne  ". $trace[0]['line'];

		echo '<pre>';
			print_r( $arg );
		echo '</pre>';

	echo "</div>";
}


//fonction userConnect() : Si l'internaute est connecté, on renvoie 'true', si on n'est pas connecté, on renvoie 'false'
function userConnect(){

	if( !isset( $_SESSION['membre'] ) ){ //SI la session/membre N'EXISTE PAS, cela signifie que l'on est pas connecté et donc on renvoie 'false'

		return false;
	}
	else{ //SINON, c'est que session/membre existe et donc que l'on est connecté, on renvoie 'true'

		return true;
	}
}

//------------------------------------------------------------
//fonction adminConnect() : Si l'admin est connecté, on renvoie 'true', si on n'est pas admin, on renvoie 'false'
function adminConnect(){

	if( userConnect() && $_SESSION['membre']['statut'] == 1 ){ //SI l'utilisateur est connecté ET QU'il est admin, donc que son statut est égal à 1, on renvoie 'true'
	
		return true;
	}
	else{ //SINON, on renvoie false

		return false;
	}
}
?>