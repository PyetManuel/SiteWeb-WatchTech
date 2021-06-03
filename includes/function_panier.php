<?php

//fonction creation du panier

function createpanier()
{
	try
{
	$cnx = new PDO("mysql:host=localhost;dbname=watchtechoff", "nico","bts" );
}
catch(Exception $e)
{
	echo "Impossible de vous connecter a la base de donnees";
}

	//si panier existe pas
	if(!isset($_SESSION['panier']))
	{
		//tableau a deux entree
		$_SESSION['panier']= array();
		$_SESSION['panier']['libelleprod']= array();
		$_SESSION['panier']['quantite']= array();
		$_SESSION['panier']['prixprod']= array();
		//si panier verouiller par defaut faux
		$_SESSION['panier']['verr']= false;
	}

	return true;
}

function addProduit($libelleprod,$quantite,$prixprod)
{
	if(createpanier() && !isVerouille())
	{
		$position_prod = array_search($libelleprod, $_SESSION['panier']['libelleprod']);

		//si le produit deja ajouter
		if ($position_prod !== false)
		{
			//on incremente la quantite (quantite)
			$_SESSION['panier']['quantite'][$position_prod] +=$quantite;
		}
		else
		{
			//ajoute valeur dans le $SESSION panier
			array_push($_SESSION['panier']['libelleprod'],$libelleprod);
			array_push($_SESSION['panier']['quantite'],$quantite);
			array_push($_SESSION['panier']['prixprod'],$prixprod);
		}
	}
	else
	{
		echo "Erreur, veuillez contactez l\'administrateur";
	}
}

function UpdateQuantiteProd($libelleprod,$quantite)
{
	//si panier existe
	if (createpanier() && !IsVerouille())
	{
		//si quantite est positive on modifie sinon on supprimer article
		if($quantite > 0)
		{
			//recherche position du produits dans le panier
			$position_prod = array_search($libelleprod, $_SESSION['panier']['libelleprod']);

			//si trouve le produits
			if ($position_prod !== false)
			{
				$_SESSION['panier']['quantite'][$position_prod] = $quantite;
			}
		}
		else
		{
			deleteProduit($libelleprod);
		}
	}
	else
	{
		echo "Erreur, veuillez contactez un administrateur";
	}
}

function deleteProduit($libelleprod)
{
	if (createpanier() && !IsVerouille())
	{
		//tableau panier temporaire
		$temp = array();
		$temp['libelleprod']=array();
		$temp['quantite']=array();
		$temp['prixprod']=array();
		$temp['verr']=$_SESSION['panier']['verr'];

		//
		for($i = 0; $i<count($_SESSION['panier']['libelleprod']); $i++)
		{
			if($_SESSION['panier']['libelleprod'][$i] !== $libelleprod)
			{
				array_push($temp['libelleprod'],$_SESSION['panier']['libelleprod'][$i]);
				array_push($temp['quantite'],$_SESSION['panier']['quantite'][$i]);
				array_push($temp['prixprod'],$_SESSION['panier']['prixprod'][$i]);

			}
		}

		//declare que session panier est egale à panier temporaire
		$_SESSION['panier'] = $temp;

		//supprimer
		unset($temp);
	}
	else
	{
		echo "Erreur, veuillez contactez un des administrateurs";
	}
}

function deletepanier()
{
	if(isset($_SESSION['panier']))
	{
		unset($_SESSION['panier']);
	}
}

function MontantGlobal()
{
	$total = 0;

	//pour quand tombe sur un produit
	for($i=0; $i < count($_SESSION['panier']['libelleprod']); $i++)
	{
		$total += $_SESSION['panier']['quantite'][$i] *$_SESSION['panier']['prixprod'][$i];
	}

	return $total;
}

function IsVerouille()
{
	if (isset($_SESSION['panier']) && $_SESSION['panier']['verr'])
	{
		return true;
	}
	else
	{
		return false;
	}
}

function countProduit()
{
	//si panier existe
	if (isset($_SESSION['panier']))
	{
		return count($_SESSION['panier']['libelleprod']);
	}
	else
	{
		return 0;
	}
}




?>