<?php $title = 'Administration du site - Gestion des billets'; ?>

<?php ob_start(); ?>

<div class="row table-row">
    <div class="col-lg-12">
        <h2><i class="fa fa-bars"></i> Liste des billets</h2>
        <?php if(!isset($_SESSION)){session_start();} ?>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?= $_SESSION['message']; ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <div>
            <a href="index.php?action=postsManager" class="btn btn-default">Plus récent au plus ancien</a>
            <a href="index.php?action=postsManager&amp;orderBy=date" class="btn btn-default">Plus ancien au plus récent</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <caption></caption>
                <thead>
                <tr>
                    <th class="info th" scope="col">Titre</th>
                    <th class="info th" scope="col">Extraits des billets</th>
                    <th class="info th" scope="col">Date de publication</th>
                    <th class="info th" scope="col" colspan="2">Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php if (isset($posts) && $posts != false):
                foreach ($posts as $post): ?>
                    <tr>
                        <td class="success" scope="row"><?= $post->getTitle(); ?></td>
                        <td class="default" scope="row"><?= strip_tags($post->getPostExcerpt()); ?>...</td>
                        <td class="warning" scope="row"><?= $post->getCreationDateFr(); ?></td>
                        <td class="danger" scope="row"><a href="index.php?action=viewOrChangePost&amp;postId=<?= $post->getId(); ?>" class="btn btn-success">Voir ou Modifier</a></td>
                        <td class="danger" scope="row"><a href="index.php?action=deletePost&amp;postId=<?= $post->getId(); ?>" class="btn btn-danger">Supprimer</a></td>
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
                    <li class="page-item"><a href="index.php?action=postsManager&amp;page=<?= $currentPage - 1 ?>" class="page-link"><i class="fa fa-angle-left"></i></a></li>
                <?php endif; ?>
                <?php
                for ($i = 1; $i <= $nbPages; $i++) {
                    if ($i == $currentPage): ?>
                        <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a href="index.php?action=postsManager&amp;page=<?= $i ?>" class="page-link"><?=$i?></a></li>
                    <?php endif;
                } ?>
                <?php if ($currentPage + 1 > $nbPages): ?>
                    <li class="page-item disabled"><span><i class="fa fa-angle-right"></i></span></li>
                <?php else : ?>
                    <li class="page-item"><a href="index.php?action=postsManager&amp;page=<?= $currentPage + 1 ?>" class="page-link"><i class="fa fa-angle-right"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
