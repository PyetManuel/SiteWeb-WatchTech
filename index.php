
<?php
//inclus un fois le header
require_once('includes/header.php');
//inclus une fois side bar (barre a droite)
?>
<img style= "width: 100%; height: 600px;" src="images/acceuil.jpg">
<?php
require_once('includes/sidebar.php');
?>
 <div>
        <a href="montrefemmes.php"><img src="images/cartier1.jpg" width="75%"></a>
        <?php
        $aff = $cnx->prepare("SELECT * FROM produits ORDER BY id LIMIT 0,5");
		$aff->execute();
		$tblprod = $aff->fetchAll(PDO::FETCH_ASSOC);

		foreach ($tblprod as $tbl_produit)
		{
		//Afficher le tableau avec tout les elements

 		echo "<div style='float:left;padding-left:30px;'><a href =''><img height ='210px'src='".$tbl_produit["photo"]."'><br></a>";
 		echo "<h4>".$tbl_produit["title"]."</h4><h4>".$tbl_produit["public"]."</h4>";
  		echo "<h5>PRIX : ".$tbl_produit ["price"]."€"."</h5><br></div>";
 }
        ?>
     	 <a href="montrefemmes.php"><img src="images/dior1.jpg" width="75%"></a>
  </div>
<?php


//inclus une fois le footer
require_once('includes/footer.php');
?>
