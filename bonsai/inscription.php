<?php require ('header.php');?>
	<ol class="breadcrumb">
		<li><a href="./index.php">Accueil</a></li>
		<li class="active">Inscription</li>
	</ol>
	<!-- Example row of columns -->
	<div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
		<div class=".col-xs-12 .col-sm-6 .col-lg-8">
			<h1> Inscription </h1>
			<div class="col-lg-4" style="margin : 0 auto;">
				&nbsp;
			</div>
			<div class="col-lg-4" style="margin : 0 auto;">
				<?php if (!isset($_SESSION['username']))
				{?>
					<form action ="inscription.php#inscription" method="POST">
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

						<!-- Div servant à afficher un message d'erreur ou de réussite -->
						<div class="form-group">
							<div class="col-sm-12 alert alert-danger fade in text-center champs" id="erreur">
								<p> Les deux mots de passe ne correspondent pas</p>
							</div>
						</div>
						<br><br>

						<div class="form-group">
							<label for="InputEmail">Email</label>
							<input type="email" class="form-control champs" id="InputEmail" placeholder="Email" name="email">
						</div>

						<!-- Div servant à afficher un message d'erreur ou de réussite -->
						<div class="form-group">
							<div class="col-sm-12 alert alert-danger fade in text-center champs" id="erreurEmail">

							</div>
						</div>
						<br><br>

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
							<label for="InputVille">Ville</label><i> Merci de sélectionner dans la liste votre ville</i>
							<input type="text" class="form-control" id="InputVille" placeholder="Votre ville" name="city">
						</div>
						<div class="form-group">
							<label for="InputAdresse">Adresse de livraison</label>
							<input type="text" class="form-control champs" id="InputAdresse" placeholder="Votre adresse" name="address">
						</div>
						<div class="form-group">
							<label for="InputNumero">Numéro de téléphone</label>
							<input type="text" class="form-control champs" id="InputNumero" placeholder="0787575263" name="numero">
						</div>
						<input type="submit" class="btn btn-default" value="S'inscrire" > <a href="login.php" alt="Se connecter" class="text-right">Se connecter</a>
					</form>

				<?php }
				else
				{
					$erreur = array("message"=>"Vous êtes déjà connecté sur le site, merci de vous <a href='./logout.php' alt='Se déconnecter'> déconnecter</a> avant de vous connecter à un autre compte",
						"type"=>0);
				}?>
			</div>
			<div class="col-lg-4" style="margin : 0 auto;">
				&nbsp;
			</div>
			<?php
			if (isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['email']) AND isset($_POST['optionsRadios']) AND isset($_POST['city']) AND isset($_POST['address']) AND isset($_POST['numero']))
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

												$sql =$bdd->prepare("INSERT INTO utilisateur (villes_idvilles, pseudo, email, password, genre, adresse, telephone) VALUES (:villes_idvilles, :pseudo, :email, :password, :genre, :adresse, :telephone)");
												$sql->execute(array(":villes_idvilles" => $resultat['idvilles'], ":pseudo" => $username,":email" => $email,":password" => $password,":genre"=> $optionsRadios, ":adresse"=> $adresse, ":telephone" => $numero));
												if ($sql)
												{
													$erreur = array("message"=>"Votre compte a bien été créé. Vous pouvez à présent vous connectez avec celui-ci !","type"=>1);
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
						<div class="col-sm-6 col-sm-offset-3 alert alert-success fade in text-center" id="inscription">
							<?=$erreur['message'];?>
						</div>
					</div>
					<?php
				}
				else
				{

					?>
					<div class="form-group">
						<div class="col-sm-6 col-sm-offset-3 alert alert-danger fade in text-center" id="inscription">
							<?=$erreur['message'];?>
						</div>
					</div>
					<?php
				}
			}?>

		</div>
	</div>

<?php require('footer.php');?>