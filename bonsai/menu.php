<body>

<div class="container">
  <!-- The justified navigation menu is meant for single line per list item.
       Multiple lines will require custom code not provided by Bootstrap. -->
  <div class="masthead">
    <h3 class="text-muted"><img src="./img/Logobonsai-store.png" height="120px"></h3>
    <nav>
      <ul class="nav nav-justified">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="produit.php">Produit</a></li>

        <?php
        if (isset ($_SESSION['username']))
        {
          if (isset($_SESSION['role']) AND $_SESSION['role'] == 2)
          {
            echo '<li><a href="admin/produit.php" alt="Administration des produits">Admin produit</a></li>';
            echo '<li><a href="admin/membre.php" alt="Administration des membres">Admin Membre</a></li>';
          }
          if(isset($_SESSION['panier']) AND !empty($_SESSION['panier']))
            echo '<li><a href="panier.php" alt="Panier utilisateur">Panier</a></li>';
          echo '<li><a href="logout.php" alt="Déconnexion du site">Déconnexion</a></li>';

        }
        else
        {
          echo' <li><a href="inscription.php">Inscription</a></li>
              <li><a href="login.php">Connexion</a></li>';
        }
        ?>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
  </div>
