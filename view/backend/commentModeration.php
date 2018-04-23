<?php $title = 'Administration du site - Modérer le commentaires'; ?>

<?php ob_start(); ?>

<?php if(isset($_GET['commentId'])): ?>
    <div class="row" id="moderateCommentForm">
        <div class="col-lg-offset-4 col-lg-4">
            <form action="index.php?action=editComment&amp;commentId=<?= $comment['id'] ?>" method="post">
                <div class="form-group">
                    <b name="author">Auteur:</b> <?= $comment['author'] ?>
                </div>
                <div class="form-group">
                    <b>Date:</b> le <?= $comment['creation_date_fr'] ?>
                </div>
                <div class="form-group">
                    <label for="comment">Modérer le commentaire:</label><br>
                    <textarea id="comment" name="comment" class="form-control"><?= nl2br(htmlspecialchars($comment['content'])) ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Modifier" class="btn btn-success btn-lg">
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
