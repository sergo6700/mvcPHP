<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/d3js/5.12.0/d3.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/reg.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v5.0&appId=459818937961931&autoLogAppEvents=1"></script>
</head>

<body class="sign-in">
<div class="container-fluid d-flex align-items-center justify-content-center  ">
    <div class="row sign-up-form ">
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 right-contents border-right">
            <img class="ml-5" src="/images/cm-logo.png" alt="">
            <p class="ml-5">Workwise, is a global freelancing platform and social networking where businesses and independent professionals connect and collaborate remotely</p>
            <img src="/images/cm-main-img.png" class="d-none d-sm-none d-md-block " alt="">
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 p-5 ">
            <ul class="nav nav-tabs float-right" role="tablist">
                <li class="nav-item bg-danger rounded">
                    <a class="nav-link active text-primary" href="#signin" role="tab" data-toggle="tab">Sign In</a>
                </li>
                <li class="nav-item bg-danger rounded">
                    <a class="nav-link text-primary" href="#signup" role="tab" data-toggle="tab">Sign Up</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content mt-3 ">
                <div role="tabpanel" class="tab-pane signin-panel active" id="signin">
                    <form action="main/login" id="login_form" method="post">
                        <h4 class="text-danger">Sign in</h4>
                        <hr>
                        <?php if (isset($_SESSION['email_success']) && !is_null($_SESSION['email_success'])){?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['email_success'] ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php }else{echo '';} ?>
                        <?php if (isset($_SESSION['login_error']) && !is_null($_SESSION['login_error'])){?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['login_error'] ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php }else{echo '';} ?>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" id="loginEmail" class="form-control" placeholder="Email address" type="email">
                        </div>
                        <div id="logEmailErr"></div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control" id="loginPass" name="password" placeholder="Create password" type="password">
                        </div> <!-- form-group// -->
                        <div id="logPassErr"></div>
                        <div class="form-group form-check chekc">
                            <label class="form-check-label ml-3">
                                <input class="form-check-input" type="checkbox"> Remember me
                            </label>
                            <a href="" class="ml-5">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                    <h6 class="m-3">LOGIN VIA SOCIAL ACCOUNT</h6>
                    <a href="" class="btn btn-primary d-block mt-2"><i class="fa fa-facebook"></i>    Facebook</a>
                    <a href="" class="btn btn-primary d-block mt-2"><i class="fa fa-twitter"></i>    Twitter</a>
                    <a href="" class="btn btn-danger d-block mt-2"><i class="fa fa-google"></i>    Google</a>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="signup">
                    <h4 class="text-danger">Sign Up</h4>
                    <hr>
                    <?php if (isset($_SESSION['registration_error']) && !is_null($_SESSION['registration_error'])){?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong><?= $_SESSION['registration_error'] ?></strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                          </button>
                    </div>
                    <?php }else{echo '';} ?>
                    <form  action="main/registration" method="post" id="reg_form" enctype="multipart/form-data">
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="name" class="form-control"  id="name" placeholder="Full name" type="text">
                        </div> <!-- form-group// -->
                        <div id="nameerr">
<!--                            error message for name-->
                        </div>
                        <?php if (isset($_SESSION['file_upload_error']) && !is_null($_SESSION['file_upload_error'])){?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['file_upload_error'] ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php }else{echo '';} ?>

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="fileToUpload" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
<!--                        <div class="input-group">-->
<!--                            <div class="input-group-prepend">-->
<!--                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>-->
<!--                            </div>-->
<!--                            <div class="custom-file">-->
<!--                                <input type="file" name="fileToUpload" class="custom-file-input" id="inputGroupFile01"   aria-describedby="inputGroupFileAddon01">-->
<!--                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>-->
<!--                            </div>-->
<!--                        </div>-->
                        <div id="uploaderr">

                        </div>
                        <?php if (isset($_SESSION['email_error']) && !is_null($_SESSION['email_error'])){?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?= $_SESSION['email_error'] ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php }else{echo '';} ?>
                        <div class="form-group input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input name="email" class="form-control" id="email" placeholder="Email address" type="email">
                        </div> <!-- form-group// -->
                        <div id="emailerr">

                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                            </div>
                            <select name="tel" class="custom-select" style="max-width: 120px;">
                                <option selected="">+374</option>
                                <option value="1">+972</option>
                                <option value="2">+198</option>
                                <option value="3">+701</option>
                            </select>
                            <input name="number" class="form-control"  id="phone" placeholder="Phone number" type="text">
                        </div> <!-- form-group// -->
                        <div id="phoneerr">

                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control" name="pass"  id="pass" placeholder="Create password" type="password">
                        </div> <!-- form-group// -->
                        <div id="passerr">

                        </div>
                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input class="form-control" name="pass2"  id="pass2" placeholder="Repeat password" type="password">
                        </div> <!-- form-group// -->

                        <div class="form-group">
                            <input type="submit" name="submit"  class="btn btn-primary btn-block" value="Create Account">
                        </div> <!-- form-group// -->
                    </form>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/reg.js"></script>
</body>

</html>