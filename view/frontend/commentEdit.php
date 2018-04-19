<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
    <h1>Mon super blog !</h1>
    <p><a href="index.php?action=post&amp;id=<?= $post['id'] ?>">Retour à la liste des commentaires</a></p>
    <div class="news">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>
    </div>

    <h2>Modifier le commentaire</h2>
    <form action="index.php?action=editComment&amp;commentId=<?= $comment['id'] ?>&amp;id=<?= $post['id'] ?>" method="post">
        <p>
            <b for="author">Auteur: <?= $comment['author'] ?></b> le <?= $comment['creation_date_fr'] ?>
        </p>
        <div>
            <label for="comment">Modifier le commentaire</label><br>
            <textarea id="comment" name="comment"><?= nl2br(htmlspecialchars($comment['content'])) ?></textarea>
        </div>
        <div>
            <input type="submit" value="Modifier">
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>