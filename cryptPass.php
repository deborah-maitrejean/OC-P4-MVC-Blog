<?php
if (isset($_POST['login']) AND isset($_POST['pass']))
{
    //$salt = ;
    $login = $_POST['login'];
    $pass_crypte = hash('sha512', $_POST['pass']); // On crypte le mot de passe

    echo '<p>Ligne à copier dans le .htpasswd ou données à entrer dans la base de données:<br>' . $login . ':' . $pass_crypte . '</p>';
}

else // On n'a pas encore rempli le formulaire
{
    ?>

    <p>Entrez votre login et votre mot de passe pour le crypter.</p>

    <form method="post">
        <p>
            Login : <input type="text" name="login"><br>
            Mot de passe : <input type="text" name="pass"><br><br>

            <input type="submit" value="Crypter !">
        </p>
    </form>

    <?php
}
?>