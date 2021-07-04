<?php require_once "inc/header.php"; //inclusion du header ?>


<?php

if($_POST){
    $r=execute_requete(" SELECT* FROM membre WHERE pseudo = '$_POST[pseudo]'");
    if($r->rowCount()>=1){
        $membre=$r->fetch( PDO::FETCH_ASSOC );
        //Debug member

        if(password_verify($_POST['mdp'],$membre['mdp'])){
            $_SESSION['membre']=$membre;

            //redirection vers le profil du
            header("location:profile.php");
            exit();
        }
        else{
            $error.="<div class='alert alert-danger'> Pseudo ou mot de passe incorrection</div>";
        }
    }
}



///formulaire
?>


<form method="post" class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Pseudo</label>
    <input type="text" name="pseudo"  class="form-control" >
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword4">
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary">Connexion</button>
  </div>
</form>

<?php require_once "inc/footer.php"; //inclusion du footer ?>