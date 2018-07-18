<?php
use App\Table\Article;
use App\Table\Categorie;
use App\App;

$categorie = \App\Table\Categorie::find($_GET['id']);
if($categorie === false)
{
    App::notFound();
}

$articles = \App\Table\Article::lastByCategory($_GET['id']);

$categories = \App\Table\Categorie::all();

?>
<h1><?= $categorie->titre?></h1>
<div class="row">
    <div class="col-sm-8">
        <ul>
            <?php foreach( $articles as $post): ?>



                <h1><a href="<?= $post->url ?>"><?= $post->titre; ?></a></h1>

                <p><em><?= $post->categorie?></em></p>

                <p><?= $post->extrait; ?></p>




            <?php endforeach; ?>
        </ul>

    </div>
    <div class="col-sm-4">
        <ul>
            <?php foreach(\App\Table\Categorie::all() as $categorie): ?>
                <li><a href="<?= $categorie->url; ?>"><?= $categorie->titre; ?></a></li>

            <?php endforeach;?>
        </ul>
    </div>

</div>
