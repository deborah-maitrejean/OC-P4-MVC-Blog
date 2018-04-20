<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); // mémorise toute la sortie HTML qui suit  ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="public/img/portrait-jean-forteroche.jpg" alt="Portrait noir et blanc de l'auteur Jean Forteroche." class="img-thumbnail img-responsive">
                    </div>
                    <div class="col-lg-6">
                        <h2>JeanForteroche</h2>
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
        <h1>Billet simple pour l'Alaska</h1>
        <p>Derniers billets du blog :</p>
    </div>
</div>

<?php
while ($data = $posts->fetch())
{
    ?>

    <div class="row">
        <div class="col-lg-12">
            <h3>
                <?= htmlspecialchars($data['title']) ?>
                <em>le <?= $data['creation_date_fr'] ?></em>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($data['content'])) ?>
                <br />
                <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
            </p>
        </div>
    </div>
    <hr>
    <?php
}
$posts->closeCursor();
?>
    <!-- Pager -->
    <div class="row" id="older-posts-btn-section">
        <div class="col-lg-offset-10 col-lg-2">
            <a class="btn btn-primary" href="#">Plus anciens &rarr;</a>
        </div>
    </div>

<?php $content = ob_get_clean(); // récupère le contenu généré avec cette fonction et on met le tout dans $content ?>
<?php require('template.php'); ?>