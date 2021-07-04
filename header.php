<?php require_once "inc/init.inc.php"; //inclusion du fichier init.inc.php dans le header ?>

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