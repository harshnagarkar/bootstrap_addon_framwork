<?php
/**
 * Created by PhpStorm.
 * User: bedro
 * Date: 3/14/2018
 * Time: 7:18 PM
 */
include($_SERVER['DOCUMENT_ROOT']."/header.php");
include($_SERVER['DOCUMENT_ROOT']."/functions.php");

?>
<html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin Template for Bootstrap</title>
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="./dashboard/index.php" method="post">
    <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="passwd" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <!--<label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>-->
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
</body>
</html>


</html>