<?php
 if(isset($_GET['p'])){
	 $p = $_GET['p'];
 } else{
	 $p = 'home';
 }
 
 ob_start();
 if($p === 'home'){
	 require '../page/index.php';
 }
 else if($p === 'skills'){
	 require '../page/skills.php';
 }
 else if($p === 'portfolio'){
	 require '../page/portfolio.php';
 }
 else if($p === 'cv'){
	 require '../page/cv.php';
 }
 else if($p === 'contact'){
	 require '../page/contact.php';
 }
$content = ob_get_clean();
require '../page/templates/default.php';
?>