<?php $title = 'Administration du site - Modérer le commentaires'; ?>

<?php ob_start(); ?>

<?php if(isset($_GET['commentId'])): ?>
    <div class="row">
        <div class="col-lg-12">
            <p><a href="index.php?action=commentsModeration">Retour à la liste des commentaires</a></p>
        </div>
    </div>

    <div class="row" id="moderateCommentForm">
        <div class="col-lg-offset-4 col-lg-4">
            <?php if(!isset($_SESSION)){session_start();} ?>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="message"><?= $_SESSION['message']; ?></div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
            <form action="index.php?action=editComment&amp;commentId=<?= $comment->getId(); ?>&amp;reported=0" method="post">
                <div class="form-group">
                    <b name="author">Auteur:</b> <?= $comment->getauthor(); ?>
                </div>
                <div class="form-group">
                    <b>Date:</b> le <?= $comment->getCreationDateFr(); ?>
                </div>
                <div class="form-group">
                    <label for="comment">Modérer le commentaire:</label><br>
                    <textarea id="comment" name="comment" class="form-control"><?= nl2br(htmlspecialchars($comment->getContent())); ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="Modérer" class="btn btn-success btn-lg">
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
