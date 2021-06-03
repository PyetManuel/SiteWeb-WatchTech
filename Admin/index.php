<?php

session_start();

$user= 'Nick';
$passworddef = 'nico';

if(isset($_POST['submit']))
{
	$login = $_POST['login'];
	$password = $_POST['password'];

	if (!empty($_POST['login'])&&(!empty($_POST['password'])))
	{
		if ($login == $user && $password == $passworddef)
		{
			$_SESSION['login'] = $login;
			header('Location:admin.php');
		}
		else
		{
			echo "Identifiant ou mot de passe incorrectes<br> Veuillez reessayer !";

		}
	}
	else
	{
		echo "Veuillez remplir tout les champs";
	}
}
?>
<link rel="stylesheet" type="text/css" href="style/bootstrap.css">
<h1> Administration - Connexion </h1>

<form action="" method="POST">
	<h3> Pseudo :</h3><input type="text" name="login"><br><br>
	<h3> Mot de passe :</h3><input type="password" name="password"><br><br>
	<input type="submit" name="submit">
</form>