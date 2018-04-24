<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="language" content="fr">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=2">

    <title>Blog de Jean Forteroche, écrivain</title>

    <meta name="description" content="">
    <meta name="robots" content="index, follow, noarchive">
    <meta name="copyright" content="Déborah Maitrejean">

    <link href="<?= ASSETS ?>css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/style.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="frontend">
<header id="frontend-header">
    <div class="container-fluid">
        <h1>Billet simple pour l'Alaska</h1>
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
            <a class="navbar-brand" href="index.php">Billet simple pour l'Alaska</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php') !== false) {echo 'class="active"';} ?>><a href="index.php">Accueil</a></li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php?action=allPostsView') !== false) {echo 'class="active"';} ?>><a href="index.php?action=allPostsView">Tous les billets</a></li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php?action=about') !== false) {echo 'class="active"';} ?>><a href="index.php?action=about">A propos</a></li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php?action=contact') !== false) {echo 'class="active"';} ?>><a href="index.php?action=contact">Contact</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'index.php?action=adminConnexion') !== false) {echo 'class="active"';} ?>><a href="index.php?action=adminConnexion"><span class="fa fa-user"></span> Admin <span class="sr-only">(current)</span></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>

<div class="frontend-container">
    <div class="container" id="top">
        <?= $content ?>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto" id="footer">
            <footer>
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="https://twitter.com/D_Maitrejean" target="_blank">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://www.linkedin.com/in/d%C3%A9borah-maitrejean" target="_blank">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://github.com/deborah-maitrejean" target="_blank">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">2018 Copyright &copy; <a href="https://deborah-maitrejean.com" target="_blank">Déborah Maitrejean</a></p>
            </footer>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?= ASSETS ?>js/jquery/jquery.min.js"></script>
<!-- snow effect script -->
<script type="text/javascript" src="<?= ASSETS ?>js/snowstorm/script/snowstorm.js"></script>
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