<?php $title = 'Administration du site - Nouveau billet' ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-12">
        <h2><i class="fa fa-pencil-square-o"></i> Rédiger un billet</h2>
        <form action="index.php?action=publishPost" method="post">
            <div class="form-group">
                <label for="title">Titre:</label>
                <input type="text">
            </div>
            <div class="form-group">
                <label for="content">Contenu:</label>
                <textarea id="content" name="content" class="tinymce"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Publier" class="btn btn-success btn-lg">
                <input type="reset" class="btn btn-danger btn-lg">
            </div>
        </form>
    </div>
</div>

<!-- tinymce editor scripts -->
<script src="public/js/tinymce/jquery.tinymce.min.js"></script>
<script src="public/js/tinymce/tinymce.min.js"></script>
<script src="public/js/tinymce/init-tinymce.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
