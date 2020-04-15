<?php
if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == ""){
    echo "Session expired! Please Log in again!";
    sleep(3);
    header("Location:home.php");
}