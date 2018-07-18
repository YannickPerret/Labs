<?php require ('header.php');

?>

	<ol class="breadcrumb">
		<li><a href="./index.php">Accueil</a></li>
		<li class="active">Produit</li>
	</ol>
	<!-- Example row of columns -->
		
	
	
	<div class="row" style=" margin-top : 10px;">
		<div class=".col-xs-12 .col-sm-6 .col-lg-8 alert alert-danger" id="erreurProduit">
		<?php
		if(isset($_SESSION['erreur']))
			{
			echo $_SESSION['erreur'];
			unset($_SESSION['erreur']);
		}?>
		</div>
	</div>
	<div class="row" style=" margin-top : 10px;">
		<div class=".col-xs-12 .col-sm-6 .col-lg-8">

			<div class="col-lg-2" style="border:solid #c1c1c1 2px;">
				<form action="produit.php" method="GET">
					<?php
					$sql = $bdd->prepare("SELECT * FROM type");
					$sql->execute();
					while ($resultat = $sql->fetch())
					{
						?>
						<input type="checkbox" name="idtype" value="<?=$resultat['idtype'];?>"><?=$resultat['nomType'];?><br>
						<?php
					}?>
					<input type="submit" class="btn btn-default" value="Recherche" >
					<a href="produit.php" alt="Page produit">Réinitialiser filtre</a>
					<input id="ex2" type="text" class="span2" value="250,450" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]" style="display: none;" data-value="250,450">
				</form>

			</div>

			<div class="col-lg-10" style="border:solid #c1c1c1 2px;">
				<div class="row">
					<?php
					if(isset($_GET['idtype']))
					{
						$sql = $bdd->prepare("SELECT idProduits, nomProduit, description, imageProduit, age, prixUnit, type_idtype FROM produit WHERE type_idtype = :type");
						$sql->execute(array(':type' => $_GET['idtype']));
					}
					else
					{
						$sql = $bdd->prepare("SELECT idProduits, nomProduit, description, imageProduit, age, prixUnit, type_idtype FROM produit");
						$sql->execute();
					}

					while ($produit = $sql->fetch())
					{?>
						<div class="col-lg-3">
							<div class="panel panel-default">
								<div class="panel-body">
									<img src="./img/produit/produit/<?=$produit['imageProduit'];?>" width="180px"/>
									<p><?=$produit['nomProduit'];?> <?=$produit['age'];?> ans</p>
								</div>
								<div class="panel-footer">
									<a href="produit.php?id_article=<?=$produit['idProduits'];?>&nom_article=<?=htmlspecialchars($produit['nomProduit']);?>&img_article=<?=$produit['imageProduit'];?>&prix_article=<?=$produit['prixUnit'];?>&ajouter" class="btn btn-info" role="button" style="float:left;" id="ajouter"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>&nbsp;&nbsp;
									<!-- Small modal -->
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example<?=$produit['idProduits'];?>">Information</button>
									<p class="text-right">Prix: <?=$produit['prixUnit'];?> CHF</p>
								</div>
							</div>
						</div>
						<div class="modal fade bs-example<?=$produit['idProduits'];?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title"><?=$produit['nomProduit'];?></h4>
									</div>
									<div class="modal-body">
										<center><img src="./img/produit/produit/<?=$produit['imageProduit'];?>" width="180px"/></center>
										<p><p><?=$produit['description'];?></p></p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>
						<?php
					}
					if (isset($_SESSION['username']))
					{
						if (! isset($_SESSION['panier']))  $_SESSION['panier'] = array();

						// Voici les données externes utilisées par le panier
						$id_article   = isset($_GET['id_article'])   ? $_GET['id_article']   : null;
						$nom_article  = isset($_GET['nom_article'])  ? $_GET['nom_article']  : null;
						$prix_article = isset($_GET['prix_article']) ? $_GET['prix_article'] : '?';
						$qte_article  = isset($_GET['qte_article'])  ? $_GET['qte_article']  : 1;
						$img_article  = isset($_GET['img_article'])  ? $_GET['img_article']  : null;


						// Voici les traitements du panier
						if ($id_article == null) echo ''; // Message si pas d'acticle sélectionné
						else
							if (isset($_GET['ajouter'])){ // Ajouter un nouvel article
								$_SESSION['panier'][$id_article]['nom']  = $nom_article;
								$_SESSION['panier'][$id_article]['prix'] = $prix_article;
								$_SESSION['panier'][$id_article]['qte']  = $qte_article;
								$_SESSION['panier'][$id_article]['img']  = $img_article;
								$_SESSION['verrouille'] = false;
								unset($_SESSION['erreur']);
								$_SESSION['erreur'] ="L'article a bien été ajouté au panier";
								exit(header("location:produit.php"));
									
							}

							else if (isset($_GET['modifier']))  $_SESSION['panier'][$id_article]['qte'] = $qte_article; // Modifier la quantité achetée
							else if (isset($_GET['supprimer']))  unset($_SESSION['panier'][$id_article]); // Supprimer un article du panier
					}		
					else 
					{
						unset($_SESSION['erreur']);
						$_SESSION['erreur'] = "Merci de vous connecter pour ajouter un article au panier";

					}
									
					?>



				</div>
			</div>
		</div>
	</div>
		
<?php require('footer.php');?>