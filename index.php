
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/js/all.min.js"></script>
   <!-- CDN BOOTSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<!-- CDN FONT AWESOME-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
   <!-- CSS FONT AWESOME-->
    <link rel="stylesheet" href="style.css">

    <title>NatureEmoi - vente de plantes en ligne</title>
</head>
<body>
   <section class="top-page"> 
        <header class="header">
            <img src="logo.png" alt="logo du site">
        
            <nav class="nav">
             <a  href="<?php echo URL ?>accueil.php">Accueil</a>
             <a  href="<?php echo URL ?>nos_plantes.php">Nos plantes</a>

             <?php if( userConnect() ) :  //SI l'internaute est connecté, on affiche les liens 'profil' et 'deconnexion'  ?>

            
            <a  href="<?php echo URL ?>profil.php">Profil</a>
            
            
            <a  href="<?php echo URL ?>connexion.php?action=deconnexion">Deconnexion</a>
           

            <?php else : //SINON, c'es que l'on est pas connecté donc on affiche les liens 'inscription' et 'connexion' ?>

            
            <a href="<?php echo URL ?>connexion.php">Connexion</a>
                    
            
            <a href="<?= URL ?>inscription.php">Inscription</a>
         

            
            <a href="<?= URL ?>panier.php">Panier</a>
         

            <?php endif; ?>

            <?php if( adminConnect() ) : //SI l'ADMIN est connecté, on affiche le menu du backoffice ?>

            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               BackOffice
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
               <li><a class="dropdown-item" href="<?= URL ?>admin/gestion_produit.php"> Gestion de produits </a></li>
               <li><a class="dropdown-item" href="#"> - </a></li>
               <li><a class="dropdown-item" href="#"> - </a></li>
            </ul>
            </li>

            <?php endif; ?>

            </nav>
         </header>
         </section>


        <div class="landing-page"></div>
            <h1 class="big-title"> NatureEmoi, meilleur que le chocolat.</h1>
            <a class="scroll-down" href="">Scroll<i class="fas fa-angle-down"></i></a>
        </div>

    </section> 
    <section class="service" id="service">
        <div class="service-item">
          <i class="fas fa-store delevery-icon"></i> 
          <p class="service-details">Nos magasins à votr service</p> 
        </div>
        <div class="service-item">
            <i class="fas fa-people-carry delevery-icon"></i>
                <p class="service-details">Retrait en magasin sans contact</p>
            
        </div>
        </div>
        <div class="service-item">
            <i class="fas fa-truck delevery-icon"></i>
                <p class="service-details">Livraison à domicile sans contact</p>
            
    </div>
    </section>  

    <section class="best-items" id="best-items">
        <h2 class="section-title">Nos meilleures ventes</h2>
        <div class="best-plants">
            <a class="plant-box plant1 nogrid">
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">24,99</p>
                    
                </div>
                
            </a>
            <a class="plant-box plant2 nogrid">
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">14,99</p>
                </div>
            </a>
            
            <a class="plant-box plant3 nogrid">
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">24,99</p>
                </div>
            </a>
            <a class="plant-box plant4 nogrid">
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">29,99</p>
                </div>
            </a>
        </div>

    </section> 
    <section class="all-plants">
        <h2 class="section-title">Nos plantes</h2>
        <div class="plant-grid">
            
            <a href="" class="plant-grid1 plant-box" >
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">17,99€</p>
                </div>
            </a>
            <a href="" class="plant-grid2 plant-box" >
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">17,99€</p>
                </div>
            </a>
            <a href="" class="plant-grid3 plant-box" >
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">9,99€</p>    
                </div>
            </a>
            <a href="" class="plant-grid4 plant-box" >
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">44,99€</p>
                    
                </div>
            </a>
            <a href="" class="plant-grid5 plant-box" >
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">39,99€</p>
                    

                </div>
            </a>
            <a href="" class="plant-grid6 plant-box" >
                <div class="plant-details">
                    <p class="plant-name">Plante</p>
                    <p class="plant-price">24,99€</p>
                    
                </div>
            </a>
        </div>
        
    </section>
</body>

<footer >
    
        <p >
            &copy;2020-Nature et moi
        </p>
        <a class="cgv" href="<?php echo URL ?>conditions_générales.php">conditions générales de vente</a>
</footer>

<!-- SCRIPT BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<!-- SCRIPT PERSO -->


</body>
</html>