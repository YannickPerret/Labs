<div class="row">
    <div class="col-sm-8">
        <ul>
            <?php foreach( \App\Table\Article::getLast() as $post): ?>

                <?php var_dump($post); ?>

                <h1><a href="<?= $post->getURL() ?>"><?= $post->titre; ?></a></h1>

                <p><em><?= $post->categorie?></em></p>

                <p><?= $post->getExtrait(); ?></p>




            <?php endforeach; ?>
        </ul>

    </div>
    <div class="col-sm-4">
    <?php foreach(\App\Table\Categorie::all() as $categorie): ?>
        <li><a href="<?= $categorie->url; ?>"><?= $categorie->titre; ?></a></li>

        <?php endforeach;?>

    </div>

</div>