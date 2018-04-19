<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
    <div class="row">
        <div class="col-lg-12">
            <h1>Billet simple pour l'Alaska</h1>
            <p><a href="index.php">Retour à la liste des billets</a></p>
        </div>
    </div>

    <div class="row">
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
    <div class="row">
        <div class="col-lg-12">
            <h2>Commentaires</h2>

            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <div class="form-group">
                    <label for="author">Auteur</label>
                    <input type="text" id="author" name="author" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Commentaire</label>
                    <textarea id="content" name="content" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-lg">
                </div>
            </form>

            <?php while ($comment = $comments->fetch()) {
                ?>
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['creation_date_fr'] ?> <a href="index.php?action=commentView&amp;commentId=<?= $comment['id'] ?>&amp;postId=<?= $post['id'] ?>" method="get"">(modifier)</a></p>
                <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                <?php
            }
            ?>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>