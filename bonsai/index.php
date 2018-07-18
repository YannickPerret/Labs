<?php require ('header.php');?>
	<ol class="breadcrumb">
		<li class="active">Accueil</li>
	</ol>
	<!-- Carousel-->
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-top :10px;">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<center><img src="./img/carousel/image1.jpg" alt="Bonsaï intérieur"></center>
				<div class="carousel-caption">
					Decouvrez nos différents bonsaï
				</div>
			</div>
			<div class="item">
				<center><img src="./img/carousel/image2.jpg" alt="Bonsaï intérieur"></center>
				<div class="carousel-caption">
					Decouvrez nos différents bonsaïs
				</div>
			</div>
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Précédent</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Suivant</span>
		</a>
	</div>
	<!--carousel-->
	<!-- Example row of columns -->
	<div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
		<div class=".col-xs-12 .col-sm-6 .col-lg-8">
			<h1> Nouveautés </h1>
			<?php
				$sql = $bdd->prepare("SELECT nomProduit, imageProduit, prixUnit FROM produit ORDER BY idproduits DESC LIMIT 4");
				$sql->execute();
				while($resultat = $sql->fetch())
				{
			?>
			<div class="col-lg-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<img src="./img/produit/produit/<?=$resultat['imageProduit'];?>" height="200" />
						<p><?=$resultat['nomProduit'];?></p>
					</div>
					<div class="panel-footer">
						<button type="button" class="btn btn-default" style="float:left;">
							<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
						</button>
						<p class="text-right">Prix: <?=$resultat['prixUnit'];?> CHF</p>
					</div>
				</div>
			</div>
			<?php
			}
			?>

			
		</div>
	</div>
<?php require('footer.php');?>