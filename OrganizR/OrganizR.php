<?php
session_start();
?>
<html>
<head>
    <title>Welcome!</title>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="row to-middle">
    <div class="col-md-2 text-center"><div id="main-text">OrganizR</div></div>
</div>
<div class="row" id="pannel-box" style="visibility: hidden;margin-top: 2%;">
    <div class="col-md-6">
        <a id="partyLink" style="text-decoration: none" href="home.php">
        <div  style="margin-left: 25%" class="image-card" id="party">
            <div class="text-center card-text">Attender</div>
        </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="registerOrganiser.php" style="text-decoration: none" id="organiseLink">
        <div style="margin-right: 25%" class="image-card" id="organise">
            <div class="text-center card-text">&nbsp;&nbsp;Organiser</div>
        </div>
        </a>
    </div>
</div>
</body>
</html>
<script>
    setTimeout(function(){$("#pannel-box").css("visibility","")},1450);
</script>
