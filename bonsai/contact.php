<?php require ('header.php');?>
	<!-- Carousel-->

	<!--carousel-->
	<ol class="breadcrumb">
		<li><a href="./index.php">Accueil</a></li>
		<li class="active">Contact</li>
	</ol>
	<!-- Example row of columns -->
	<div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2732.1698791802996!2d6.638197715829203!3d46.78125685261725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478dcf8465ed7f33%3A0xe582171f762c21d4!2sYverdon-les-Bains%2C+gare!5e0!3m2!1sfr!2sch!4v1462880194005" width="1165" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
		<div class=".col-xs-12 .col-sm-6 .col-lg-8">
			<h1> Contactez-nous </h1>
			<div class="col-lg-8">
				<form class="form-horizontal" role="form" method="POST" action="contact.php" enctype="text/HTML">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Nom d'utilisateur</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="Votre nom d'utilisateur" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Adresse Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="message"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="human" name="human" placeholder="Votre réponse">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Envoyer" class="btn btn-primary">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<!-- Alerte du formulaire -->
						</div>
					</div>
				</form>
			</div>

			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3> Informations</h3>
						<p>Voici d'autres moyens de nous contacter</p>
						<ul style="list-style-type: none;">
							<li><img src="img/contact/twitter.gif" alt="Twitter" /><a href="https://twitter.com/sup.Bonsai" alt="Twitter du support de Bonsaï-store">@Sup.Bonsai</a></li>
							<li><img src="img/contact/facebook.gif" alt="facebook" /><a href="https://facebook.com/Support.Bonsai-store" alt="facebook du support de Bonsaï-store">/Support.Bonsai-store</a></li>
							<li><img src="img/contact/skype.gif" alt="skype" /><a href="skype:Support.Bonsai-Store?userinfo" alt="skype du support de Bonsaï-store">Support.Bonsai-store</a></li>
							<li><img src="img/contact/call.png" alt="Call center" /><a href="#" alt="Call Center du support de Bonsaï-store">024 / 542 . 36 . 56</a></li>
						</ul>
					</div>
				</div>
			</div>
			<?php
			if (isset ($_POST['name']) AND isset($_POST['email']) AND isset($_POST['message']) AND isset($_POST['human']))
			{
				if($_POST['human'] == 5)
				{
					extract($_POST);
					$dest="yannick.perret@cpnv.ch";
					$objet="Demande de contact";
					$message= "Nom/Pseudo : ".$name. "\n" . "Message : \n" .$message;
					$entetes="From: ".$email."\n";
					$entetes.="Content-Type: text/html; charset=iso-8859-1";

					if(mail($dest,$objet,$message,$entetes))
						$erreur = array("message" => "Votre email a bien été envoyer. Nous traiterons votre email dans maximum 24heures",
							"type"=>1);
					else
						$erreur = array("message" => "Une erreur a été constaté sur l'envoie d'email. Si le problème persiste, merci de contacter le support téléphonique",
							"type"=>0);
					exit;
				}
				else
				{
					$erreur = array("message" => "Le code de vérification du fomulaire est erroné, merci de réessayer",
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
							exit(header("Refresh: 5;URL=index.php"));?>
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