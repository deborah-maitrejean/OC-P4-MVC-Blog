<?php $title = 'Administration du site - Modération des commentaires'; ?>

<?php ob_start(); ?>

<div class="row table-row">
    <div class="col-lg-12">
        <h2><i class="fa fa-bars"></i> Liste des commentaires</h2>
        <div>
            <a href="index.php?action=commentsModeration" class="btn btn-default">Trier par statut</a>
            <a href="index.php?action=commentsByDate" class="btn btn-default">Trier par date</a>
        </div>
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
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td class="success" scope="row"><?= htmlspecialchars($comment->getAuthor()); ?></td>
                        <td class="default" scope="row"><?= nl2br(htmlspecialchars($comment->getContent())); ?></td>
                        <td class="default" scope="row"><?= $comment->getCreationdateFr(); ?></td>
                        <td class="warning" scope="row"><?= $comment->getPostTitle(); ?></td>
                        <?php if ($comment->getReported() == 1): ?>
                            <td class="danger" scope="row"><a href="index.php?action=moderateComment&amp;commentId=<?= $comment->getId(); ?>" class="btn btn-success">Modérer</a></td>
                        <?php else: ?>
                            <td class="danger" scope="row">non signalé</td>
                        <?php endif; ?>
                            <td class="danger" scope="row"><a href="index.php?action=deleteComment&amp;commentId=<?= $comment->getId(); ?>" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>