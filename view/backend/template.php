<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="language" content="fr">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2">

    <title>Administration du blog</title>

    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="copyright" content="Jean Forteroche">

    <!-- Add icon library -->
    <link href="<?= ASSETS ?>css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?= ASSETS ?>css/style.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <!-- TinyMCE editor -->
    <link rel="stylesheet" type="text/css" href="">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="admin">

<header id="admin-header">
    <div class="container-fluid">
        <h1><i class="fa fa-book" aria-hidden="true"></i> Administration du site</h1>
    </div>
</header>

<!-- Static navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" title="Revenir au site"><span class="fa fa-home"></span></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php?action=adminHomeView') !== false) {echo 'class="active"';} ?> title="Accueil de l'interface administration"><a href="index.php?action=adminHomeView">Accueil admin</a></li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php?action=postsManager') !== false) {echo 'class="active"';} ?>><a href="index.php?action=postsManager">Gestion des billets</a></li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php?action=newPost') !== false) {echo 'class="active"';} ?>><a href="index.php?action=newPost">Nouveau billet</a></li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php?action=commentsModeration') !== false) {echo 'class="active"';} ?>><a href="index.php?action=commentsModeration">Modérer les commentaires</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php?action=logOut') !== false) {echo 'class="active"';} ?> title="Déconnexion"><a href="index.php?action=logOut"><span class="fa fa-user-times"></span><span class="sr-only">(current)</span></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>

<div class="admin-container">
    <div class="container" id="top">
        <div class="row">
            <div class="col-lg-12 admin-name-col">
                <h4 id="admin-name">Bonjour <?= $_SESSION['name']; ?> !</h4>
            </div>
        </div>
        <?= $content ?>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" id="admin-footer">
            <footer>
                <p id="p-top"><a href="#top"><i class="fa fa-arrow-up fa-3x" aria-hidden="true" title="Remonter"></i></a></p>
                <p class="copyright text-muted">
                    2018 Copyright &copy; Jean Forteroche<br>
                    Dernière connexion le <?= date('d/m/Y à H:i:s', $_SESSION['time']); ?>
                </p>
            </footer>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?= ASSETS ?>js/jquery/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="<?= ASSETS ?>js/cookies.js"></script>
<script src="<?= ASSETS ?>js/nav.js"></script>
<noscript>
    <p>Attention :<br>
        Afin de pouvoir utiliser notre site, JavaScript doit être activé.
    </p>
</noscript>

</body>
</html>