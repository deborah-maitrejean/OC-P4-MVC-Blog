<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<?php if(!isset($_SESSION)){session_start();} ?>
<?php if (isset($_SESSION['message'])): ?>
    <div class="message"><?= $_SESSION['message']; ?></div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php foreach ($posts as $post): ?>
    <div class="row" id="post-content">
        <div class="col-lg-12">
            <h3><i class="fa fa-bookmark"></i>&nbsp;&nbsp;<?= htmlspecialchars($post->getTitle()); ?></h3>
            <hr>
            <p><?= $post->getContent(); ?></p>
            <hr>
            <div class="row">
                <div class="col-xs-7 col-sm-8 col-md-6 col-lg-6">
                    <span>Par <strong><?= $post->getAuthor(); ?></strong></span>
                    <span>le<em> <?= $post->getCreationDateFr(); ?></em></span>
                </div>
                <div class="col-xs-5 col-sm-2 col-md-offset-3 col-md-3 col-lg-offset-4 col-lg-2">
                    <a href="index.php?action=post&amp;id=<?= $post->getId(); ?>" class="btn btn-primary">Commentaires &raquo;</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Pager -->
    <div class="row">
        <div class="col-lg-12">
            <ul class="pagination text-center">
                <?php if ($currentPage - 1 == 0): ?>
                    <li class="page-item disabled"><span><i class="fa fa-angle-left"></i></span></li>
                <?php else : ?>
                    <li class="page-item"><a href="index.php?action=allPostsView&amp;page=<?=$currentPage - 1 ?>" class="page-link"><i class="fa fa-angle-left"></i></a></li>
                <?php endif; ?>
                <?php
                for ($i = 1; $i <= $nbPages; $i++) {
                    if ($i == $currentPage): ?>
                        <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a href="index.php?action=allPostsView&amp;page=<?= $i ?>" class="page-link"><?=$i?></a></li>
                    <?php endif;
                } ?>
                <?php if ($currentPage + 1 > $nbPages): ?>
                    <li class="page-item disabled"><span><i class="fa fa-angle-right"></i></span></li>
                <?php else : ?>
                    <li class="page-item"><a href="index.php?action=allPostsView&amp;page=<?=$currentPage + 1 ?>" class="page-link"><i class="fa fa-angle-right"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

<?php $content = ob_get_clean(); // récupère le contenu généré avec cette fonction et on met le tout dans $content ?>
<?php require('template.php'); ?>