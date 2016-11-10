<?php

include_once 'includes/db_connect.php';
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
$logged = 'in';
} else {
$logged = 'out';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>JCS: ログイン/レジスタ (Log In/Registration)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/main.css" />
        <script type="text/JavaScript" src="js/jquery-3.1.1.min.js"></script> 
        <script type="text/JavaScript" src="js/bootstrap.min.js" defer></script> 
        <script type="text/JavaScript" src="js/sha512.js" defer></script> 
        <script type="text/JavaScript" src="js/forms.js" defer></script>         
    </head>
    <body>

        <?php
        //page error message controlling
        $pagename='login';
        $status_login='<p>ログイン情報を入力します。<br>Enter login details</p>';
        $status_registration='<p>登録内容を入力してください<br>Enter registration details</p>';
        if(isset($_GET['page'])){
            $pagename=$_GET['page'];
        }
        //known issue
        if($pagename=='login'){
            //when error
        if (isset($_GET['error'])) {
        $status_login= '<p class="error">'.$_GET['error'].'!</p>';
        }
        //when success
        else if (isset($_GET['success'])) {
        $status_login= '<p class="success">'.$_GET['success'].'</p>';
        }
    }
    else if($pagename=='register'){
        //when error
        if (isset($_GET['error'])) {
             $status_registration= '<p class="error">'.$_GET['error'].'!</p>';
        }
        //when success
       else if (isset($_GET['success'])) {
        $status_registration= '<p class="success">'.$_GET['success'].'</p>';
        }
    }
        ?> 
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                <H1 style="text-align: center">ジャコス　JCSシステム</H1>
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="#" class="active" id="login-form-link">ログイン (Login)</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="#" id="register-form-link">登録 (Register)</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="login-form" name="login_form" action="includes/process_login.php" method="post" role="form" style="display: block;">
                                        <div class="form-group">


                                            <label id="login-status"><?php echo $status_login; ?></label>

                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="login_email" id="login_email" tabindex="1" class="form-control" placeholder="Eメール (Email)" value="" required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="login_password" id="login_password" tabindex="2" class="form-control" placeholder="パスワード (Password)" required="">
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                            <label for="remember"> 私を覚えてますか (Remember Me)</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="button" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="ログイン (Login)"  onclick="formhash(event, this.form, this.form.login_password);">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    <form id="register-form" name="registration_form" action="includes/register.inc.php" method="post" role="form" style="display: none;">
                                        <div class="form-group">


                                            <label id="register-status"><?php echo $status_registration; ?></label>

                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="ユーザ名 (User Name)" value="" required="" title="Usernames may contain only digits, upper and lower case letters and underscores">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" tabindex="2" class="form-control" placeholder="Eメール (Email Address)" value="" required="" title="Emails must have a valid email format">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="3" class="form-control" placeholder="パスワード (Password)" required="" title="Passwords must be at least 6 characters long
                                                   Passwords must contain
                                                   1. At least one upper case letter (A..Z)
                                                   2. At least one lower case letter (a..z)
                                                   3. At least one number (0..9)                
                                                   Your password and confirmation must match exactly">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirm_password" id="confirm-password" tabindex="4" class="form-control" placeholder="パスワードを認証する (Confirm Password)" required="" title="Your password and confirmation must match exactly">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="button" name="register-submit" id="register-submit" tabindex="5" class="form-control btn btn-register" value="今すぐ登録 (Register Now)" onclick="return regformhash(this.form,
                                                            this.form.username,
                                                            this.form.email,
                                                            this.form.password,
                                                            this.form.confirm_password);">
                                                </div>

                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/JavaScript" defer>
        
     $(function () {

            //controlling page view  
            var openedPage = '<?php echo $pagename; ?>';           
             //alert(openedPage)
        if (openedPage === 'register') {
            $("#register-form").css("display", "block");
            $("#login-form").css("display", "none");
            $('#login-form-link').removeClass('active');
            $('#register-form-link').addClass('active');
        } else if (openedPage === 'login' || openedPage === "") {
            $("#register-form").css("display", "none");
            $("#login-form").css("display", "block");
            $('#register-form-link').removeClass('active');
            $('#login-form-link').addClass('active');
        }

            $('#login-form-link').click(function (e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#register-form-link').click(function (e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });

            $('.forgot-password').click(function () {
                //alert('hello');
            })

        });
        </script>
    </body>
</html>
