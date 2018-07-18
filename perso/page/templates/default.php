<!DOCTYPE html>
<html lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Portfolio - Perret "Tchoune" Yannick</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php?p=home" class="brand-logo">Perret Yannick</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="public/index.php?p=home">Accueil</a></li>
        <li><a href="public/index.php?p=skills">Compétences</a></li>
        <li><a href="public/index.php?p=portfolio">Portfolio</a></li>
        <li><a href="index.php?p=CV">CV</a></li>
        <li><a href="blog/index.php">Blog</a></li>
        <li><a href="index.php?p=contact">Contact</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav" style="left: -250px;">
       <a href="index.php" data-activates="nav-mobile" class="button-collapse"><i class="material-icons tiny">keyboard_arrow_right</i></a><li><a href="index.php">Accueil</a></li>
       <a href="skills.php" data-activates="nav-mobile" class="button-collapse"><i class="material-icons tiny">keyboard_arrow_right</i></a><li><a href="skills.php">Compétences</a></li>
       <a href="portfolio.php" data-activates="nav-mobile" class="button-collapse"><i class="material-icons tiny">keyboard_arrow_right</i></a><li><a href="portfolio.php">Portfolio</a></li>
       <a href="CV.pdf" data-activates="nav-mobile" class="button-collapse"><i class="material-icons tiny">keyboard_arrow_right</i></a><li><a href="CV.pdf">CV</a></li>
       <a href="blog/index.php" data-activates="nav-mobile" class="button-collapse"><i class="material-icons tiny">keyboard_arrow_right</i></a><li><a href="blog/index.php">Blog</a></li>
       <a href="contact.php" data-activates="nav-mobile" class="button-collapse"><i class="material-icons tiny">keyboard_arrow_right</i></a><li><a href="contact.php">Contact</a></li>
      </ul>
      <a href="" data-activates="nav-mobile" class="button-collapse">
		<i class="material-icons">menu</i></a>
    </div>
  </nav>
  <?= $content;?>
  
  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h5 class="header col s12 light">J'adorerais changer le monde, mais ils ne veulent pas me fournir le code source.</h5>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="../img/index-footer.jpg" alt="Unsplashed background img 3" style="display: block; transform: translate3d(-50%, 252px, 0px);"></div>
  </div>

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Mes derniers Tweets</h5>
         <a class="twitter-timeline" href="https://twitter.com/TchouneTV" data-widget-id="646962426655719424">Tweets de @TchouneTV</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
		
        <div class="col l3 s12">
          <h5 class="white-text">Autres</h5>
          <ul>
           <li><a class="grey-text text-lighten-3" href="sitemap.xml">Sitemap</a></li>
                  <li><a class="grey-text text-lighten-3" href="flux.rss">Flux Rss</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Contact</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Administration</a></li>
          </ul>
        </div>
		
		<div class="col l3 s12">
          <h5 class="white-text">Réseau sociaux</h5>
          <ul>
				  <li><a class="grey-text text-lighten-3" href="#!">Facebook</a></li>
                  <li><a class="grey-text text-lighten-3" href="https://twitter.com/TchouneTV">Twitter</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Skype</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Google +</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">OpenClassRoom</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
          </ul>
        </div>
		
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>  <p class="grey-text text-lighten-4 right">Copyright 2015 Perret Yannick</p>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.js"></script>
  <script src="../js/init.js"></script>

  </body>
</html>