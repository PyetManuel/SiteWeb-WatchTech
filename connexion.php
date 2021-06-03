<?php
//inclus un fois le header
require_once('includes/header.php');
//n'est pas vide
if (isset($_POST['connexion']))
{

    if (!empty($_POST['pseudo'])and !empty($_POST['mdp'])) 
    {
    	$pseudo = $_POST['pseudo'];
    	$mdp = $_POST['mdp'];
        $sql = "SELECT id FROM membre WHERE pseudo = '$pseudo',mdp ='$mdp'";
        $query= $cnx->prepare($sql);
        $query->execute();
    }

}
?>
<div class="formconnexion">
<form method="post" action="">
    <label for="pseudo">Pseudo</label><br />
    <input type="text" id="pseudo" name="pseudo" /><br /> <br />
         
    <label for="mdp">Mot de passe</label><br />
    <input type="password" id="mdp" name="mdp" /><br /><br />
 
     <input name='connexion' type="submit" value="Se connecter"/>
</form>
</div>
<?php

//inclus une fois le footer
require_once('includes/footer.php');
?>
