<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); // mémorise toute la sortie HTML qui suit  ?>

<?php foreach ($posts as $post): ?>

    <div class="row" id="post-content">
        <div class="col-lg-12">
            <h3><i class="fa fa-bookmark"></i>&nbsp;&nbsp;<?= htmlspecialchars($post->getTitle()); ?></h3>
            <hr>
            <p><?= strip_tags($post->getContent()); ?></p>
            <hr>
            <div class="row">
                <div class="col-xs-7 col-sm-8 col-md-6 col-lg-6">
                    <span>Par <strong><?= $post->getAuthor(); ?></strong></span>
                    <span>le<em> <?= $post->getCreationDate(); ?></em></span>
                </div>
                <div class="col-xs-5 col-sm-2 col-md-offset-3 col-md-3 col-lg-offset-4 col-lg-2">
                    <a href="index.php?action=post&amp;id=<?= $post->getId(); ?>" class="btn btn-primary">Commentaires &raquo;</a>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
    <!-- Pager -->
    <div class="row" id="older-posts-btn-section">
        <div class="col-lg-offset-5 col-lg-2">
            <a class="btn btn-default" href="#">Plus anciens &rarr;</a>
        </div>
    </div>

<?php $content = ob_get_clean(); // récupère le contenu généré avec cette fonction et on met le tout dans $content ?>
<?php require('template.php'); ?>