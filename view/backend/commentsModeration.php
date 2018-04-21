<?php $title = 'Billet simple pour l\'Alaska'; ?>
<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-hover table-bordered">
            <caption></caption>

            <thead>
            <tr class="info">
                <th>Auteur</th>
                <th>Commentaire</th>
                <th>Date de publication</th>
                <th>Modérer</th>
            </tr>
            </thead>

            <tbody>
            <?php
            while ($comment = $comments->fetch()) {
                ?>
            <tr>
                <td class="default"><?= htmlspecialchars($comment['author']) ?></td>
                <td class="default"><?= nl2br(htmlspecialchars($comment['content'])) ?></td>
                <td class="default"><?= $comment['creation_date_fr'] ?></td>
                <td class="danger"><a href="">Modifier</a> <a href="">Supprimer</a></td>
            </tr>
                <?php
            }
            $comments->closeCursor();
            ?>
            </tbody>

        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>