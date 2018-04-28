
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
            <p><?= strip_tags($post->getContent()); ?></p>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <span>Par <strong><?= $post->getAuthor(); ?></strong></span>
                    <span>le<em> <?= $post->getCreationDate(); ?></em></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="comment-form">
        <div class="col-lg-12">
            <h2>Commentaires</h2>

            <form action="index.php?action=addComment&amp;id=<?= $post->getId(); ?>&amp;postTitle=<?= $post->getTitle(); ?>" method="post">
                <div class="form-group">
                    <label for="author">Auteur</label>
                    <input type="text" id="author" name="author" class="form-control">
                </div>
                <div class="form-group">
                    <label for="comment">Commentaire</label>
                    <textarea id="comment" name="comment" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-lg">
                </div>
            </form>

            <?php
                foreach ($comments as $comment):
                ?>

                <p>
                    <strong><?= htmlspecialchars($comment->getAuthor()); ?></strong> le <?= $comment->getCreationDateFr(); ?>
                    <?php
                    if ($comment->getReported() != 1): ?>
                    <a href="index.php?action=reportComment&amp;commentId=<?= $comment->getId(); ?>&amp;reported=1&amp;postId=<?= $post->getId(); ?>">(signaler)</a>
                    <?php endif; ?>
                </p>

                <?php if ($comment->getReported() == 1): ?>
                    <p><i>Commentaire en attente de modération</i></p>
                <?php else: ?>
                <p><?= nl2br(htmlspecialchars($comment->getContent())); ?></p>
                <?php endif; ?>

                <?php
                endforeach;
            ?>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>