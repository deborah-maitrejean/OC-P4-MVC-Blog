<?php $title = 'Paramètres'; ?>

<?php ob_start(); ?>

<div class="row settings-row">
    <h2><i class="fa fa-cog" aria-hidden="true"></i> Paramètres du compte</h2>
    <?php if(!isset($_SESSION)){session_start();} ?>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message"><?= $_SESSION['message']; ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <div class="col-lg-6 settings-form">
        <form action="index.php?action=changePassword" method="post">
            <fieldset>
                <legend>Changer le mot de passe de connexion</legend>

                <div class="form-group">
                    <label for="email">Entrez votre identifiant de connexion<span class="star">*</span></label>
                    <input type="email" name="email" id="email" required class="form-control" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="newPassword">Nouveau mot de passe<span class="star">*</span></label>
                    <input type="password" name="newPassword" required class="form-control" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="newPasswordVerif">Confirmez le nouveau mot de passe<span class="star">*</span></label>
                    <input type="password" name="newPasswordVerif" required class="form-control" maxlength="255">
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
    <div class="col-lg-6 settings-form">
        <form action="index.php?action=changeLogin" method="post">
            <fieldset>
                <legend>Changer l'identifiant de connexion</legend>

                <div class="form-group">
                    <label for="email">Entrez votre adresse mail actuelle<span class="star">*</span></label>
                    <input type="email" name="email" id="email" required class="form-control" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="newEmail">Nouvelle adresse mail de connexion<span class="star">*</span></label>
                    <input type="email" name="newEmail" required class="form-control" maxlength="255">
                </div>
                <div class="form-group">
                    <label for="newEmailVerif">Confirmez la nouvelle adresse mail<span class="star">*</span></label>
                    <input type="email" name="newEmailVerif" required class="form-control" maxlength="255">
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
