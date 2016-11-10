<?php

include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

sec_session_start();
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
    
   
    <div class="container">
        <?php if (login_check($mysqli) == true) : ?>
            <div class="row" style="text-align: right">
            <br>
            <br>
        <p>Welcome <?php echo htmlentities($_SESSION['username']); ?>!</p>
        </div>
        <div class="row" style="text-align: center">
        <H1 style="text-align: center">ジャコス　JCSシステム</H1>
        <br>
        </div>
        <div class="row">
            <p class="round-textarea">
                メンテナンスのお知らせ<br>
                ２０１６年１０月１日AM１：００から２：００の時間帯でメンテナンスを行います。
            </p>
            </div>
            <div class="row">
            <br><br><br>
            <div class='col-xs-12 button-wrapper'>
            <button type="button" class="btn btn-primary">確定ピッキング</button><br>
            <button type="button" class="btn btn-primary">手書き入力</button><br>
            <button type="button" class="btn btn-primary">データ出力</button><br>
            <button type="button" class="btn btn-primary">請求業務</button><br>
            <br><br><br>
            <a href="index.php"  class="btn btn-primary" role="button">ログアウト</a><br>
            </div>
            </div>
        <?php else : ?>
            <div class="row">
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
            </div>
        <?php endif; ?>
        </div>
    </body>
</html>
