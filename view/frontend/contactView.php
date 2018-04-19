<?php $title = 'Billet simple pour l\'Alaska'; ?>
<?php ob_start(); ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

        <form action="" method="post" class="form-horizontal" id="formulaire">
            <fieldset>
                <legend>Formulaire de contact</legend>

                <div class="form-group">
                    <label for="nom">Votre nom<span class="star">*</span></label>
                    <input type="text" name="nom" id="nom" title="Nom"  placeholder="nom" required class="form-control" maxlength="80" value=""/>
                </div>
                <div class="form-group">
                    <label for="prenom">Votre prénom<span class="star">*</span></label>
                    <input type="text" name="prenom" id="prenom" title="Prénom" placeholder="prénom" required class="form-control" maxlength="80" value=""/>
                </div>
                <div class="form-group">
                    <label for="tel">Votre numéro de téléphone<span class="star">*</span></label>
                    <input type="tel" name="tel" id="tel" title="Numéro" placeholder="téléphone" required class="form-control" maxlength="10" onkeydown="if(event.keyCode==32) return false;" value=""/>
                </div>
                <div class="form-group">
                    <label for="mail" class="">Votre adresse mail<span class="star">*</span></label>
                    <input type="email" name="mail" id="mail" title="Adresse mail" placeholder="@ adresse e-mail" required class="form-control" maxlength="100" value=""/>
                </div>
                <div class="form-group">
                    <label for="subject">Objet<span class="star">*</span></label>
                    <input type="text" name="subject" id="subject" title="Objet" placeholder="objet" required class="form-control" maxlength="150" value=""/>
                </div>
                <div class="form-group">
                    <label for="message">Votre message<span class="star">*</span></label>
                    <textarea name="message" id="message" rows="8" required class="form-control"></textarea>
                </div>

                <div class="form-group reset-send">
                    <label for="reset"></label>
                    <input type="reset" id="reset" name="reset" class="btn btn-danger btn-lg" value="Réinitialiser"/>
                    <label for="send"></label>
                    <input type="submit" id="send" name="send" title="Valider et envoyer le formulaire" class="btn btn-success btn-lg" value="Envoyer"/>
                </div>

                <i>* champs requis</i>
            </fieldset>
        </form>

    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>