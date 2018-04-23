<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); // mémorise toute la sortie HTML qui suit  ?>

<?php
while ($data = $posts->fetch())
{
    ?>

    <div class="row" id="post-content">
        <div class="col-lg-12">
            <h3><i class="fa fa-bookmark"></i>
                <?= htmlspecialchars($data['title']) ?>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($data['content'])) ?>
            </p>
            <div class="row">
                <div class="col-lg-6">
                    Par <strong><?= $data['author'] ?></strong> <em>le <?= $data['creation_date_fr'] ?></em>
                </div>
                <div class="col-lg-offset-4 col-lg-2">
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-primary">Commentaires &raquo;</a>
                </div>
            </div>
        </div>
    </div>

    <?php
}
$posts->closeCursor();
?>
    <!-- Pager -->
    <div class="row" id="older-posts-btn-section">
        <div class="col-lg-offset-5 col-lg-2">
            <a class="btn btn-default" href="#">Plus anciens &rarr;</a>
        </div>
    </div>

<?php $content = ob_get_clean(); // récupère le contenu généré avec cette fonction et on met le tout dans $content ?>
<?php require('template.php'); ?>