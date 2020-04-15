<?php
$org = false;
/**
 * Created by PhpStorm.
 * User: cristianion
 * Date: 13/11/2018
 * Time: 15:15
 */
require "master/site_stats.php";
require_once "Actions.php";
site_stats::pageView("Events.php");
if(checkIfOrganiser()){
    $org = true;
}
$external = getExternalEvents();
?>
<html>
<head>
    <title>Events</title>
    <link rel="stylesheet" href="css/events.css">
</head>
<body>
<?php include "master/header.php"?>
<div id="content">
    <?php if($org){?>
        <div class="row">
            <div class="col-md-12" style="float:right">
                <a href="addEvent.php"><button class="btn btn-outline-primary pull-right" style="margin-left: 25%;width: 50%;">ADD NEW EVENT</button></a>
            </div>
        </div>
    <?}?>

</div>
<div id="loading">
    Loading...
</div>
<div class="external">
    <h3>Events from <a href="http://www.events.ro">events.ro</a></h3>
    <?php for($i = 0;$i < sizeof($external["events"]);$i++){
       if($i % 4 == 0){
           if($i != 0) echo "</div>";
           echo "<div class='row row-external'>";
       }
       echo "<div class='col-md-3''><a href='".$external['links'][$i]."'>".$external['events'][$i]."</a></div>";

    }?>
</div>
</body>
</html>
<script src="js/events.js"></script>
<script>
    getEvents();
</script>
<style>
    .external{
        padding: 3%;
        margin-top:10vh;
        background-color: whitesmoke;
        border-top:10px solid gray;
    }
    .row-external{
        margin-top:10vh;
    }
</style>