<?php
//inclus un fois le header
require_once('includes/header.php');

//inclus une fois side bar (barre a droite)
require_once('includes/sidebar.php');
require_once('includes/function_panier.php');


$erreur = false;
//si post action existe il devient $post action sinon si c'est il deviens get action
$action =(isset($_POST['action'])?$_POST['action']:(isset($_GET['action'])?$_GET['action']:null));

if ($action !== null)
{
	if (!in_array($action,array('add','delete','refresh')))

		$erreur = true;
		$l =(isset($_POST['l'])?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
		$q =(isset($_POST['q'])?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
		$p =(isset($_POST['p'])?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));

		//remplacer espace vertical
		$l = preg_replace('#\v#','',$l);
		$p = floatval($p);

		if (is_array($q))
		{
			$quantiteProd = array();

			$i = 0;

			foreach ($q as $contenu)
			{
				$quantiteProd[$i++] = intval($contenu);
			}
		}
		else
		{
			$q = intval($q);
		}
}

if (!$erreur)
{
	//sucession de if par rapport action
	switch($action)
	{
		case 'add':

		addProduit($l,$q,$p);
			break;

		case 'delete':

		deleteProduit($l);
		break;

		case 'refresh':

		for($i=0;$i<count($quantiteProd);$i++)
		{
			UpdateQuantiteProd($_SESSION['panier']['libelleprod'][$i], round($quantiteProd[$i]));
		}
		break;

		Default:

		break;
	}
}

?>
<form method="POST" action="" class="fomulairepanier">
	<table width="300">
		<tr>
			<td colspan="4">Votre Panier</td>
		</tr>
		<tr>
			<td>Nom du produit</td>
			<td>Quantité</td>
			<td>Prix</td>
			<td>Action</td>
		</tr>
		<?php
		if (isset($_GET['deletepanier']) && $_GET['deletepanier'] == true)
		{
			deletepanier();
		}
		//si panier n'est pas vide
		if(createpanier())
		{
			$nbProduits = count($_SESSION['panier']['libelleprod']);

			if ($nbProduits <= 0)
			{
				echo "<h4 style='color:red;'>Oops, Votre Panier est vide !</h4><br>";
			}

			else
			{
				//tant encore produits
				for ($i=0; $i<$nbProduits; $i++)
				{ 
					?>
					<tr>
						<td><?php echo $_SESSION['panier']['libelleprod'][$i]; ?></td>
						<td><input value="<?php echo $_SESSION['panier']['quantite'][$i]; ?>" name="q[]" size="5"/></td>
						<td><?php echo $_SESSION['panier']['prixprod'][$i];?>€</td>
						<td><a href="panier.php?action=delete&amp;l=<?php echo rawurlencode($_GET['l']); ?>"><img height="17px" src="images/poubellepanier.png"></a></td>
					</tr>
				<?php
			}

				?>
					<tr>
						<td colspan="2">
							<br>
							<p style="color: red;">Total : <?php echo MontantGlobal(); ?>€</p>
							<a href="#"><button style="background-color: green;color: white;">Valider la commande</button></a>
						</td>
					</tr>
					<tr>

						<td colspan="4">
							<input type="submit" value="refresh"/><br>
							<input type="hidden" name="action" value="refresh"/>
							<a href="?deletepanier=true">Supprimer le panier</a>
						</td>
					</tr>
					<?php

			}

	}
					?>
	</table>
	
</form>
<?php
//inclus une fois le footer
require_once('includes/footer.php');

?>