<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-12">
        <form action="" method="post" class="form-horizontal">
            <fieldset>
                <!-- Form Name -->
                <legend><center>Connexion à la page d'administration</center></legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Nom d'utilisateur </label>
                    <div class="col-md-4">
                        <input id="adminId" name="adminId" type="text" placeholder="Identifiant" class="form-control input-md">
                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Mot de passe </label>
                    <div class="col-md-4">
                        <input id="password" name="password" type="password" placeholder="Mot de passe" class="form-control input-md">
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="submit"></label>
                    <div class="col-md-8">
                        <input id="submit" name="submit" class="btn btn-success" placeholder="Valider">
                        <input id="cancel" name="cancel" class="btn btn-danger" placeholder="Annuler">
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
