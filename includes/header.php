<?php
session_start();

try
{
	$cnx = new PDO("mysql:host=localhost;dbname=watchtechoff", "root","" );
}
catch(Exception $e)
{
	echo "Impossible de vous connecter a la base de donnees";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Watchtech</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type ="button" class="navbar-toggle" data-toggle ="collapse" data-target="menunav">
					<span class="icon-bar"></span>
					</button>
					<p class="navbar-brand">WatchTech</p>
				</div>
				<div class="collapse navbar-collapse" id = "">
					<ul class="nav navbar-nav" id="menunav">
					<li><a href="index.php"> ACCUEIL </a></li>
					<li><a href="boutique.php"> BOUTIQUE </a></li>
					<li><a href="panier.php"> PANIER </a></li>
					<li><a href="inscription.php"> INSCRIPTION </a></li>
					<li><a href="connexion.php"> CONNEXION </a></li>
					</ul>
					<form>
						<div style="float: right;margin-top: 10px;">
							<input type="search" name="search">
  									<button type="button">
   										 <a href="?action=search"><img src="bootstrap-icons-1.1.0/bootstrap-icons-1.1.0/search.svg" alt="" width="17" height="20" ></a>
  									</button>
							</p>
						</div>
					</form>
				</div>
			</div>
		</nav>
	</body>
</html>