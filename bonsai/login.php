<?php require ('header.php');?>
	<ol class="breadcrumb">
		<li><a href="./index.php">Accueil</a></li>
		<li class="active">Connexion</li>
	</ol>
	<!-- Example row of columns -->
	<div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
		<div class=".col-xs-12 .col-sm-6 .col-lg-8">
			<h1> Connexion </h1>
			<div class="col-lg-4" style="margin : 0 auto;">
				&nbsp;
			</div>

			<div class="col-lg-4" style="margin : 0 auto;">
				<?php if (!isset($_SESSION['username']))
				{
				?>
				<form action="login.php" method="POST">
					<div class="form-group has-feedback">
						<label for="InputUsername">Nom d'utilisateur</label>
						<input type="text" class="form-control" id="InputUsername" placeholder="Nom d'utilisateur" name="username">
						<i class="glyphicon glyphicon-user form-control-feedback"></i>
					</div>
					<div class="form-group">
						<label for="InputPassword1">Mot de passe</label>
						<input type="password" class="form-control" id="InputPassword1" placeholder="Mot de passe" name="password">
					</div>
					<div class="g-recaptcha" data-sitekey="6LdQkR8TAAAAACoL8Wz4e08MMZUhTAtAr4j1O7L-"></div>
					<button type="submit" class="btn btn-default" >Se connecter</button>
					<a href="passwordoublie.php" alt="Mot de passe oublié">Mot de passe oublié</a>
				</form>

				<br>
				<br> <p> Vous n'avez pas de compte, <a href="inscription.php" alt="S'inscrire"> Cliquez ici pour en créer un </a>
			</div>
			<div class="col-lg-4" style="margin : 0 auto;">
				&nbsp;
			</div>
			<?php }
			else
			{
				$erreur = array("message"=>"Vous êtes déjà connecté sur le site, merci de vous <a href='./logout.php' alt='Se déconnecter'> déconnecter</a> avant de vous connecter à un autre compte",
					"type"=>0);
			}

			if (isset($_POST['username']) AND isset($_POST['password']))
			{
				if ($_POST['username'] AND $_POST['password'] != '')
				{
					$captcha = $_POST['g-recaptcha-response'];
					if(CaptchaisValid($captcha))
					{
						$username = stripslashes($_POST['username']);
						$password = stripslashes(hashagePwd($_POST['password']));
						$sql = $bdd->prepare('SELECT idutilisateurs, pseudo, password, roles_idroles from utilisateur WHERE pseudo = :pseudo');
						$sql->execute(array(':pseudo'=> $username));
						$row = $sql->fetch();
						if ($sql)
						{
							if ($password == $row['password'] && strtoupper($username) == strtoupper($row['pseudo']))
							{
								$erreur = array("message" => 'Connexion à votre compte réussi, bonjour ' . $username . '<br>Vous serez rediriger dans sur la page d\' acceuil dans 5 secondes',
									"type"=> 1);
								$_SESSION['idUtilisateur']=$row['idutilisateurs'];
								$_SESSION['username']=$username;
								$_SESSION['password']=$password;
								$_SESSION['role'] = $row['roles_idroles'];
								unset($_SESSION['erreur']);


							}
							else
							{
								$erreur = array("message" => "Votre identifiant ou mot de passe n'est pas valide. Merci de réessayer !",
									"type"=>0);

							}
						}
					}
					else
					{
						$erreur = array("message"=>"Captcha invalide",
							"type"=>0);
					}
				}
				else
				{
					$erreur = array("message"=>"Merci de remplir les champs afin de vous identifier",
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
							<?php
							header('Status: 301 Moved Permanently', false, 301);
							exit(header("Refresh: 3;URL=index.php"));?>
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
			}?>

		</div>
	</div>
<?php require('footer.php');?>