<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-md-offset-1 col-lg-10" id="admin-connexion-view">
        <?php if(!isset($_SESSION)){session_start();} ?>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="message"><?= $_SESSION['message']; ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <form action="index.php?action=adminInterfaceLogin" method="post" class="form-horizontal">
            <fieldset>
                <!-- Form Name -->
                <legend><center>Connexion à la page d'administration</center></legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">Adresse mail <span class="star">*</span></label>
                    <div class="col-md-4">
                        <input id="email" name="email" type="text" placeholder="Adresse mail" class="form-control input-md" required>
                    </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">Mot de passe <span class="star">*</span></label>
                    <div class="col-md-4">
                        <input id="password" name="password" type="password" placeholder="Mot de passe" class="form-control input-md" required>
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
            <small><i>* champs requis</i></small>
            </fieldset>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
