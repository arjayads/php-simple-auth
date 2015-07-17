<?php
require_once '_common.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Auth</title>
<head>
    <!-- Metas -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"     content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title>Skowars</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/images/favicon.png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Google fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,600,700' rel='stylesheet' type='text/css'>

    <!-- Head scripts -->
    <script src="js/vendor/modernizr.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

</head>

<body class=" pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="-webkit-transform: translate3d(100%, 0px, 0px); transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>
<div class="page-container">


    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">ucm</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="/">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <?php if (Session::isLoggedIn()) { ?>
                        <li><a href="/session.php?logout">Logout</a></li>
                    <?php } ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <?= $content ?>


</div> <!--/ #main-wrapper -->

<footer>
    <div class="footer">
        <div class="container">
        </div>
    </div>

    <div class="credits text-center">
        <p>Made with <i class="fa fa-heart"></i> from Cebu, Philippines.</p>
    </div>

</footer>


</body>

<body>
</body>
</html>