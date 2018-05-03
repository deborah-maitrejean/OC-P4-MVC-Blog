<?php $title = 'Page non trouvée'; ?>

<?php ob_start(); ?>
<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <div class="error-template">
            <h2>Oups! 404 Non trouvée</h2>
            <br>
            <div class="error-details">
                Nous sommes désolé, une erreur est survenue, La page demandée n'existe pas!
            </div>
            <br>
            <div class="error-actions">
                <a href="index.php" class="btn btn-primary btn-lg">
                    <span class="glyphicon glyphicon-home"></span> Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
