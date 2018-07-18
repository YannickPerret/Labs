<?php
require ('header.php');
?>
	<div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
		<div class=".col-xs-12 .col-sm-6 .col-lg-8">
		<h1> Déconnexion </h1>
<?php
if(!isset($_SESSION['username']))
{
	header('Location: ./login.php');
}
else
{
	session_destroy();
	echo ' Vous serez deconnecter dans 3 secondes. Merci de votre visite !';
	header('Status: 301 Moved Permanently', false, 301);
	header("Refresh: 3;URL=./index.php");
}
?>
	
		</div>
	</div>
	<script>
$( "div:visible" ).click(function() {
  $( this ).css( "background", "yellow" );
});
$( "button" ).click(function() {
  $( "div:hidden" ).show( "fast" );
});
</script>
<?php require('footer.php');?>