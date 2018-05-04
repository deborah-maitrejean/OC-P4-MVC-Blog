<?php $title = 'Paramètres'; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-6">
        <form action="index.php?action=changePassword" method="post">
            <fieldset>
                <legend>Changer le mot de passe de connexion</legend>

                <div class="form-group">
                    <label for="password">Entrez votre mot de passe actuel<span class="star">*</span></label>
                    <input type="text" name="password" id="password" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="newPassword">Nouveau mot de passe<span class="star">*</span></label>
                    <input type="text" name="newPassword" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="newPassword">Confirmez le nouveau mot de passe<span class="star">*</span></label>
                    <input type="text" name="newPassword" required class="form-control">
                </div>
                <div class="form-group reset-send">
                    <label for="submit"></label>
                    <input type="submit" id="submit" name="submit" title="Modifier" class="btn btn-success btn-lg" value="Modifier">
                    <label for="reset"></label>
                    <input type="reset" id="reset" name="reset" class="btn btn-danger btn-lg" value="Réinitialiser">
                </div>
                <i>* champs requis</i>
            </fieldset>
        </form>
    </div>
    <div class="col-lg-6">
        <form action="index.php?action=changeLogin" method="post">
            <fieldset>
                <legend>Changer l'identifiant de connexion</legend>

                <div class="form-group">
                    <label for="login">Entrez votre identifiant actuel<span class="star">*</span></label>
                    <input type="text" name="login" id="login" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="newLogin">Nouvel identifiant<span class="star">*</span></label>
                    <input type="text" name="newLogin" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="newLogin">Confirmez le nouvel identifiant<span class="star">*</span></label>
                    <input type="text" name="newLogin" required class="form-control">
                </div>
                <div class="form-group reset-send">
                    <label for="submit"></label>
                    <input type="submit" id="submit" name="submit" title="Modifier" class="btn btn-success btn-lg" value="Modifier">
                    <label for="reset"></label>
                    <input type="reset" id="reset" name="reset" class="btn btn-danger btn-lg" value="Réinitialiser">
                </div>
                <i>* champs requis</i>
            </fieldset>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
