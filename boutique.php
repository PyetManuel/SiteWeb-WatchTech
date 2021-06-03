<?php
require_once('includes/header.php');

require_once('includes/sidebar.php');

			$sql =$cnx->prepare("SELECT * FROM public");
			$sql->execute();
			$tblpublic = $sql->fetchAll(PDO::FETCH_ASSOC);

			foreach ($tblpublic as $tbl)
			{
?>

				<a href="?public=<?php  echo $tbl['name']; ?>" style ="text-align: center;text-decoration: none;color:#2d3a6b;">
				<h4><?php echo $tbl['name']; ?></h4></a>


<?php
 			}
if (isset($_GET['show']))
{
		$products = $_GET['show'];
		$sql =$cnx->prepare("SELECT * FROM produits WHERE title ='$products'");
		$sql->execute();
		$tbl = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach ($tbl as $details)
		{
			echo "<div style='text-align:center;'>";
			echo "<img height ='300px'  width='18%' src='".$details["photo"]."'>";
			echo "<h1>".$details['title']."</h1>";
			echo "<h4>Prix :".$details['price']."€"."</h4>";
			echo "<h5>Description : <br>".$details['description']."</h5>";
		if ($details['stock'] == 0)
		 {
		  	echo "<h4 style='color:red;'>Rupture de stock!</h4>";
		 }
		 else
		 {
		 	echo "<h4 style='color:green;'> En Stock </h4>";
?>
<button><a href="panier.php?action=add&amp;l=<?php echo $details['title'] ?>&amp;q=1&amp;p=<?php echo $details['price'] ?>">Ajouter au panier</a></button>

<?php
		}
			echo "</div>";
		}
}
else
{
	if(isset($_GET['public']))
	{
		$public = $_GET['public'];
		$sql =$cnx->prepare("SELECT * FROM produits WHERE public ='$public'");
		$sql->execute();
		$tbl = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach ($tbl as $tbl_produits)
		{
		//Afficher le tableau avec tout les elements
?>
<div style='float:left; background-color:#fefdcb;margin:5px;padding:5px;text-align:center;'>
		<a href="?show=<?php echo $tbl_produits['title']; ?>"><img height ='231px' src="<?php echo $tbl_produits["photo"]; ?>">
		<br>
	</a>
	<a style ="text-decoration: none;" href="?show=<?php echo $tbl_produits['title']; ?>">
	<h4>
		<?php echo $tbl_produits["title"] ?>
	</h4>
	</a>

<?php


		  echo "PRIX : ".$tbl_produits ["price"]."€"."<br><br>";
		  if ($tbl_produits['stock'] == 0)
		 {
		  	echo "<h5 style='color:red;'>Rupture de stock !</h5>";
		 }
		 elseif($tbl_produits['stock']>0)
		 {
?>
<button><a href="panier.php?action=add&amp;l=<?php echo $tbl_produits['title']; ?>&amp;q=1&amp;p=<?php echo $tbl_produits['price']; ?>">Ajouter au panier</a></button>
<?php
		 }
		 echo "</div>";
		}
 	}
 }
?>
</div>
<?php
require_once('includes/footer.php');
?>