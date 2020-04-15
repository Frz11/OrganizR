<?php
/**
 * Created by PhpStorm.
 * User: cristianion
 * Date: 26/10/2018
 * Time: 15:39
 */
require "master/site_stats.php";
site_stats::pageView("Register.php");
?>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
    <script src="/OrganizR/js/register.js"></script>
</head>
<body>
<?php include "master/header.php"?>

<div class="row" style="padding: 2%;">
    <div class="col-md-5" id="left-pane">
        <div class="row">
            <div class="col-md-4" style="margin-left: 34%;"><h5>Sign Up</h5></div>
        </div>
        <form id="register-form" action="Actions.php">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" required name="username"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="pwd">Password</label>
                        <input type="password" class="form-control" name="pwd" id="pwd-register" required/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="confrim">Confirm password</label>
                        <input type="password" class="form-control" required name="confirm"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="Email" class="form-control" required name="email-register"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="birthday">Birtday</label>
                        <input type="date" name="birthday" required class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10" >
                    <button class="btn btn-primary" onclick="register(event)" style="margin-left: 40%;!important;"> Start!</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-7">
        <div class="row">
            <div class="col-md-12 align-content-center"><h1 id="main-text">OrganizR</h1></div>
            <div class="col-md-12" style="margin-top:5%;">
                <div id="description">
                        Imagine that you can see all the popular events taking place all over the globe! Or maybe
                        you don't like places full of crowds and want something more indie and peaceful. No matter
                        how your tastes are, OrganizR helps you discover new events and keep track of them. You can
                        also share those events or plans to your friends, to see who might be interested in them.
                        Stop searching in social media for the fun stuff, use OrganizR, be organised!
                        <br>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script>

</script>
