<?php $title = 'Administration du site - Modération des commentaires'; ?>

<?php ob_start(); ?>

<div class="row table-row">
    <div class="col-lg-12">
        <h2><i class="fa fa-bars"></i> Liste des commentaires</h2>
        <?php if(!isset($_SESSION)){session_start();} ?>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?= $_SESSION['message']; ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <div>
            <a href="index.php?action=commentsModeration" class="btn btn-default">Trier par statut</a>
            <a href="index.php?action=commentsModeration&amp;orderBy=date" class="btn btn-default">Trier par date</a>
            <a href="index.php?action=commentsModeration&amp;orderBy=posts" class="btn btn-default">Trier par billet</a>
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
                <?php if (isset($comments) && $comments != false):
                    foreach ($comments as $comment): ?>
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
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if (isset($currentPage)): ?>
    <div class="row">
        <div class="col-lg-12">
            <ul class="pagination text-center">
                <?php if ($currentPage - 1 == 0): ?>
                    <li class="page-item disabled"><span><i class="fa fa-angle-left"></i></span></li>
                <?php else : ?>
                    <li class="page-item"><a href="index.php?action=commentsModeration&amp;page=<?=$currentPage - 1 ?>" class="page-link"><i class="fa fa-angle-left"></i></a></li>
                <?php endif; ?>
                <?php
                for ($i = 1; $i <= $nbPages; $i++) {
                    if ($i == $currentPage): ?>
                        <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a href="index.php?action=commentsModeration&amp;page=<?= $i ?>" class="page-link"><?=$i?></a></li>
                    <?php endif;
                } ?>
                <?php if ($currentPage + 1 > $nbPages): ?>
                    <li class="page-item disabled"><span><i class="fa fa-angle-right"></i></span></li>
                <?php else : ?>
                    <li class="page-item"><a href="index.php?action=commentsModeration&amp;page=<?=$currentPage + 1 ?>" class="page-link"><i class="fa fa-angle-right"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>