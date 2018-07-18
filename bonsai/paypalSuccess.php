<?php
require ('header.php');?>
<div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
        <div class=".col-xs-12 .col-sm-6 .col-lg-8">
            <h1> Confirmation de commande </h1>
            <div class="col-lg-12">
           <?php
           if (isset($_SESSION['panier']))
           {
                echo 'La commande : '.$_GET['PayerID']. ' a bien été effectuer. Un mail contenant le contenu de votre commande, vous a été envoyé';
                $sql = $bdd->prepare("SELECT email, nom, prenom FROM utilisateur WHERE pseudo = :username");
                $sql->execute(array(':username' => $_SESSION['username']));
                $total_panier = 0;
                while ($resultat = $sql->fetch())
                {
                    $dest=$resultat['email']; // Mail obtenu via une requête sql
                    $objet="Confirmation de commande ".strip_tags($_GET['PayerID']);
                    $message = '<html><body>';
                    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                    $message .= "<tr style='background: #eee;'><td><strong>Commande du store Bonsai-Store n</strong> </td><td>" . strip_tags($_GET['PayerID']) . "</td></tr>";
                    $message .= "<tr><td><strong>Nom:</strong> </td><td>" . strip_tags($resultat['nom']) . "</td></tr>";   
                    $message .= "<tr><td><strong>Prenom:</strong> </td><td>" . strip_tags($resultat['prenom']) . "</td></tr>";   
                    $message .= "<tr><td><strong>Pseudo:</strong> </td><td>" . strip_tags($_SESSION['username']) . "</td></tr>";     
                    foreach($_SESSION['panier'] as $id_article=>$article_acheté){
                    $message .= "<tr><td><strong>Nom de l'article:</strong> </td><td>" . strip_tags($article_acheté['nom']) . "</td><td><strong>Prix</strong> </td><td>" . strip_tags($article_acheté['prix']) . "</td><td><strong>Quantite</strong> </td><td>" . strip_tags($article_acheté['qte']) . "</td></tr>";
                    //$message.= "\n"."Nom de l'article : " . $article_acheté['nom']. "\t". "Prix : " .$article_acheté['prix'] . "\t" ."Quantite : ". $article_acheté['qte'];
                    }
                    foreach($_SESSION['panier'] as $id_article=>$article_acheté){
                        $total_panier += $article_acheté['prix'] * $article_acheté['qte'];
                    }
                    $message .= "<tr><td><strong>Prix total:</strong> </td><td>".number_format($total_panier, 2, ',', ' ')." CHF</td></tr>";  
                    //$message.= "\n" . "Prix total : " . number_format($total_panier, 2, ',', ' ').' CHF</p>';
                    $message .= '</body></html>';

                    $entetes="From: noreply@bonsaistore.com"."\n";
                    $entetes.="Content-Type: text/html; charset=iso-8859-1";

                    // Ajouter la commande dans la bdd
                    $prixfinal = $total_panier;
                    $commande = $bdd->prepare("INSERT INTO commande(utilisateurs_idutilisateurs, dateCommande, prixCommande, idPaypal) VALUES (:idUtilisateurs, :dateCommande, :prixCommande, :idPaypal)");
                                                $commande->execute(array(':idUtilisateurs'=> $_SESSION['idUtilisateur'],':dateCommande'=> date("Y-m-d"), ':prixCommande'=> $prixfinal, ':idPaypal' => $_GET['PayerID']));
                                                $lastIdCommande = $bdd->lastInsertId();

                    foreach($_SESSION['panier'] as $id_article=>$article_acheté)
                        {
                            $detailCommande = $bdd->prepare("INSERT INTO detailCommande(commandes_idcommandes, produits_idproduits, quantite) VALUES (:idcommande, :idproduits, :quantite)");
                            $detailCommande->execute(array(':idcommande'=> $lastIdCommande, ':idproduits'=> $id_article, ':quantite'=>$article_acheté['qte'], ));
                        } 

                    if(mail($dest,$objet,$message,$entetes))
                    {
                        $erreur = array("message" => 'La commande : '.$_GET['PayerID']. ' a bien été effectuer. Un mail contenant le contenu de votre commande, vous a été envoyé',
                            "type"=>1);
                           unset($_SESSION['panier']);
                    }
                    else
                        $erreur = array("message" => "Une erreur a été constaté sur l'envoie d'email. Si le problème persiste, merci de contacter le support téléphonique",
                            "type"=>0);
                    exit;
                }
            }
            else
            {
                $erreur = array("message" => "Votre panier est vide, il est impossible de faire la transaction. Merci d'ajouter des articles à votre panier",
                            "type"=>0);
                    exit;

                }
                 echo $erreur;
                ?>
            </div>

        </div>
    </div>
<?php require('footer.php');?>

