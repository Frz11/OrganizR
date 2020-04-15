<?php
include "master/header.php";
require_once "Actions.php";
require_once "master/site_stats.php";
site_stats::pageView("registerOrganiser.php");
echo "<input type='hidden' id='auth' value='$auth'>";
$users = getUsers();
?>
<style>
    .dropdown-toggle{
        height: 5vh!important;
    }
    .disclaimer{
        margin-top: 5%;
        font-size: 1.7em;
        border: 0px solid white;
        border-radius: 20px;
        background: gray;
        color:white;
        padding: 2%;
    }
</style>
<div class="row">
    <div class="col-md-5" >
    </div>
    <div class="col-md-7" style="border-left: 2px dotted black;min-height: 100vh">
        <h2 style="text-align: center">Create an Organiser Group!</h2>
        <br>
        <br>
        <div class="row">
            <div class="col-md-11">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" placeholder="Type..." name="description"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <div class="form-group">
                    <label >Add members</label>
                    <select name="members" class="selectpicker form-control" id="members" multiple data-live-search="true" data-live-search-placeholder="Search users...">
                        <?php foreach ($users as $user){ ?>
                            <?php if($user["id"] != $_SESSION["user_id"]){ ?>
                            <option value="<?php echo $user['id'];?>"><?php echo $user["username"];?></option>

                        <?php }}?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3" style="margin:auto!important;">
                <button class="btn btn-dark" id="register-btn">Register</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <div class="disclaimer">
                    Disclaimer: You can add/remove other members after you create the Group, don't worry! :)
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script src="js/registerOrg.js"></script>