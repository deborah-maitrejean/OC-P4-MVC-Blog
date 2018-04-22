<?php $title = 'Administration du site - Modération des commentaires'; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <caption></caption>

                <thead>
                <tr>
                    <th class="info th" scope="col">Auteur</th>
                    <th class="info th" scope="col">Commentaire</th>
                    <th class="info th" scope="col">Date de publication</th>
                    <th class="info th" scope="col">Billet correspondant</th>
                    <th class="info th" scope="col" colspan="2">Modérer</th>
                </tr>
                </thead>

                <tbody>
                <?php
                while ($comment = $comments->fetch()) {
                    ?>
                    <tr>
                        <td class="success" scope="row"><?= htmlspecialchars($comment['author']) ?></td>
                        <td class="default" scope="row"><?= nl2br(htmlspecialchars($comment['content'])) ?></td>
                        <td class="default" scope="row"><?= $comment['creation_date_fr'] ?></td>
                        <td class="warning" scope="row"><?= $comment['post_title'] ?></td>
                        <td class="danger" scope="row"><a href="" class="btn btn-success">Modifier</a></td>
                        <td class="danger" scope="row"><a href="" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                    <?php
                }
                $comments->closeCursor();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>