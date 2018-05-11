
<?php $title = $post->getTitle(); ?>

<?php ob_start(); ?>
    <div class="row">
        <div class="col-lg-12">
            <p><a href="index.php?action=allPostsView">Retour aux billets</a></p>
        </div>
    </div>

    <div class="row" id="post-view">
        <div class="col-lg-12">
            <h3><?= htmlspecialchars($post->getTitle()); ?></h3>
            <hr>
            <p><?= $post->getContent(); ?></p>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <span>Par <strong><?= $post->getAuthor(); ?></strong></span>
                    <span>le<em> <?= $post->getCreationDateFr(); ?></em></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="comment-form">
        <div class="col-lg-12">
            <h2>Commentaires</h2>
            <?php if(!isset($_SESSION)){session_start();} ?>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="message"><?= $_SESSION['message']; ?></div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <form action="index.php?action=addComment&amp;id=<?= $post->getId(); ?>&amp;postTitle=<?= $post->getTitle(); ?>" method="post">
                <div class="form-group">
                    <label for="author">Auteur</label>
                    <input type="text" id="author" name="author" class="form-control" required maxlength="255">
                </div>
                <div class="form-group">
                    <label for="comment">Commentaire</label>
                    <textarea id="comment" name="comment" class="form-control" required maxlength="255"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-lg">
                </div>
            </form>

            <?php if ((isset($comments) && $comments != false)):
            foreach ($comments as $comment): ?>
                <p>
                    <strong><?= htmlspecialchars($comment->getAuthor()); ?></strong> le <?= $comment->getCreationDateFr(); ?>
                    <?php if ($comment->getReported() != 1): ?>
                        <a href="index.php?action=reportComment&amp;commentId=<?= $comment->getId(); ?>&amp;reported=1&amp;postId=<?= $post->getId(); ?>">(signaler)</a>
                    <?php endif; ?>
                </p>

                <?php if ($comment->getReported() == 1): ?>
                    <p><i>Commentaire en attente de modération</i></p>
                <?php else: ?>
                    <p><?= nl2br(htmlspecialchars($comment->getContent())); ?></p>
                <?php endif; ?>

            <?php endforeach; ?>
            <?php endif; ?>

            <?php if (isset($currentPage)): ?>
            <div>
                <ul class="pagination text-center">
                    <?php if ($currentPage - 1 == 0): ?>
                        <li class="page-item disabled"><span><i class="fa fa-angle-left"></i></span></li>
                    <?php else : ?>
                        <li class="page-item"><a href="index.php?action=post&amp;id=<?= $post->getId(); ?>&amp;page=<?=$currentPage - 1 ?>" class="page-link"><i class="fa fa-angle-left"></i></a></li>
                    <?php endif; ?>
                    <?php
                    for ($i = 1; $i <= $nbPages; $i++) {
                        if ($i == $currentPage): ?>
                            <li class="page-item active"><a class="page-link"><?= $i ?></a></li>
                        <?php else : ?>
                            <li class="page-item"><a href="index.php?action=post&amp;id=<?= $post->getId(); ?>&amp;page=<?= $i ?>" class="page-link"><?=$i?></a></li>
                        <?php endif;
                    } ?>
                    <?php if ($currentPage + 1 > $nbPages): ?>
                        <li class="page-item disabled"><span><i class="fa fa-angle-right"></i></span></li>
                    <?php else : ?>
                        <li class="page-item"><a href="index.php?action=post&amp;id=<?= $post->getId(); ?>&amp;page=<?=$currentPage + 1 ?>" class="page-link"><i class="fa fa-angle-right"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>