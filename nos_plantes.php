x<section>

<?php require_once "inc/header.php"; //inclusion du header ?>
</section>
<?php
//Affichage des produits :
$r = execute_requete(" SELECT DISTINCT nom_article FROM article ");



//Affichage des articles

    $content .= "<div class='row'>";
        //Affichage des articles
		$content .= "<div class='col-3'>";
            

		        while( $article= $r->fetch( PDO::FETCH_ASSOC ) ){

			    //debug( $article );
			    $content .= "<a  class='list-group-item' href='?nom_article=$article[nom_article]'> $article[nom_article] </a>";
		        }
            
        $content .= "</div>";
    
	
	
   

	        //afficher les articles

    
        $content .= "<div class='col-8'>";
           

                if( isset( $_GET['nom_article'] ) ){ //SI il existe une 'nom d'article' dans l'URL, c'est que l'on a cliqué sur une catégorie du menu

                     $r = execute_requete(" SELECT * FROM article WHERE nom_article = '$_GET[nom_article]' ");
                    //Ici, je récupère toutes les informations de la table 'produit' A CONDITION que dans la colonne 'categorie', ce soit égale à la catégorie cliquée (que l'on récupère dans l'URL)

                     while( $produit= $r->fetch( PDO::FETCH_ASSOC ) ){

                    //debug( $produit );

                    
                         $content .= "<div class='row'>";
                            $content .= "<div class='row'>";
                                $content .= "<a  href='profil_nos_plantes.php?id_article=$produit[id_article]'>";
                                //Ici, je crée un lien <a> pour accéder au détails du produit et donc d'accéder au fichier 'fiche_produit.php' et pour pour récupérer les infos du produit sur lequel on a cliqué, je fais passer dans l'URL l'id du produit concerné.

                                    $content .= "<img class='col-3'  src='$produit[photo]' width='100'>";

                                    $content .= "<p class='col-3'> $produit[nom_article] </p>";
                                    $content .= "<p class='col-3'> $produit[prix] </p>";

                                $content .= "</a>";

                         
                        $content .= "</div>";
                    }
                }
                else{ //Lorsque l'on arrive sur la page (et donc que l'on a pas cliqué sur une      catégorie du menu)

                  echo "///  ";
                }
            
        $content .= "</div>";
    $content .= "</div>";
    

//---------------------------------------------------------------------------------------
?>
<h1>Toutes nos plantes</h1>

<?= $content; //affichage du contenu ?>

<?php require_once "inc/footer.php"; //inclusion du footer ?>
