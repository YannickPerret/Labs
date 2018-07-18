<?php
session_start();
ob_start();
if (isset($_SESSION['role']) AND $_SESSION['role'] == 2)
{
define('TARGET', '../img/produit/produit/');    // Repertoire cible
define('MAX_SIZE', 100000);    // Taille max en octets du fichier
define('WIDTH_MAX', 200);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 200);    // Hauteur max de l'image en pixels

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
			<h1> Administration des produits </h1>
			<form action="produit.php?action=ajouter" method="POST" class="text-right">
			<input type="submit" value="Ajouter un produit" />
			</form>
			<table style="margin-left:3%;">
			   <caption>Listes des membres du site</caption>

			   <thead> <!-- En-tête du tableau -->
			       <tr>
			           <th>id</th>
			           <th>Image du produit</th>
			           <th>Nom du produit</th>
			           <th>Description</th>
			           <th>Age</th>
			           <th>Prix unitaire</th>
			           <th>Nombre de produits</th>
			            <th>Modification</th>
			           <th>Suppression</th>

			       </tr>
			   </thead>

			   <tfoot> <!-- Pied de tableau -->
			       <tr>
			           <th>id</th>
			           <th>Image du produit</th>
			           <th>Nom du produit</th>
			           <th>Description</th>
			           <th>Age</th>
			           <th>Prix unitaire</th>
			           <th>Nombre de produits</th>
			            <th>Modification</th>
			           <th>Suppression</th>
			       </tr>
			   </tfoot>

			   <tbody> <!-- Corps du tableau -->
				<?php
					$sql = $bdd->prepare("SELECT * FROM produit");
					$sql->execute();

					while($membre = $sql->fetch())
					 {
						echo '<tr>
				           <td>'.$membre['idproduits'].'</td>
				           <td><img src="../img/produit/produit/'.$membre['imageProduit'].'" height="80"></td>
				           <td>'.$membre['nomProduit'].'</td>
				           <td>'.substr($membre['description'], 0, 50).'...</td>
				           <td>'.$membre['age'].'</td>
				           <td>'.$membre['prixUnit'].'</td>
				           <td>'.$membre['nbProduit'].'</td>
				           <td><a href="produit.php?action=modification&id='.$membre['idproduits'].'"><img src="../img/membre/modification.png" height="30" /></a></td>
				           <td><a href="produit.php?suppression&id='.$membre['idproduits'].'"><img src="../img/membre/supprimer.png" height="30"/></a></td>
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
							echo '<h1>Modification</h1>';
							$sql = $bdd->prepare("SELECT * FROM produit WHERE idproduits = :id");
							$sql->execute(array(':id'=>$_GET['id']));
							?>
							<form action="produit.php?action=modification&valid=1&id=<?=$_GET['id'];?>" method="POST" enctype="multipart/form-data">
							<?php
							while($membre = $sql->fetch())
							{
								?>
								<input type="hidden" name="id" value="<?=$membre['idproduits'];?>">
								<label>Nom du produit </label><input type="text" name="nomProduit" Value="<?=$membre['nomProduit'];?>"><br>
								<label>Description du produit</label><textarea name="description"><?=$membre['description'];?></textarea><br>
								<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
            					<label>Image produit</label><input name="fichier" type="file" id="fichier_a_uploader" />
								<label>Age</label><input type="text" name="age" Value="<?=$membre['age'];?>"><br>
								<label>Prix unitaire</label><input type="text" name="prixUnit" Value="<?=$membre['prixUnit'];?>"><br>
								<label>Nombre de produit</label><input type="text" name="nbProduit" Value="<?=$membre['nbProduit'];?>"><br>
								<?php
							}
								?>
								<input type="submit" value="Modifier">
								</form>
								<?php
								if (isset($_GET['valid']))
								{
									// Tableaux de donnees
									$tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
									$infosImg = array();
									 
									// Variables
									$extension = '';
									$message = '';
									$nomImage = '';
									// On verifie si le champ est rempli
									  if( !empty($_FILES['fichier']['name']) )
									  {
									    // Recuperation de l'extension du fichier
									    $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
									 
									    // On verifie l'extension du fichier
									    if(in_array(strtolower($extension),$tabExt))
									    {
									      // On recupere les dimensions du fichier
									      $infosImg = getimagesize($_FILES['fichier']['tmp_name']);
									 
									      // On verifie le type de l'image
									      if($infosImg[2] >= 1 && $infosImg[2] <= 14)
									      {
									        // On verifie les dimensions et taille de l'image
									        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE))
									        {
									          // Parcours du tableau d'erreurs
									          if(isset($_FILES['fichier']['error']) 
									            && UPLOAD_ERR_OK === $_FILES['fichier']['error'])
									          {
									            // On renomme le fichier
									            $nomImage = md5(uniqid()) .'.'. $extension;
									 
									            // Si c'est OK, on teste l'upload
									            if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage))
									            {
									            	var_dump($nomImage);
													$sql = $bdd->prepare("UPDATE produit SET nomProduit = :nomProduit, description = :description, imageProduit = :image, age = :age, prixUnit = :prixUnit, nbProduit = :nbProduit WHERE idproduits = :id");
													$sql->execute(array(':nomProduit' => $_POST['nomProduit'], ':description' => $_POST['description'], ':image'=>$nomImage, ':age' => $_POST['age'], ':prixUnit' => $_POST['prixUnit'], ':nbProduit' => $_POST['nbProduit'],':id'=>$_POST['id']));
													if($sql)echo 'Le produit a bien été modifié';else echo "Le produit n'a pas été modifier";
									            }
									            else
									            {
									              // Sinon on affiche une erreur systeme
									              $message = 'Problème lors de l\'upload !';
									            }
									          }
									          else
									          {
									            $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
									          }
									        }
									        else
									        {
									          // Sinon erreur sur les dimensions et taille de l'image
									          $message = 'Erreur dans les dimensions de l\'image !';
									        }
									      }
									      else
									      {
									        // Sinon erreur sur le type de l'image
									        $message = 'Le fichier à uploader n\'est pas une image !';
									      }
									    }
									    else
									    {
									      // Sinon on affiche une erreur pour l'extension
									      $message = 'L\'extension du fichier est incorrecte !';
									    }
									}
									else
									{
										$sql = $bdd->prepare("UPDATE produit SET nomProduit = :nomProduit, description = :description, age = :age, prixUnit = :prixUnit, nbProduit = :nbProduit WHERE idproduits = :id");
													$sql->execute(array(':nomProduit' => $_POST['nomProduit'], ':description' => $_POST['description'], ':age' => $_POST['age'], ':prixUnit' => $_POST['prixUnit'], ':nbProduit' => $_POST['nbProduit'],':id'=>$_POST['id']));
													if($sql)echo 'Le produit a bien été modifié';else echo "Le produit n'a pas été modifier";
									}
								}
						}
					}
					if (isset($_GET['action']) AND $_GET['action'] == "ajouter")
					{?>
						<div class="col-lg-4" style="margin : 0 auto;">

						</div>

						<div class="col-lg-4" style="margin : 0 auto;">
							<form action ="produit.php?action=ajouter" method="POST" enctype="multipart/form-data">
							 	<div class="form-group has-feedback">
									<label for="InputNomProduit">Nom du produit</label>
									<input type="text" class="form-control" id="InputNomProduit" placeholder="Nom du produit" name="nomProduit">
									<i class="glyphicon glyphicon-user form-control-feedback"></i>
							  	</div>
							  	<div class="form-group">
									<label for="message" class="col-sm-2 control-label">Description</label><br>
									<div class="col-sm-10">
										<textarea class="form-control" rows="4" name="message"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="InputAge">Age</label>
									<input type="text" class="form-control" id="InputAge" placeholder="5" name="age">
							  	</div>
							  	<div class="form-group">
								  	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
	            					<label>Image produit</label><input name="fichier" type="file" id="fichier_a_uploader" />
            					</div>
							  	<div class="form-group">
									<label for="InputprixUnit">Prix unitaire</label>
									<input type="text" class="form-control" id="InputprixUnit" placeholder="128" name="prixUnit">
							  	</div>
								<div class="form-group">
									<label for="InputStock">Nombre de produit en stock</label>
									<input type="text" class="form-control" id="InputStock" placeholder="80" name="stock">
							  	</div>
							  	<div class="form-group">
									<label for="InputStock">Type de bonsai</label>
									<SELECT name="type" size="1">
									<?php 
									$sql = $bdd->prepare("SELECT * FROM type");
									$sql->execute();
									while ($type = $sql->fetch())
									{
							  	

										echo '<OPTION value="'.$type['idtype'].'"> '.$type['nomType'];
									}
									?>
								</SELECT>
								</div>
							  	<input type="submit" class="btn btn-default" value="Ajouter produit" >
							</form>
						</div>
					<?php
					if (isset($_POST['nomProduit']) AND isset($_POST['message']) AND isset($_POST['age']) AND isset($_POST['prixUnit']) AND isset($_POST['stock']) AND isset($_POST['type']))
						{
							var_dump($_POST);
							if (!empty($_POST['nomProduit'] AND $_POST['message'] AND $_POST['age'] AND $_POST['prixUnit'] AND $_POST['stock']))
							{			
							echo "0";										
										// Tableaux de donnees
									$tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
									$infosImg = array();
									 
									// Variables
									$extension = '';
									$message = '';
									$nomImage = '';
									// On verifie si le champ est rempli
									  if( !empty($_FILES['fichier']['name']) )
									  {
									    // Recuperation de l'extension du fichier
									    $extension  = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
									 
									    // On verifie l'extension du fichier
									    if(in_array(strtolower($extension),$tabExt))
									    {
									      // On recupere les dimensions du fichier
									      $infosImg = getimagesize($_FILES['fichier']['tmp_name']);
									 
									      // On verifie le type de l'image
									      if($infosImg[2] >= 1 && $infosImg[2] <= 14)
									      {
									        // On verifie les dimensions et taille de l'image
									        if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE))
									        {
									          // Parcours du tableau d'erreurs
									          if(isset($_FILES['fichier']['error']) 
									            && UPLOAD_ERR_OK === $_FILES['fichier']['error'])
									          {
									            // On renomme le fichier
									            $nomImage = md5(uniqid()) .'.'. $extension;
									 
									            // Si c'est OK, on teste l'upload
									            if(move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET.$nomImage))
									            {
									            	
													$sql =$bdd->prepare("INSERT INTO produit (type_idtype, nomProduit, description , imageProduit, age, prixUnit, nbProduit) VALUES (:idType, :nomProduit, :description, :imageProduit, :age,  :prixUnit, :nbProduit)");
													$sql->execute(array(":idType"=> $_POST['type'], ":nomProduit" => $_POST['nomProduit'], ":description" => $_POST['message'],":imageProduit" => $nomImage, ":age"=> $_POST['age'], ":prixUnit" => $_POST['prixUnit'], ":nbProduit" => $_POST['stock']));
													if ($sql) 
														$erreur = array("message"=>"Le produit a bien été créer dans la base de donnée !","type"=>1);
													else
														$erreur = array("message"=>"Le produit existe déjà","type"=>0);

									            }
									            else
									            {
									              // Sinon on affiche une erreur systeme
									              $message = 'Problème lors de l\'upload !';
									            }
									          }
									          else
									          {
									            $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
									          }
									        }
									        else
									        {
									          // Sinon erreur sur les dimensions et taille de l'image
									          $message = 'Erreur dans les dimensions de l\'image !';
									        }
									      }
									      else
									      {
									        // Sinon erreur sur le type de l'image
									        $message = 'Le fichier à uploader n\'est pas une image !';
									      }
									    }
									    else
									    {
									      // Sinon on affiche une erreur pour l'extension
									      $message = 'L\'extension du fichier est incorrecte !';
									    }
									}
										
							}
							else
							{
								$erreur = array("message"=>"Merci de remplir les champs afin d'ajouter un produit",
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
						$sql = "DELETE FROM produit WHERE idproduits = :id";
						$stmt = $bdd->prepare($sql);
						$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);   
						$stmt->execute();
						if ($stmt)
						{
							echo "Le produit à bien été supprimer";
								header('Status: 301 Moved Permanently', false, 301);
								exit(header("Refresh: 2;URL=produit.php"));
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
			  <li>Catalogue de nouveautés</li>
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