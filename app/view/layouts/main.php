<?php
    if (!isset($_SESSION['email']) && !isset($_SESSION['password'])){
        redirected(base_url());
    }
    else{
        $user = $_SESSION['user'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.12.0/d3.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/css/home.css" type="text/css">
    <link rel="stylesheet" href="/css/other_user.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body style="background: #dbdbdb;     font-family: 'Raleway', sans-serif;">
<nav class="navbar navbar-expand-lg navbar-dark bg-danger  p-0" id="mainNav">
    <div class="container">
        <a class="navbar-brand d-sm-block d-xs-block js-scroll-trigger m-auto mr-md-3 mr-lg-3" href="/user/home">
            <img src="/images/logo.png" alt="">
        </a>
        <div class="mr-auto d-sm-block d-xs-block">
            <div class="input-group">
                <input type="text" class="form-control search_text" name="search_text" id="search_text" value="" placeholder="Search...">
                <div class="input-group-append">
                    <button class="btn btn-light border" type="button">
                        <i class="fa fa-search text-danger" id="searchIcon"></i>
                        <div id="loading">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                    </button>

                </div>
                <div id="result" class="resultSearch" style=" background: white; width: 220px; position: absolute; top: 45px;  z-index: 1"></div>

            </div>
        </div>
        <div class="nav-item dropdown d-md-none d-lg-none d-sm-block d-xs-block">
            <a class="nav-link js-scroll-trigger" href="#" id="suser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="d-inline rounded-circle"  width="50" height="50" src="<?= $user['user_dir']. $user['image']?>" alt="">
                <p class="d-inline text-white"><?= $user['name']?> </p>
            </a>
            <div class="dropdown-menu" aria-labelledby="suser">
                    <a class="dropdown-item" href="/user/myPage">View my account</a>
                    <a class="dropdown-item" href="#">Account Settings</a>
                    <a class="dropdown-item" href="#">Privacy</a>
            </div>
        </div>

        <button class="navbar-toggler collapsed" id="main" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" id="hamburger" onclick="openNav()"></span>
        </button>
        <div class="navbar-collapse collapse pt-2">
            <ul class="navbar-nav text-center ml-auto navlinks">
                <li class="nav-item ">
                    <a class="nav-link js-scroll-trigger" href="/user/home">
                        <i class="fas fa-home text-white">
                            <p>Home</p>
                        </i>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link js-scroll-trigger" href="/profiles/profiles" id="profiles" role="button">
                        <i class="fas fa-users text-white">
                            <p>Profiles</p>
                        </i>
                    </a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  js-scroll-trigger" href="#" id="user" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="d-inline rounded-circle" width="50" height="50" src="<?="{$user['user_dir']}{$user['image']}"?>" alt="">
                        <p class="d-inline text-white"><?= $user['name']?></p>

                    </a>
                    <div class="dropdown-menu p-0" aria-labelledby="user">
                        <div class="settings border-top bg-danger text-white p-2">
                            <h6>Settings</h6>
                        </div>
                        <div class="setings-menu border-top pt-2 pb-2">
                            <a class="dropdown-item" href="/user/myPage">View my account</a>
                            <a class="dropdown-item" href="#">Account Settings</a>
                            <a class="dropdown-item" href="#">Privacy</a>
                        </div>
                        <div class="border-top text-center bg-danger  p-2">
                            <a href="/main/logout" class="text-white text-decoration-none">Log out</a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
        <div class="navbar-collapse  sidenav bg-danger text-white" id="mySidenav">
            <ul class="navbar-nav ml-auto pl-5">
                <li class="nav-item">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/user/home">
                        <i class="fas fa-home">
                            Home
                        </i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  js-scroll-trigger" href="/profiles/profiles">
                        <i class="fas fa-users">
                            Profiles
                        </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  js-scroll-trigger" href="/user/myPage" >
                        <i class="fas fa-user">
                            My Profile
                        </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  js-scroll-trigger" href="/user/messages" >
                        <i class="fas fa-envelope">
                            Messages
                        </i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  js-scroll-trigger" href="/main/logout" >
                        <i class="fas fa-sign-out-alt">
                            Log out
                        </i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!------main content-->
<?= $content ?>
<!------end main content-->
<footer>
    <script src="/js/chat.js"></script>
    <script src="/js/home.js"></script>
    <script src="/js/script.js"></script>
    <script src="/js/changeImage.js"></script>
    <script src="/js/search.js"></script>
    <script src="/js/posts.js"></script>
</footer>
</body>

</html>