<?php
if (isset($_POST['login']) AND isset($_POST['pass'])) {
    $login = $_POST['login'];
    $pass_crypte = password_hash($_POST['pass'], PASSWORD_BCRYPT);

    echo '<p>Ligne à copier dans le .htpasswd ou à entrer dans la base de données:<br>' . $login . ':' . $pass_crypte . '</p>';
}
else
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