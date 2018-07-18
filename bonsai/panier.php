<?php require ('header.php');
?>

<ol class="breadcrumb">
	<li><a href="index.php">Accueil</a></li>
	<li class="active">Panier</li>
</ol>
<!-- Example row of columns -->
<div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
	<div class=".col-xs-12 .col-sm-6 .col-lg-8">
		<h1> Panier utilisateur</h1>

		<?php if (empty($_SESSION['panier']))
		{
		unset($_SESSION['panier']);
		echo ' Vous n\'avez aucun article dans votre panier.';
		}
		else
		{
			?>
		<table style="margin-left:3%;">
<?php
			if (! isset($_SESSION['panier']))  $_SESSION['panier'] = array();
			// Voici les données externes utilisées par le panier
			$id_article   = isset($_GET['id_article'])   ? $_GET['id_article']   : null;
			$nom_article  = isset($_GET['nom_article'])  ? $_GET['nom_article']  : null;
			$prix_article = isset($_GET['prix_article']) ? $_GET['prix_article'] : '?';
			$qte_article  = isset($_GET['qte_article'])  ? $_GET['qte_article']  : 1;
			$img_article  = isset($_GET['img_article'])  ? $_GET['img_article']  : null;

			if (isset($_GET['ajouter'])){ // Ajouter un nouvel article
				$_SESSION['panier'][$id_article]['nom']  = $nom_article;
				$_SESSION['panier'][$id_article]['prix'] = $prix_article;
				$_SESSION['panier'][$id_article]['qte']  = $qte_article;
				$_SESSION['verrouille'] = false;
			}

			else if (isset($_GET['modifier'])){

				$_SESSION['panier'][$id_article]['qte'] = $qte_article; // Modifier la quantité achetée
			}
			else if (isset($_GET['supprimer']))  
			{
				unset($_SESSION['panier'][$id_article]); // Supprimer un article du panier
			}


			if (isset($_SESSION['panier']) && count($_SESSION['panier'])>0)
			{?>
			<thead> <!-- En-tête du tableau -->
			<tr>
				<th>id Produit</th>
				<th>Image</th>
				<th>Nom du produit</th>
				<th>Prix Unitaire</th>
				<th>Quantité</th>
				<th>Supprimer</th>
			</tr>
			</thead>

			<tfoot> <!-- Pied de tableau -->
			<tr>
				<th>id Produit</th>
				<th>Image</th>
				<th>Nom du produit</th>
				<th>Prix Unitaire</th>
				<th>Quantité</th>
				<th>Supprimer</th>
			</tr>
			</tfoot>

			<tbody> <!-- Corps du tableau -->
			<?php
			$total_panier = 0;
			foreach($_SESSION['panier'] as $id_article=>$article_acheté){
			// On affiche chaque ligne du panier : nom, prix et quantité modifiable + 2 boutons : modifier la qté et supprimer l'article
			if (isset($article_acheté['nom']) && isset($article_acheté['prix']) && isset($article_acheté['qte']) && isset($article_acheté['img']))
			{
			?>

			<tr>
				<td><?=$id_article;?></td>
				<td><img src="img/produit/produit/<?=$article_acheté['img'];?>" height="80" /></td>
				<td><?=$article_acheté['nom'];?></td>
				<td><?=number_format($article_acheté['prix'], 2, ',', ' '), ' CHF' ;?></td>
				<td><form><input type="hidden" name="id_article" value="<?=$id_article;?>" />
						<input type="text" name="qte_article" value="<?=$article_acheté['qte'];?>"  />
						<input type="submit" name="modifier" value="Nouvelle Qté" /></td>

				<td><input type="submit" name="supprimer" value="Supprimer" /></form></td>


				<?php

				// Calcule le prix total du panier
				$total_panier += $article_acheté['prix'] * $article_acheté['qte'];
				}
				}

				echo '</tbody>
						      </table> ';
				echo '<hr><p class="text-right">Total: ', number_format($total_panier, 2, ',', ' '), ' CHF</p>'; // Affiche le total du panier
				echo '<form action="panier.php?processus" method="POST"><input type="submit" name="submit" value="valider le panier" id="submit" />';
				echo '<i>Pour finalisé votre achat, merci de vérifié vos informations de livraison et de cliquer coché la case correspondante, notamment la ville de livraison</i>';

				}
				else { exit(header("location:panier.php")); } // Message si le panier est vide
				?>
	</div>
	<div class="col-lg-4" style="margin : 0 auto;">
		<h3>Information de livraison</h3>
		<?php
		$sql = $bdd->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo");
		$sql->execute(array(':pseudo' => $_SESSION['username']));
		while($membre = $sql->fetch())
		{
			?>

			<div class="form-group">
				<label for="InputPrenom">Prénom</label>
				<input type="text" class="form-control champs" id="InputPrenom" value="<?=$membre['prenom']?>" name="prenom">
			</div>
			<div class="form-group">
				<label for="InputNom">Nom</label>
				<input type="text" class="form-control champs" id="InputNom" value="<?=$membre['nom'];?>" name="nom">
			</div>
			<div class="form-group">
				<label for="InputAdresse">Adresse</label>
				<input type="text" class="form-control champs" id="InputAdresse" value="<?=$membre['adresse'];?>" name="address">
			</div>
			<div class="form-group">
				<label for="InputVille">Ville</label>
				<input type="text" class="form-control" id="InputVille" name="city">
			</div>

			<div class="form-group">
				<label for="InputNumero">Numéro de téléphone</label>
				<input type="text" class="form-control champs" id="InputNumero" value="<?=$membre['telephone'];?>"  name="numero">
			</div>
			<div class="form-group">
				<label for="InputEmail">Email</label>
				<input type="email" class="form-control champs" id="InputEmail" value="<?=$membre['email'];?>" name="email">
			</div>
			<label>Les informations entrés sont correctes</label> <input type="checkbox" name="infoValid" id="nbCheck" value="1" onClick="checkMe()"/><br>
			<?php
		}?>
		</form>
		<?php

			if(isset($_GET['processus']) AND isset($_POST['infoValid']))
			{
				if ($_POST['infoValid'] == 1)
				{
					$_SESSION['verrouille'] = true;
					if (isset($_POST['email']) AND isset($_POST['city']) AND isset($_POST['address']) AND isset($_POST['numero']) AND isset($_POST['prenom']) AND isset($_POST['nom']))
					{
						if ($_POST['email'] AND $_POST['city'] AND $_POST['address'] AND $_POST['numero'] != null)
						{
							$numero = stripslashes($_POST['numero']);
							if(preg_match('/^(0041|041|\+41|\+\+41|41)?(0|\(0\))?([1-9]\d{1})(\d{3})(\d{2})(\d{2})$/', $numero))
							{
								$codePostal = @ereg_replace("[^0-9]","",stripslashes($_POST['city']));

								$sql = $bdd->prepare("SELECT idvilles, nomVille, codePostal FROM ville WHERE codePostal = :codePostal");
								$sql->execute(array(':codePostal' => $codePostal));

								if($sql)
								{
									while ($resultat=$sql->fetch())
									{
										if ($codePostal == $resultat['codePostal'])
										{
											$username = stripslashes($_SESSION['username']);
											$adresse = stripslashes($_POST['address']);

											$sql = $bdd->prepare("UPDATE utilisateur SET email = :email, prenom = :prenom, nom = :nom, adresse = :adresse, telephone = :telephone WHERE pseudo = :pseudo");
											$sql->execute(array(':pseudo' => $_SESSION['username'], ':email' => $_POST['email'], ':prenom' => $_POST['prenom'], ':nom' => $_POST['nom'], ':adresse' => $_POST['address'], ':telephone' => $_POST['numero']));
											if ($sql)
											{
												$prixfinal = $total_panier;
												var_dump($prixfinal);
												
													$port = '12.00';
                                                    $user = "yannick.perret_api1.cpnv.ch";
                                                    $password = 'RZDFX5KY5YJ9UQSY';
                                                    $signature = 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-A0lyKiNoeA9vkJnYuzmMfahLBH3M';

                                                    $params = array(
                                                    'METHOD' => 'SetExpressCheckout',
                                                    'VERSION' => '93',
                                                    'USER' => $user,
                                                    'SIGNATURE'=> $signature,
                                                    'PWD' => $password,
                                                    'RETURNURL' => 'http://bonsaiStore/paypalSuccess.php',
                                                    'CANCELURL' => 'http://bonsaiStore/paypalCancel.php?id='.$id_article,
                                                    'LOCALECODE' => 'CH',
                                                    'LOGOIMG' => 'http://127.0.0.1/bonsaistore/img/Logobonsai-paypal.png',
                                                    'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE',
                                                    'PAYMENTREQUEST_0_AMT' => $prixfinal,
                                                    'PAYMENTREQUEST_0_CURRENCYCODE' => 'CHF',
                                                    'PAYMENTREQUEST_0_SHIPPINGAMT' => $port,
                                                    'PAYMENTREQUEST_0_ITEMAMT' => $prixfinal - $port
                                                    );
                                                    $params = http_build_query($params);
                                                    var_dump($params);
                                                    $endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
                                                    $curl = curl_init();
													curl_setopt_array($curl, array(
                                                    CURLOPT_URL => $endpoint,
                                                    CURLOPT_POST => 1,
                                                    CURLOPT_POSTFIELDS => $params,
                                                    CURLOPT_RETURNTRANSFER => 1,
                                                    CURLOPT_SSL_VERIFYPEER => false,
                                                    CURLOPT_SSL_VERIFYHOST => false,
                                                    CURLOPT_VERBOSE => 1
                                                    ));

                                                    $response = curl_exec($curl);
                                                    $responseArray = array();
                                                    parse_str($response, $responseArray);
                                                    curl_close($curl);
                                                    var_dump($responseArray);
                                                    header('location:https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=comit&token='.$responseArray['TOKEN']);
                                                    die('https://www.sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=comit&token='.$responseArray['TOKEN']);


												}
										}
										else
										{
											$erreur = array("message"=>"Vous avez indiquez une mauvaise ville. Merci d'utiliser l'autocomplétion",
												"type"=>0);
										}
									}
								}
								else
								{
									$erreur = array("message"=>"Vous avez indiquez une mauvaise ville. Merci d'utiliser l'autocomplétion",
										"type"=>0);
								}

							}
							else
							{
								$erreur = array("message"=>"Votre numéro de téléphone est invalide. Merci d'utiliser le format '0244529632'",
									"type"=>0);
							}

						}
						else
						{
							$erreur = array("message"=>"Merci de remplir les champs afin de passer commande",
								"type"=>0);
						}
					}


					if (isset($erreur))
					{
						if ($erreur["type"] == 1)
						{
							?>
							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-3 alert alert-success fade in text-center">
									<?=$erreur['message'];?>
								</div>
							</div>
							<?php
						}
						else
						{

							?>
							<div class="form-group">
								<div class="col-sm-6 col-sm-offset-3 alert alert-danger fade in text-center">
									<?=$erreur['message'];?>
								</div>
							</div>
							<?php
						}
					}
				}
				else
					echo 'Merci de valider vos informations';
			}
	}
	
	?>
	</div>
</div>
<?php require('footer.php');?>
					