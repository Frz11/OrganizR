<?php

/**
 * Created by PhpStorm.
 * User: cristianion
 * Date: 25/10/2018
 * Time: 12:56
 */
session_start();
$auth = false;
if($_SESSION["authenticated"] == true){
    $auth = true;
}?>
<script src="/OrganizR/js/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="/OrganizR/css/bootstrap.min.css">
<link rel="stylesheet" href="OrganizR/css/bootstrap.min.css.map">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="/OrganizR/js/bootstrap.min.js"></script>
<script src="/OrganizR/js/header.js"></script>
<script src="js/sweetalert2.min.js"></script>
<link rel="stylesheet" href="css/sweetalert2.min.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/OrganizR/OrganizR.php"><img src="/OrganizR/images/logo.png" width="30" height="30"/> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="/OrganizR/events.php">Events</a>
            <a class="nav-item nav-link" href="/OrganizR/registerOrganiser.php">Become an organiser!</a>
            <a class="nav-item nav-link" href="/OrganizR/Contact.php" style="margin-left: 68vw;">Contact</a>
            <?php if($auth === true) {
                echo '<a class="nav-item nav-link" href="/OrganizR/Profile.php">Profile</a>';
            } else {
                echo '<a class="nav-item nav-link" onclick="openLogin()">Log In</a>';
            }
            ?>
        </div>
    </div>
</nav>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Log In</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-12"><label for="email">Email:</label></div>
                            <div class="col-md-12"><input required class="form-control" type="text" name="email" id="email"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><label for="pwd">Password:</label></div>
                            <div class="col-md-12"><input required class="form-control" type="password" name="pwd" id="pwd"></div>
                        </div>
                        <div class="row" style="margin-top: 25px;!important;">
                            <div class="col-md-4" style="margin-left:40%"><button class="btn btn-light" onclick="logIn(event)">Log In</button></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align:center!important;">
                                <span >Don't have an account? <a href="/OrganizR/Register.php">Register!</a></span>
                            </div>
                        </div>
                    </form>
            </div>
        </div>

    </div>
</div>
<script>
    function openLogin() {
        $("#myModal").modal();
    }
</script>