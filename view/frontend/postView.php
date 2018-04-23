<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
    <div class="row">
        <div class="col-lg-12">
            <p><a href="index.php?action=allPostsView">Retour aux billets</a></p>
        </div>
    </div>

    <div class="row" id="post-view">
        <div class="col-lg-12">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
            <br>
            <p>
                Par <strong><?= $post['author'] ?></strong> <em>le <?= $post['creation_date_fr'] ?></em>
            </p>
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
                    <a method="get" href="index.php?action=commentView&amp;commentId=<?= $comment['id'] ?>&amp;postId=<?= $post['id'] ?>" >(modifier)</a>
                    <a method="get" href="index.php?action=reportComment&amp;commentId=<?= $comment['id'] ?>&amp;reported=1&amp;postId=<?= $post['id'] ?>">(signaler)</a>
                    <?php endif; ?>
                </p>

                <?php if ($comment['reported'] == 1): ?>
                    <i>Commentaire en attente de modération</i>
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