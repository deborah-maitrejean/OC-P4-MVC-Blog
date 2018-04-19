<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-12">
        <form class="form-horizontal">
            <fieldset>

                <!-- Form Name -->
                <legend><center>Connexion à la page d'administration</center></legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Nom d'utilisateur </label>
                    <div class="col-md-4">
                        <input id="textinput" name="textinput" type="text" placeholder="Identifiant" class="form-control input-md">
                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="passwordinput">Mot de passe </label>
                    <div class="col-md-4">
                        <input id="passwordinput" name="passwordinput" type="password" placeholder="Mot de passe" class="form-control input-md">
                    </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="button1id"></label>
                    <div class="col-md-8">
                        <button id="button1id" name="button1id" class="btn btn-success">Valider</button>
                        <button id="button2id" name="button2id" class="btn btn-danger">Annuler</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
