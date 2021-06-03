<?php
//session ouverte
session_start();

//connexion bdd
try
{
	$cnx = new PDO("mysql:host=localhost;dbname=watchtechoff", "root","" );
}
catch(Exception $e)
{
	echo "Impossible de vous connecter a la base de donnees";
}

if(isset($_SESSION['login']))
{
?>
<!---------------------------------------------------------Texte Afficher avec nom login-------------------------------------------------------------->
<link rel="stylesheet" type="text/css" href="style/bootstrap.css">
	<h1>Bienvenue, <?php echo $_SESSION['login'];?></h1>
		<br>
			<button><a href="?action=add"> Ajouter un produit </a></button>
			<button><a href="?action=modifyanddelete"> Modifier/Suprimer un produit </a></button><br>
<?php
	if(isset($_GET['action']))
	{
		if ($_GET['action'] == 'add')
	{
		if (isset($_POST['submit']))
		{
			$title = $_POST['title'];
			$reference = $_POST['reference'];
			$description = $_POST['description'];
			$couleur = $_POST['couleur'];
			$photo = $_POST['photo'];
			$price = $_POST['price'];
			$public = $_POST['public'];
			$stock = $_POST['stock'];

			if ($title&&$reference&&$description&&$couleur&&$public&&$photo&&$price&&$stock)
			{
				$public = $_POST['public'];

				$req = "INSERT INTO produits VALUES('','$title','$reference','$description','$couleur','$public','$photo','$price')";
				//prepare
    			$query = $cnx->prepare($req);
    			//execute
    			$query->execute();
    			header('Location:admin.php?action=modifyanddelete');

			}
			else
			{
				echo " Veuillez remplir tous les champs <br>";
			}
		}
?>

<!--------------------FORMULAIRE PRODUITS---------------------------->
<h3> AJOUTER UN PRODUIT</h3>
<form action="" method="POST" enctype="multipart/form-data">
<h3>Titre du produits :</h3><input type="text" name="title">
<h3>Reference du produits :</h3><input type="text" name="reference">
<h3>Description :</h3><textarea type="text" name="description"></textarea>
<h3>Couleur du produits :</h3><input type="text" name="couleur">
<h3>Public :</h3>
	<select name ="public">
		<?php

		$sql =$cnx->query("SELECT * FROM public");
		$tblpublic = $sql->fetchAll(PDO:: FETCH_ASSOC);

		foreach($tblpublic as $tbl)
		{
			echo "<option>".$tbl['name']."</option>";
		}
		?>
	</select>
<h3>Photo du produit :</h3><input type="text" name="photo" placeholder = "images/..">
<h3>Prix du produits :</h3><input type="text" name="price">
<h3>Stock :</h3><input type="text" name="stock"><br><br>
<input type="submit" name="submit" value="Ajouter">
</form>

<!--Continue avec l'action modify et supprimer(lien)---->
<?php
	}
	elseif($_GET['action'] == 'modifyanddelete')
	{
		$sql =$cnx->prepare("SELECT * FROM produits");
		$sql->execute();
		$tbl = $sql->fetchAll(PDO:: FETCH_ASSOC);

?>
<table border = 2>
<h3> Liste des produits </h3>
			<tr>
			<td>Titre</td>
			<td>Reference</td>
			<td>Description</td>
			<td>Couleur</td>
			<td>Public</td>
			<td>Photo</td>
			<td>Prix</td>
			<td>Stock</td>
			<td>ACTIONS</td>
			</tr>
<?php
		foreach ($tbl as $tblProd)
		{

			echo '
			<tr>
			<td>'.$tblProd['title'].'</td>
			<td>'.$tblProd['reference'].'</td>
			<td>'.$tblProd['description'].'</td>
			<td>'.$tblProd['couleur'].'</td>
			<td>'.$tblProd['public'].'</td>
			<td>'.$tblProd['photo'].'</td>
			<td>'.$tblProd['price'].'</td>
			<td>'.$tblProd['stock'].'</td>
			<td>'.'<button><a href="?action=modify&amp;id='.$tblProd['id'].'">Modifier</button>
				<button><a href="?action=delete&amp;id='.$tblProd['id'].'">Supprimer</button>'.'<br></td>
			';
		}
?>
</table>
<?php

	}
	elseif ($_GET['action'] == 'modify')
	{

		$id = $_GET['id'];

		$req = "SELECT * FROM produits WHERE id=$id";
		//prepare
    	$query = $cnx->prepare($req);
    	//execute
    	$query->execute();
		$datareq = $query->fetch(PDO:: FETCH_ASSOC);

?>

<form action="" method="POST" enctype="multipart/form-data">
<h3>Titre du produits</h3><input value="<?php echo $datareq['title']; ?>" type="text" name="title">
<h3>Reference du produits</h3><input value="<?php echo $datareq['reference']; ?>" type="text" name="reference">
<h3>Description</h3><textarea type="text" name="description"><?php echo $datareq['description']; ?></textarea>
<h3>Couleur du produits</h3><input value="<?php echo $datareq['couleur']; ?>" type="text" name="couleur">
<h3>Public :</h3>
	<select name ="public" value="<?php echo $datareq['public']; ?>">
		<?php

		$sql =$cnx->query("SELECT * FROM public");
		$tblpublic = $sql->fetchAll(PDO:: FETCH_ASSOC);

		foreach($tblpublic as $tbl)
		{
			echo "<option>".$tbl['name']."</option>";
		}
		?>
	</select>
<h3>Photo du produit</h3><input  value="<?php echo $datareq['photo']; ?>"type="text" name="photo" placeholder = "images/..">
<h3>Prix du produits</h3><input  value="<?php echo $datareq['price']; ?>"type="text" name="price">
<h3>Stock :</h3><input  value="<?php echo $datareq['stock']; ?>"type="text" name="stock"><br><br>
<input type="submit" name="submit" value="Modifier"/>
</form>
		<?php
	if(isset($_POST['submit']))
	{
			$title = $_POST['title'];
			$reference = $_POST['reference'];
			$description = $_POST['description'];
			$couleur = $_POST['couleur'];
			$public = $_POST['public'];
			$photo = $_POST['photo'];
			$price = $_POST['price'];
			$stock =$_POST['stock'];

			$req = "UPDATE produits SET title='$title',reference='$reference',description='$description',
			couleur='$couleur',public='$public',photo='$photo',price='$price',stock='$stock' WHERE id =$id ";
			$query = $cnx->prepare($req);
			$query->execute();

			header('Location:admin.php?action=modifyanddelete');

	}
		
	}
	elseif ($_GET['action'] == 'delete')
	{
		$id = $_GET['id'];
		$sql =$cnx->prepare("DELETE FROM produits where id = $id");
		$sql->execute();
		header('Location:admin.php?action=modifyanddelete');
	}
	else
	{
		die("Une erreur s\'est produite.");
	}
	}
}
else
{
	header('Location:../index.php');
}
?>
