<?php $title = 'Administration du site - Gestion des billets'; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <caption></caption>
                <thead>
                <tr>
                    <th class="info th" scope="col">Titre</th>
                    <th class="info th" scope="col">Contenu des billets</th>
                    <th class="info th" scope="col">Date de publication</th>
                    <th class="info th" scope="col" colspan="2">Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php
                while ($post = $posts->fetch()) {
                    ?>
                    <tr>
                        <td class="success" scope="row"><?= htmlspecialchars($post['title']) ?></td>
                        <td class="default" scope="row"><?= nl2br(htmlspecialchars($post['content'])) ?></td>
                        <td class="warning" scope="row"><?= $post['creation_date_fr'] ?></td>
                        <td class="danger" scope="row"><a href="" class="btn btn-success">Modifier</a></td>
                        <td class="danger" scope="row"><a href="" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                    <?php
                }
                $posts->closeCursor();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
