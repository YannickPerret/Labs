<?php
require ('header.php');?>
<div class="row" style="border:solid #c1c1c1 2px; margin-top : 10px;">
        <div class=".col-xs-12 .col-sm-6 .col-lg-8">
            <h1> Annulation de commande </h1>
            <div class="col-lg-12">

           <?php
           if (isset($_SESSION['panier']))
           {
                echo 'Votre commande n\'a malheureusement pas pu être effectué, merci de réessayer. Si le problème persiste, vous pouvez envoyer prendre contact avec le support';
                unset($_SESSION['panier']);

            }
            else
            {
                echo 'Votre panier est vide, il est impossible de faire la transaction. Merci d\'ajouter des articles à votre panier';

                }
             
                ?>
            </div>

        </div>
    </div>
<?php require('footer.php');?>

