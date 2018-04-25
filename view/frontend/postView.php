<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
    <div class="row">
        <div class="col-lg-12">
            <p><a href="index.php?action=allPostsView">Retour aux billets</a></p>
        </div>
    </div>

    <div class="row" id="post-view">
        <div class="col-lg-12">
            <h3><?= htmlspecialchars($post['title']) ?></h3>
            <hr>
            <p><?= strip_tags($post['content']) ?></p>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <span>Par <strong><?= $post['author'] ?></strong></span>
                    <span>le<em> <?= $post['creation_date_fr'] ?></em></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="comment-form">
        <div class="col-lg-12">
            <h2>Commentaires</h2>

            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>&amp;postTitle=<?= $post['title'] ?>" method="post">
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

            <?php while ($comment = $comments->fetch()) {
                ?>

                <p>
                    <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['creation_date_fr'] ?>
                    <?php
                    if ($comment['reported'] != 1): ?>
                    <a href="index.php?action=reportComment&amp;commentId=<?= $comment['id'] ?>&amp;postId=<?= $post['id'] ?>">(signaler)</a>
                    <?php endif; ?>
                </p>

                <?php if ($comment['reported'] == 1): ?>
                    <p><i>Commentaire en attente de modération</i></p>
                <?php else: ?>
                <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                <?php endif; ?>

                <?php
            }
            ?>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>