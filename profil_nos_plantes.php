<section>

<?php require_once "inc/header.php"; //inclusion du header ?>
</section>
<?php

//debug( $_GET );

if( isset( $_GET['id_article'] ) ){ //SI il y a une 'id_produit' dans l'URL, c'est que l'on a choisi délibérément d'afficher la fiche d'un produit en particulier. On récupère les infos du produit grâce à l'id passée dans l'URL

	$r = execute_requete(" SELECT * FROM article WHERE id_article = '$_GET[id_article]' ");

}
else{ //SINON, on redirige vers la page d'accueil (si on force l'accès à la page via l'URL et donc qu'il n'y a pas d'id_produit)

	header('location:index1.php');
	exit;
}
//---------------------------------------------
//EXERCICE : 
	//créer 2 liens : (file d'ariane)
		//l'un pour permettre de retourner à l'accueil
		//l'autre pour retourner à la catégorie précédente
	//affichez la liste des informations des produits SAUF l'id_produit et le stock
	//Pour l'image, on affichera l'image et non pas l'adresse de la bdd

//gérer le stock à part !
	//SI il est supérieur à ZERO, on affiche le nombre de produits disponibles dans un <select> avec le nombre d'options correspondant au stock
	//SINON, on affiche rupture de stock

//exploitation des données récupérées :
$produit = $r->fetch( PDO::FETCH_ASSOC );
	debug( $produit );

    $content .= "<a href='accueil.php?categorie=$produit[nom_article]'> $produit[nom_article] </a><hr>";




foreach( $produit as $indice => $valeur  ){
	
	
    if( $indice == 'photo' ){ //SI l'indice est égal à 'photo', on affiche la valeur correspondante dans l'attribut src='' d'une balise <img>

		$content .= "<p><img src='$valeur' width='200'></p>";
	}
	elseif( $indice != 'id_article' && $indice != 'stock' ){ //SI l'indice du tableau ($produit) est différent de 'id_produit' ET de 'stock', on les affiche

		$content .= "<p><strong> $indice </strong> : $valeur</p>";

	}
}

//------------------------------------------------------------


//-------------------------------------------------------------------------------
?>
<h1>FICHE PRODUIT</h1>

<?php echo $content; ?>

<?php require_once "inc/footer.php"; ?>