<?php $title = 'Billet simple pour l\'Alaska'; ?>
<?php ob_start(); ?>

<div class="row" >
    <div class="col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6" id="contact-view">

        <form action="index.php?action=sendMail" method="post" class="form-horizontal">
            <fieldset>
                <legend>Formulaire de contact</legend>

                <div class="form-group">
                    <label for="lastName">Votre nom<span class="star">*</span></label>
                    <input type="text" name="lastName" id="lastName" title="Nom"  placeholder="nom" required class="form-control" maxlength="80" value="">
                </div>
                <div class="form-group">
                    <label for="firstName">Votre prénom<span class="star">*</span></label>
                    <input type="text" name="firstName" id="firstName" title="Prénom" placeholder="prénom" required class="form-control" maxlength="80" value="">
                </div>
                <div class="form-group">
                    <label for="tel">Votre numéro de téléphone<span class="star">*</span></label>
                    <input type="tel" name="tel" id="tel" title="Numéro" placeholder="téléphone" required class="form-control" maxlength="10" onkeydown="if(event.keyCode==32) return false;" value="">
                </div>
                <div class="form-group">
                    <label for="email" class="">Votre adresse mail<span class="star">*</span></label>
                    <input type="email" name="email" id="email" title="Adresse mail" placeholder="@ adresse e-mail" required class="form-control" maxlength="100" value="">
                </div>
                <div class="form-group">
                    <label for="subject">Objet<span class="star">*</span></label>
                    <input type="text" name="subject" id="subject" title="Objet" placeholder="objet" required class="form-control" maxlength="150" value="">
                </div>
                <div class="form-group">
                    <label for="message">Votre message<span class="star">*</span></label>
                    <textarea name="message" id="message" rows="8" required class="form-control"></textarea>
                </div>

                <div class="form-group reset-send">
                    <label for="send"></label>
                    <input type="submit" id="send" name="send" title="Valider et envoyer le formulaire" class="btn btn-success btn-lg" value="Envoyer">
                    <label for="reset"></label>
                    <input type="reset" id="reset" name="reset" class="btn btn-warning btn-lg" value="Réinitialiser">
                </div>

                <i>* champs requis</i>
            </fieldset>
        </form>

    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>