<link rel="stylesheet" type="text/css" href="style/style1.css">
<div class="sidebar">
<h4> Derniers articles</h4>	
<?php
$aff = $cnx->prepare("SELECT * FROM produits ORDER BY id DESC LIMIT 0,3");
		$aff->execute();
		$tblprod = $aff->fetchAll(PDO::FETCH_ASSOC);

		foreach ($tblprod as $tbl_produit)
		{
		//Afficher le tableau avec tout les elements
echo "<div style='text-align:center;'>";
 echo "<a href =''><img height ='200px'src='".$tbl_produit["photo"]."'><br></a>";
 echo "<h4>".$tbl_produit["title"]."</h4><h4>".$tbl_produit["public"]."</h4>";
  echo "<h5>PRIX : ".$tbl_produit ["price"]."€"."</h5><br>";
  echo "</div>";
 }
 ?>
</div>