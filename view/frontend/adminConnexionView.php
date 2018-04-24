<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-md-offset-1 col-lg-10">
        <form action="index.php?action=adminInterfaceLogin" method="post" class="form-horizontal" id="admin-connexion-view">
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
                    <label class="col-md-4 control-label" for="adminPassword">Mot de passe </label>
                    <div class="col-md-4">
                        <input id="password" name="adminPassword" type="password" placeholder="Mot de passe" class="form-control input-md">
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="submit"></label>
                    <div class="col-md-8">
                        <input type="submit" id="submit" name="submit" class="btn btn-success btn-lg" placeholder="Valider">
                        <input type="reset" id="cancel" name="cancel" class="btn btn-danger btn-lg" placeholder="Annuler">
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
