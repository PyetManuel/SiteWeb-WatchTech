
<?php
//inclus un fois le header
require_once('includes/header.php');

//n'est pas vide
if (isset($_POST['inscription']))
{
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $civilite = $_POST['civilite'];
    $ville = $_POST['ville'];
    $codepostal = $_POST['code_postal'];
    $adresse= $_POST['adresse'];

    if (!empty($pseudo)and !empty($mdp) and !empty($nom)and !empty($prenom)and !empty($email)and !empty($civilite)and !empty($ville)and !empty($codepostal)and !empty($adresse)) 
    {
        $sql = "INSERT INTO membre VALUES('','$pseudo','$mdp','$nom','$prenom','$email','$civilite','$ville','$codepostal','$adresse')";
        $query = $cnx->prepare($sql);
        $query->execute();

        echo "Vous avez été inscrit ! "."<br>"."Veuillez maintenant vous connecter";
        header('Location:connexion.php');

    }
    else
    {
        echo "Veuillez remplir tout les champs<br>";
    }
}
?>
<form method="POST" action="">

    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" placeholder="votre pseudo"  ><br><br>
         
    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" ><br><br>
         
    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" placeholder="votre nom"><br><br>
         
    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" placeholder="votre prénom"><br><br>
 
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br><br>
         
    <label for="civilite">Civilité</label><br>
    <input name="civilite" value="m" checked="" type="radio">Homme
    <input name="civilite" value="f" type="radio">Femme<br><br>
                 
    <label for="ville">Ville</label><br>
    <input type="text" id="ville" name="ville" placeholder="votre ville"><br><br>
         
    <label for="codepostal">Code Postal</label><br>
    <input type="text" id="code_postal" name="code_postal" placeholder="974.." pattern="[0-9]{5}" title="5 chiffres requis : 0-9"><br><br>
         
    <label for="adresse">Adresse</label><br>
    <textarea id="adresse" name="adresse" placeholder="votre adresse"></textarea><br><br>
 
    <input name="inscription" value="S'nscrire" type="submit">
</form>
<?php

//inclus une fois le footer
require_once('includes/footer.php');
?>