<?php
require "master/site_stats.php";
$eventId = $_GET["eventId"];
require "Actions.php";
$event = getEventDetails($eventId);
$user_id = $_SESSION["user_id"];
$auth = $_SESSION["authenticated"];
echo "<input type='hidden' value='$auth' id='auth'>";
echo "<input type='hidden' value='$eventId' id='event_id'>";
$rating = getRating($eventId);
$stars = getUserRating($eventId);
$organiser = getOrganisersGroupInfo([$event["org_id"]])[0];
?>
<html>
<head>
    <link href="css/event.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<input type = "hidden" id="star-value" value="<?php echo isset($stars)?$stars:0;?>">
<?php include "master/header.php"; if(!isset($eventId) || $eventId == ""){die;}?>
<div class="row" style="height: 100vh!important;">
    <div class="col-md-5" style="border-right: 2px dotted black;">
        <div id="rating">
            <span class="fa fa-star" onmouseover="colorStar(1);" onclick="rate(1)" id="s1"></span>
            <span class="fa fa-star" onmouseover="colorStar(2);" onclick="rate(2)" id="s2"></span>
            <span class="fa fa-star" onmouseover="colorStar(3);" onclick="rate(3)" id="s3"></span>
            <span class="fa fa-star" onmouseover="colorStar(4);" onclick="rate(4)" id="s4"></span>
            <span class="fa fa-star" onmouseover="colorStar(5);" onclick="rate(5)" id="s5"></span>
        </div>
        <?php if($rating["rating"] > 0){ ?>
        <div class="text-dark" id="set" style="text-align: center">
            <span id="stars-total"><?php echo $rating["rating"];?></span>/<span style="color:darkgoldenrod">5</span><span> from reviews</span>
        </div>
        <?php } ?>

        <div id="image-container"></div>

    </div>
    <div class="col-md-7" style=" background: lightgray;">
        <h2 style="text-align: center;color:white;"><?php echo $event["name"];?></h2>
        <br>
        <h3 style="margin-left: 2%;color:green">
            <?php echo ($event["price"] != 0)?$event["price"]."$/ticket":"Free"; ?>
            <br>
            <span style="color:black;margin-left: 0%">by <a href="#">  <?php if($event["org_id"] == 1){echo "Us";} else{echo $organiser["name"];} ?></a></span>
        </h3>
        <br>
        <br>
        <div class="row" ><div class="col-md-12" id="description"><?php echo $event["desc"];?></div></div>
        <div class="row">
            <div class="col-md-12" id="location"><?php echo $event["country"].", ".$event["city"];?></div>
            <div class="col-md-12" > Starting : <a href="#"> <?php echo $event["start_date"];?></a></div>
            <div class="col-md-12" > Ending : <a href="#"><?php echo $event["end_date"];?></a></div>
        </div>


        <div class="comments">
            <?php include "comments.php";?>
        </div>
    </div>
</div>
</body>
</html>
<script src="js/event.js"></script>
<script>
    getMainPhoto(<?php echo $event["main_photo"];?>);
    <?php if(isset($stars)){echo "colorStar($stars);";}?>
</script>
