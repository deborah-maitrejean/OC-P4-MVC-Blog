<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<?php
function proteger($adr) {
    $adresseCodee = "";
    for ($i=0; $i<strlen($adr); $i++)
        $adresseCodee .= "&#" . ord(substr($adr, $i, 1)) . ";";
    return $adresseCodee;
}
?>
<div class="row">
    <div class="col-lg-12 legales-mentions">
        <h2>Mentions légales</h2>
        <h3>1. Présentation de notre site web</h3>
        <p>Conformément à la loi n° 2004-2005 du 21 juin 2004 pour la confiance dans l'économie numérique, notre site web créé par <?php echo "<a href='" . proteger("mailto:deborah.maitrejean@gmail.com") . "'>Déborah Maitrejean</a>"; ?>, propriétaire du site <a href="http://deborah-maitrejean.com/">http://deborah-maitrejean.com/</a> met à disposition du public les informations concernant notre entreprise.<br />
            Eventuellement modifiables, nous vous invitons donc à consulter nos mentions légales le plus souvent possible, de manière à en prendre connaissance fréquemment.</p>
        <p>Le site <a href="" title="Jean Forteroche">Billet simple pour l'Alaska</a> appartient à <strong>Jean Forteroche</strong> - Ecrivain.<br/>
            Personne physique ou morale, Jean forteroche est responsable de la publication, dont l'adresse e-mail est la suivante : <?php echo "<a href='" . proteger("mailto:forterochej@gmail.com") . "'>forterochej[at]gmail.com</a>"; ?><br />
            Le webmaster, <a href="http://deborah-maitrejean.com/">Déborah Maitrejean</a>, est responsable de l'administration du site, dont l'adresse e-mail est la suivante : <?php echo "<a href='" . proteger("mailto:deborah.maitrejean@gmail.com") . "'>deborah.maitrejean[at]gmail.com</a>"; ?>.<br />
            Le site <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a> est hébergé par <a href="https://www.ovh.com/fr/">OVH</a>, dont le siège social est localisé à l'adresse suivante : 2 rue Kellermann - 59100 Roubaix - France.</p>

        <h3>2. Conditions générales d’utilisation du site et des services proposés.</h3>
        <p>En utilisant notre site web <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a>, vous acceptez pleinement et entièrement les conditions générales d'utilisation précisées dans nos mentions légales. Accessible à tout type de visiteurs,
            il est important de préciser toutefois qu'une interruption pour maintenance du site web peut-être décidée par Jean Forteroche. Les dates et heures d'interruptions seront néanmoins précisées à l'avance aux utilisateurs.</p>

        <h3>3. Les services proposés par Billet simple pour l'Alaska</h3>
        <p>En accord avec sa politique de communication, le site <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a> a pour vocation d'informer les utilisateurs sur les services proposés par Jean Forteroche, qui s'efforce alors de fournir des informations précises sur son activité. Cependant, des inexactitudes ou des omissions peuvent exister : la société ne pourra en aucun cas être tenue pour responsable pour toute erreur présente sur le site <a href="index.php" title="Jean Fortercohe">Billet simple pour l'Alaska</a>.</p>

        <h3>4.  Limitations contractuelles</h3>
        <p>Les informations retranscrites sur notre site web <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a> font l’objet de démarches qualitatives, en vue de nous assurer de leur fiabilité.
            Cependant, nous ne pourrons encourir de responsabilités en cas d’inexactitudes techniques lors de nos explications.<br />
            Si vous constatez une erreur concernant des informations que nous auront pu omettre, n’hésitez pas à nous le signaler par mail à <?php echo "<a href='" . proteger("mailto:forterochej@gmail.com") . "'>forterochej[at]gmail.com</a>"; ?>.</p>
        <p>Les liens reliés directement ou indirectement à notre site web <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a> ne sont pas sous le contrôle de notre société. Par conséquent, nous ne pouvons nous assurer de l’exactitude des informations présentes sur ces autres sites Internet.</p>
        <p>Utilisant la technologie JavaScript, le site <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a> ne pourra être tenu pour responsable en cas de dommages matériels liés à son utilisation. Par ailleurs, toute autre type de conséquence liée à l'exploitation du site <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a>, qu'elle soit direct ou indirect (bug, incompatibilité, virus, perte de marché, etc.).</p>

        <h3>5. Propriété intellectuelle et contenu du site Internet</h3>
        <p>Le contenu rédactionnel du site web <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a> appartient exclusivement à Jean Forteroche. Toute violation des droits d’auteur est sanctionnée par l’article L.335-2 du Code de la Propriété Intellectuelle, avec une peine encourue de 2 ans d’emprisonnement et de 150 000€ d’amende</p>
        <p>Le site <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a> ne pourra être mis en cause en cas de propos injurieux, à caractère raciste, diffamant ou pornographique, échangés sur les espaces interactifs. La société se réserve également le droit de supprimer tout contenu contraire aux valeurs de l'entreprise ou à la législation applicable en France.</p>

        <h3>6. Données personnelles, respect de votre vie privée et de vos libertés</h3>
        <p>Toute information recueillie sur le site web <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a> se fait dans le cadre des besoins liés à l'utilisation de notre plateforme, tel que le formulaire de contact.<br/>
            Jean Forteroche s'engage à ne céder en aucun cas les informations concernant les utilisateurs du site Internet, de quelque façon qu'il soit (vente, échange, prêt, location, don).</p>
        <p>Conformément à la loi « informatique et libertés » du 6 janvier 1978 modifiée en 2004, l’utilisateur bénéficie d’un droit d’accès et de rectification aux informations le concernant, droit qu’il peut exercer à tout moment en adressant un mail à l’adresse <?php echo "<a href='" . proteger("mailto:deborah.maitrejean@gmail.com") . "'>Déborah Maitrejean</a>"; ?>.</p>
        <p>Ne conservant aucune donnée des visiteurs et des utilisateurs, le site web concerné ne fait pas l'objet d'une déclaration à la CNIL.<br/></p>
        <p>Pour lire les mentions relatives aux cookies, <a href="index.php?action=cookies">cliquez sur ce lien</a>.

        <h3>7. Droit applicable et lois concernées</h3>
        <p>Soumis au droit français, le site web <a href="index.php" title="Jean Forteroche">Billet simple pour l'Alaska</a> est encadré par la loi n° 2004-2005 du 21 juin 2004 pour la confiance dans l'économie numérique, l’article L.335-2 du Code de la Propriété Intellectuelle et la loi « informatique et libertés » du 6 janvier 1978 modifiée en 2004.</p>
    </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
