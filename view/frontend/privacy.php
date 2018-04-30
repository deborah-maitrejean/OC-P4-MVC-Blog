<?php $title = 'Mentions relatives aux cookies'; ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-12 legales-mentions">
        <h2>Mentions relatives aux cookies</h2>
        <h3>Qu'est-ce qu'un Cookie et à quoi sert-il ?</h3>
        <p>Un Cookie (ou témoin de connexion) est un petit fichier texte qu'un serveur internet peut stocker sur votre machine afin de mémoriser vos préférences de consultation pour un site donné
            et vous reconnaître lors d'une prochaine visite de ce même site.</p>

        <h3>Cookie du bandeau d’acceptation des Cookies</h3>
        <p>Lorsque vous visitez une page de notre site, un bandeau en haut de page vous informe de l'utilisation des cookies sur notre site.<br>
            En cliquant sur <i>Ok</i> et en continuant votre navigation sur notre site, vous vous engagez à accepter l’utilisation des cookies.<br>
        </p>

        <h3>Session</h3>
        <p>Nous utilisons une technologie dénommée « session », qui nous sert à sauvegarder vos données, et ce uniquement pour la durée de la session.<br>
            Une fois le formulaire envoyé, la session et les données mémorisées sont automatiquement détruites.
        </p>

        <h3>Statistiques</h3>
        <p>Ce site utilise « Google Analytics » à des fins de mesure d'audience, pour nous permettre d'identifier des pages ne fonctionnant pas correctement sur notre site,
            et enfin pour nous permettre de programmer des maintenances techniques à des horaires de faible affluence.<br>
            Pour en savoir plus, consultez <a href="https://www.google.com/intl/fr/policies/privacy/">les règles de confidentialité de Google</a>.<br>
            Vous pouvez désactiver Google Analytics durant la navigation grâce à un module fourni par Google.
        </p>

        <h3>Comment accepter ou refuser les Cookies ?</h3>
        <p>Vous pouvez vous opposer à l’enregistrement de Cookies en configurant votre navigateur (dans le menu « outils » ou « options » de Mozilla Firefox ou de Microsoft Explorer, dans l'onglet « Paramètres - Paramètres de contenu » du menu de Google Chrome).<br>
            La plupart des navigateurs fournissent les instructions pour les refuser dans la section « Aide » de la barre d'outils.<br>
            Pour plus d'informations sur les outils permettant de contrôler les Cookies et limiter les traces de navigation, visitez <a href="https://www.cnil.fr/fr/cookies-les-outils-pour-les-maitriser">le site de la CNIL</a>.
        </p>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>