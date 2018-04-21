<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <caption></caption>

            <thead>
            <tr class="info">
                <th>Auteur</th>
                <th>Contenu</th>
                <th>Date de publication</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            <?php
            while ($post = $posts->fetch()) {
                ?>
                <tr>
                    <td class="default"><?= htmlspecialchars($post['author']) ?></td>
                    <td class="default"><?= nl2br(htmlspecialchars($post['content'])) ?></td>
                    <td class="default"><?= $post['creation_date_fr'] ?></td>
                    <td class="danger"><a href="">Modifier</a> <a href="">Supprimer</a></td>
                </tr>
                <?php
            }
            $posts->closeCursor();
            ?>
            </tbody>

        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
