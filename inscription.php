<?php require_once "inc/header.php"; //inclusion du header ?>

<?php
if(userConnect()){
    header("Location:accueil.php");
    exit;
}
if ($_POST){//s'il il y a validation--method post dans les formulaires

//on controle les saisies :

//1-on controme ma taille du pseudo 
    if(strlen($_POST['pseudo'])<=3 || strlen($_POST['pseudo'])> 15){
        $error.="<div> Veuillez rentrer un pseudo comprenant entre 3 et 15 caractéres </div>";

    }

    //test si pseudo disponibles
    $r=execute_requete(" SELECT pseudo FROM membre WHERE pseudo='$_POST[pseudo]'");
    //var_dump( $r ); 
    if($r->rowCount()>=1){
        $error.="<div>Ce pseudo est indisponible</div>";
    }
    //boucle  sur toutes les saisies afin de les passer dans les fonctions htmlentities() et addslashes()
	foreach( $_POST as $indice => $valeur ){

		$_POST[$indice] = htmlentities( addslashes( $valeur ) );
	}

    //criptage du mot de passe

    $_POST['mdp'] = password_hash( $_POST['mdp'] , PASSWORD_DEFAULT );
//insertion des Données

    if(empty($error)){
        execute_requete(" INSERT INTO membre( pseudo, mdp, nom, prenom, email, sexe, ville, adresse, cp )

						VALUES ( 
									'$_POST[pseudo]',
									'$_POST[mdp]',
									'$_POST[nom]',
									'$_POST[prenom]',
									'$_POST[email]',
									'$_POST[sexe]',
									'$_POST[ville]',
									'$_POST[adresse]',
									'$_POST[cp]'
						)
					");

		$content .= "<div class='alert alert-success'> Inscription Validée
						<a href='". URL ."connexion.php'>
							Cliquez ici pour vous connecter
						</a>
					</div>";
    };
};


//---------------------------------------------------------------------------------------
?>
<h1 class="inscription">Inscription</h1>

<?= $content; //affichage du contenu ?>

<?php echo $error; //affichage des messages d'erreurs ?>

<?= $content; //affichage du contenu ?>

<form method="post" class="inscription">
	
	<label>Pseudo</label><br>
	<input type="text" name="pseudo"><br>
	
	<label>Mot de passe</label><br>
	<input type="text" name="mdp"><br>
	
	<label>Nom</label><br>
	<input type="text" name="nom"><br>
	
	<label>Prénom</label><br>
	<input type="text" name="prenom"><br>
	
	<label>Email</label><br>
	<input type="text" name="email"><br>
	
	<label>Civilité</label><br>
	<input type="radio" name="sexe" value="f" checked>Femme<br>
	<input type="radio" name="sexe" value="m">Homme<br><br>
	
	<label>Adresse</label><br>
	<input type="text" name="adresse"><br>
	
	<label>Ville</label><br>
	<input type="text" name="ville"><br>
	
	<label>Code postal</label><br>
	<input type="text" name="cp"><br><br>

	<input type="submit" class="btn btn-secondary" value="S'inscrire">
</form>

<?php require_once "inc/footer.php"; //inclusion du footer ?>