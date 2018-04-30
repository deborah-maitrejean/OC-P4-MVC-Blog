<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); // mémorise toute la sortie HTML qui suit  ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="<?= ASSETS ?>img/portrait-jean-forteroche.jpg" alt="Portrait noir et blanc de l'auteur Jean Forteroche." class="img-thumbnail img-responsive">
                    </div>
                    <div class="col-lg-6">
                        <h2>Jean Forteroche</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet mauris eget tortor tristique interdum. Morbi aliquam in turpis at congue. Aenean pulvinar,
                            eros eu efficitur iaculis, nunc sem tincidunt ante, dapibus sed libero... </p>
                        <a class="btn btn-lg btn-primary" href="index.php?action=about" role="button">Découvrir l'auteur &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h2>Derniers billets du blog</h2>
        </div>
    </div>

<?php foreach ($posts as $post): ?>

    <div class="row" id="post-excerpt">
        <div class="col-lg-12">
            <h3><i class="fa fa-bookmark"></i>&nbsp;&nbsp;<?= htmlspecialchars($post->getTitle()); ?></h3>
            <p><?= strip_tags($post->getPostExcerpt()); ?>...</p>

            <div class="row">
                <div class="col-xs-7 col-sm-8 col-md-6 col-lg-6">
                    <span>Par <strong><?= $post->getAuthor(); ?></strong></span>
                    <span>le<em> <?= $post->getCreationDateFr(); ?></em></span>
                </div>
                <div class="col-xs-5 col-sm-2 col-md-offset-3 col-md-3 col-lg-offset-4 col-lg-2">
                    <a href="index.php?action=post&amp;id=<?= $post->getId(); ?>" class="btn btn-primary read-more">Lire la suite &raquo;</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
<?php endforeach; ?>
    <!-- Pager -->
    <div class="row" id="older-posts-btn-section">
        <div class="col-lg-offset-5 col-lg-2">
            <a class="btn btn-default" href="#">Plus anciens &rarr;</a>
        </div>
    </div>

<?php $content = ob_get_clean(); // récupère le contenu généré avec cette fonction et on met le tout dans $content ?>
<?php require('template.php'); ?>