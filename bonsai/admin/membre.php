<?php
session_start();
ob_start();
if (isset($_SESSION['role']) AND $_SESSION['role'] == 2)
{
	include ('../include/function.php');
	$bdd = connexionbdd();
	?>
	<!DOCTYPE html>
	<html lang="fr">
	    <head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../img/favicon.gif">

	    <title>Bonsaï-Store - Achetez votre bonsaï en ligne - Page d'accueil</title>

	    <!-- Bootstrap core CSS -->
	    <link href="../css/bootstrap.min.css" rel="stylesheet">

	    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		
		<!-- Plugin jquery design slider range -->
		<link href="../css/bootstrap-slider.min.css" rel="stylesheet">

	    <!-- Custom styles for this template -->
	    <link href="../css/justified-nav.css" rel="stylesheet">

	    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	    <!--[if lt IE 9]><script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
	    <script src="../js/ie-emulation-modes-warning.js"></script>

	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	  </head>

	<body>

	    <div class="container">
	      <!-- The justified navigation menu is meant for single line per list item.
	           Multiple lines will require custom code not provided by Bootstrap. -->
	      <div class="masthead">
	        <h3 class="text-muted"><img src="../img/Logobonsai-store.png" height="120px"></h3>
	        <nav>
	          <ul class="nav nav-justified">
	            <li><a href="../index.php">Accueil</a></li>
	            <li><a href="../produit.php">Produit</a></li>

	            <?php
	            if (isset ($_SESSION['username'])) 
	            {
	              if (isset($_SESSION['role']) AND $_SESSION['role'] == 2)
	              {
	                echo '<li><a href="../admin/produit.php" alt="Administration des produits">Admin produit</a></li>';
	                echo '<li><a href="../admin/membre.php" alt="Administration des membres">Admin Membre</a></li>';
	              }
	               if(isset($_SESSION['panier']) AND !empty($_SESSION['panier']))
	              echo '<li><a href="../panier.php" alt="Panier utilisateur">Panier</a></li>';
	              echo '<li><a href="../logout.php" alt="Déconnexion du site">Déconnexion</a></li>';

	            }
	            else
	            {
	             echo' <li><a href="../inscription.php">Inscription</a></li>
	              <li><a href="../login.php">Connexion</a></li>';
	            }
	            ?>
	            <li><a href="../contact.php">Contact</a></li>
	          </ul>
	        </nav>
	      </div>

	<ol class="breadcrumb">
	  <li><a href="../index.php">Accueil</a></li>
	  <li>Administration</li>
	  <li class="active">Produit</li>
	</ol> 
	<!-- Carousel-->

	      <!-- Example row of columns -->
	    <div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
			<div class=".col-xs-12 .col-sm-6 .col-lg-8">
				<h1> Administration des produits en vente </h1>
				<form action="membre.php?action=ajouter" method="POST" class="text-right">
				<input type="submit" value="Ajouter un membre" />
				</form>
				<table style="margin-left:3%;">
				   <caption>Listes des membres du site</caption>

				   <thead> <!-- En-tête du tableau -->
				       <tr>
				           <th>id</th>
				           <th>Pseudo</th>
				           <th>Prénom</th>
				           <th>Nom</th>
				           <th>Email</th>
				           <th>Genre</th>
				           <th>Adresse</th>
				           <th>Téléphone</th>
				           <th>Date d'inscription</th>
				           <th>Actif</th>
				           <th>Modification</th>
				           <th>Suppression</th>

				       </tr>
				   </thead>

				   <tfoot> <!-- Pied de tableau -->
				       <tr>
				           <th>id</th>
				           <th>Pseudo</th>
				           <th>Prénom</th>
				           <th>Nom</th>
				           <th>Email</th>
				           <th>Genre</th>
				           <th>Adresse</th>
				           <th>Téléphone</th>
				           <th>Date d'inscription</th>
				           <th>Actif</th>
				            <th>Modification</th>
				           <th>Suppression</th>
				       </tr>
				   </tfoot>

				   <tbody> <!-- Corps du tableau -->
					<?php
						$sql = $bdd->prepare("SELECT * FROM utilisateur");
						$sql->execute();

						while($membre = $sql->fetch())
						 {
						 	$genre = genre($membre['genre']);
						 	$actif = actif($membre['actif']);
							echo '<tr>
					           <td>'.$membre['idutilisateurs'].'</td>
					           <td>'.$membre['pseudo'].'</td>
					           <td>'.$membre['prenom'].'</td>
					           <td>'.$membre['nom'].'</td>
					           <td>'.$membre['email'].'</td>
					           <td>'.$genre.'</td>
					           <td>'.$membre['adresse'].'</td>
					           <td>'.$membre['telephone'].'</td>
					           <td>'.$membre['dateInscription'].'</td>
					           <td>'.$actif.'</td>
					           <td><a href="membre.php?action=modification&id='.$membre['idutilisateurs'].'"><img src="../img/membre/modification.png" height="30" /></a></td>
					           <td><a href="membre.php?suppression&id='.$membre['idutilisateurs'].'"><img src="../img/membre/supprimer.png" height="30"/></a></td>
					       </tr>	';
						}

					?>
					  </tbody>
					</table>
					<br>
					<?php
						if (isset($_GET['action']) AND isset($_GET['id']))
						{

							if($_GET['action'] == "modification")
							{
								echo '<span id="modification"><h1>Modification</h1></div>';
								$sql = $bdd->prepare("SELECT * FROM utilisateur WHERE idutilisateurs = :id");
								$sql->execute(array(':id'=>$_GET['id']));
								?>
								<form action="membre.php?action=modification&valid=1&id=<?=$_GET['id'];?>#modification" method="POST">
								<?php
								while($membre = $sql->fetch())
								{
									$genre = genre($membre['genre']);
									?>
									<input type="hidden" name="id" value="<?=$membre['idutilisateurs'];?>">
									<label>Pseudo</label><input type="text" name="username" Value="<?=$membre['pseudo'];?>"><br>
									<label>Mot de passe</label><input type="password" name="password" Value=""><br>
									<label>Email</label><input type="email" name="email" Value="<?=$membre['email'];?>"><br>
									<label>Prénom</label><input type="text" name="prenom" Value="<?=$membre['prenom'];?>"><br>
									<label>Nom</label><input type="text" name="nom" Value="<?=$membre['nom'];?>"><br>
									<label>Adresse</label><input type="text" name="adresse" Value="<?=$membre['adresse'];?>"><br>
									<label>Téléphone</label><input type="text" name="telephone" Value="<?=$membre['telephone'];?>"><br>
									
									<label>genre</label><input type="text" name="genre" Value="<?=$genre;?>"><br>
									<?php
									if ($membre['actif'] == 1) echo '<input type="radio" name="actif" value="1" checked> Actif';
									else echo '<input type="radio" name="actif" value="1"> Actif';
									if ($membre['actif'] == 0) echo '<input type="radio" name="actif" value="0" checked> Non-Actif<br>';
									else echo '<input type="radio" name="actif" value="0"> Non-Actif<br>';
								}
									?>			
									<input type="submit" value="Modifier">
									</form>
									<?php
									if (isset($_GET['valid']))
									{
										if (isset($_POST['password']))
										{
											$password = stripslashes(hashagePwd($_POST['password']));
											$sql = $bdd->prepare("UPDATE utilisateur SET pseudo = :pseudo, password = :password, email = :email, prenom = :prenom, nom = :nom, adresse = :adresse, telephone = :telephone, actif = :actif WHERE idutilisateurs = :id");
											$sql->execute(array(':pseudo' => $_POST['username'], ':password' => $password, ':email' => $_POST['email'], ':prenom' => $_POST['prenom'], ':nom' => $_POST['nom'], ':adresse' => $_POST['adresse'], ':telephone' => $_POST['telephone'], ':actif'=> $_POST['actif'], ':id'=>$_POST['id']));
											if($sql){
												echo 'L\'utilisateur a bien été modifié';
												exit(header("Refresh: 2;URL=membre.php"));
											}

											else echo "l'utilisateur n'a pas été modifier";
										}
										else
										{
											$sql = $bdd->prepare("UPDATE utilisateur SET pseudo = :pseudo, email = :email, prenom = :prenom, nom = :nom, adresse = :adresse, telephone = :telephone, actif = :actif WHERE idutilisateurs = :id");
											$sql->execute(array(':pseudo' => $_POST['username'], ':email' => $_POST['email'], ':prenom' => $_POST['prenom'], ':nom' => $_POST['nom'], ':adresse' => $_POST['adresse'], ':telephone' => $_POST['telephone'], ':actif'=> $_POST['actif'], ':id' => $_POST['id']));
											if($sql)
												{
													echo 'L\'utilisateur a bien été modifié';
													exit(header("Refresh: 2;URL=membre.php"));
												}


											else echo "l'utilisateur n'a pas été modifier";
										}
									}
							}
						}
						if (isset($_GET['action']) AND $_GET['action'] == "ajouter")
						{?>
							<div class="col-lg-4" style="margin : 0 auto;">
							</div>
							<div class="col-lg-4" style="margin : 0 auto;">
							<form action ="membre.php?action=ajouter" method="POST">
						  <div class="form-group has-feedback">
							<label for="InputUsername">Nom d'utilisateur</label>
							<input type="text" class="form-control champs" id="InputUsername" placeholder="Nom d'utilisateur" name="username">
							<i class="glyphicon glyphicon-user form-control-feedback"></i>
						  </div>
						  <div class="form-group">
							<label for="InputPassword1">Mot de passe</label>
							<input type="password" class="form-control champs" id="InputPassword" placeholder="Mot de passe" name="password">
						  </div>
						  <div class="form-group">
							<label for="InputPassword1">Mot de passe confirmation</label>
							<input type="password" class="form-control champs" id="InputPasswordRetry" placeholder="Mot de passe" name="passwordRetry">
						  </div>
				

						  <div class="form-group">
							<label for="InputEmail">Email</label><i> Merci de sélectionner dans la liste votre ville</i>
							<input type="email" class="form-control champs" id="InputEmail" placeholder="Email" name="email">
						  </div>

						  <div class="radio">
							  <label>
								<input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>
								Monsieur
							  </label>
							
							  <label>
								<input type="radio" name="optionsRadios" id="optionsRadios2" value="0">
								Madame
							  </label>
							</div>
							 <div class="form-group">
							<label for="InputVille">Ville</label>
							<input type="text" class="form-control champs" id="InputVille" placeholder="Votre ville" name="city">
						  </div>
						  <div class="form-group">
							<label for="InputPrenom">Prénom</label>
							<input type="text" class="form-control champs" id="InputPrenom" placeholder="Votre Prénom" name="prenom">
						  </div>
						  <div class="form-group">
							<label for="InputNom">Nom</label>
							<input type="text" class="form-control champs" id="InputNom" placeholder="Votre nom" name="nom">
						  </div>
						   <div class="form-group">
							<label for="InputAdresse">Adresse de livraison</label>
							<input type="text" class="form-control champs" id="InputAdresse" placeholder="Votre adresse" name="address">
						  </div>
						  <div class="form-group">
							<label for="InputNumero">Numéro de téléphone</label>
							<input type="text" class="form-control champs" id="InputNumero" placeholder="0787575263" name="numero">
						  </div>
						  <input type="submit" class="btn btn-default" value="Ajouter le membre" >
						</form>
						</div>
						<?php
						if (isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['email']) AND isset($_POST['optionsRadios']) AND isset($_POST['city']) AND isset($_POST['address']) AND isset($_POST['numero']) AND isset($_POST['prenom']) AND isset($_POST['nom']))
							{
								if ($_POST['username'] AND $_POST['password'] AND $_POST['email'] AND $_POST['optionsRadios'] AND $_POST['city'] AND $_POST['address'] AND $_POST['numero'] != null)
								{
									$username = stripslashes($_POST['username']);
									$sql = $bdd->prepare("SELECT pseudo FROM utilisateur WHERE pseudo = :pseudo");
									$sql->execute(array(':pseudo' => $username));
									$membreExist = $sql->fetch(PDO::FETCH_OBJ);
									if ($membreExist == false)
									{
									$password = stripslashes(hashagePwd($_POST['password']));
									$passwordRetry = stripslashes(hashagePwd($_POST['passwordRetry']));

									if ($password == $passwordRetry)
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
												
															$optionsRadios = stripslashes($_POST['optionsRadios']);
															$adresse = stripslashes($_POST['address']);
															$email = stripslashes($_POST['email']);
															$sql =$bdd->prepare("INSERT INTO utilisateur (villes_idvilles, pseudo, password, email, prenom, nom, genre, adresse, telephone) VALUES (:villes_idvilles, :pseudo, :password, :email, :prenom, :nom, :genre, :adresse, :telephone)");
															$sql->execute(array(":villes_idvilles" => $resultat['idvilles'], ":pseudo" => $username,":password" => $password, ":email"=> $email, ":prenom" => $_POST['prenom'], ":nom" => $_POST['nom']	,":genre"=> $optionsRadios, ":adresse"=> $adresse, ":telephone" => $numero));
															if ($sql) 
															{
																$erreur = array("message"=>"Votre compte à bien été créer. Vous pouvez à présent vous connectez avec celui-ci !","type"=>1);
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
										$erreur = array("message"=>"Votre mot de passe et mot de passe confirmé ne correspondent pas",
										"type"=>0);
									}
									}
									else
									{
										$erreur = array("message"=>"Un compte utilisateur avec votre pseudo existe déjà, Si c'est le votre vous pouvez vous <a href='login.php' alt='Se connecter'>connecter avec</a>",
									"type"=>0);
									}

								}
								else
								{
									$erreur = array("message"=>"Merci de remplir les champs afin de vous s'inscrire",
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
						elseif (isset($_GET['suppression']))
						{
							$sql = "DELETE FROM utilisateur WHERE idutilisateurs = :id";
							$stmt = $bdd->prepare($sql);
							$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);   
							$stmt->execute();
							if ($stmt)
							{
								echo "L'utilisateur à bien été supprimer";
									header('Status: 301 Moved Permanently', false, 301);
									exit(header("Refresh: 2;URL=membre.php"));
							}
						}
					?>
					
				</div>
			</div>
	<div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
	        <div class=".col-xs-12 .col-sm-6 .col-lg-8">
				<div class="col-lg-4">
				  <img src="../img/side/paypal.png" height="120px"/>
				
			   </div>
				<div class="col-lg-4 liste-tiret">
				  <img src="../img/side/livraison.jpg" height="150px" class="image-left" />
				  Nous vous promettons : 
				  <ul>
				  <li>Livraison sous 48h</li>
				  <li>Colis surprotégé</li>
				  <li>Satisfait ou remboursé</li>
				  <li> Catalogue de nouveautés</li>
				  </ul>
					
			   </div>
				<div class="col-lg-4">
				  <img src="../img/side/support.jpg" height="150px" class="image-left"/>
				  En cas de problèmes, nous restons accessible via : 
				  <ul>
				  <li><a href="../contact.php" alt="Page contact"> La page contact</a></li>
				  <li><a href="#" alt="Numéro de téléphone">Notre Call Center au 024/542.36.56</a></li>
				  <li><a href="skype:Support.Bonsai-Store?userinfo" alt="Support skype de Bonsaï-Store">Notre skype : Support.Bonsai-Store</a></li>
				  </ul>
				</div>
			</div>
	      </div>

	      <!-- Site footer -->
	    <footer class="footer" style="border : 2px solid #c1c1c1;">
			<div class=".col-xs-12 .col-sm-6 .col-lg-8">
				<div class="col-lg-6">
				<p>Copyright© Perret Yannick - Bonsaï-Store - 2016 - CPNV</p>
				</div>
				<div class="col-lg-2">
				<p>&nbsp;</p>
				</div>
				<div class="col-lg-4 text-right">
					<ul style="list-style-type: none;">
						<li><a href="../legal.php" alt="Mention légale">Mention légale</a></li>
						<li><a href="../contact.php" alt="Page de contact"> Contact</a></li>
					</ul>
				</div>
			</div>
	    </footer>

	    </div> <!-- /container -->


	    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	    <script src="../js/ie10-viewport-bug-workaround.js"></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="../js/bootstrap.min.js"></script>
	    <script src="../js/jquery.autocomplete.min.js"></script>
	    <script src="../js/function.js"></script>

	</body>

	  </body>
	</html>
	<?php
}
else
{
	exit(header("location:../index.php"));
}	?>