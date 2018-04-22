<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

    <div class="row" id="comment-view">
        <div class="col-lg-12">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>
    </div>

    <div class="row" id="comment-form">
        <div class="col-lg-12">
            <h3>Modifier le commentaire</h3>
            <form action="index.php?action=editComment&amp;commentId=<?= $comment['id'] ?>&amp;id=<?= $post['id'] ?>" method="post">
                <p>
                    <b name="author">Auteur: <?= $comment['author'] ?></b> le <?= $comment['creation_date_fr'] ?>
                </p>
                <div class="form-group">
                    <label for="comment">Modifier le commentaire</label><br>
                    <textarea id="comment" name="comment" class="form-control"><?= nl2br(htmlspecialchars($comment['content'])) ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Modifier" class="btn btn-primary btn-lg">
                </div>
            </form>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>