<?php
include_once "master/header.php";
require_once "Actions.php";
if(!$_SESSION["authenticated"]) {
    die("Log in first!");
}

$Result = getProfile();
$user = $Result["user"];
$groups = getOrganisersGroupInfo(getGroups($_SESSION["user_id"]));
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="js/Profile.js"></script>
<div class="row">
    <div class="col-md-6" style="padding: 3%;">
        <div class="row" style="text-align: center">
            <div class="col-md-12">
                <h2>Profile Info</h2>
            </div>
        </div>
            <div class="row">
                <div class="content" style="padding:7%;margin-left:28%;">
                    <div class="form-group righter" id="upload-photo" style="border:2px solid gray;border-radius: 10px;">
                        <a onclick="uploadPhoto(event)"><image src="<?php echo $user['profile_photo'];?> " id="photo-click" width="200" ></image></a>
                        <input type="file" name="photo" id="photo" style="display:none"/>
                        <button class="btn btn-success" style="float:left;position:absolute;margin-left: 8%;" onclick="changeProfilePicture()">Change</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="uname">Username</label>
                    <input disabled="true" type="text" required id="uname" value="<?php echo $user["uname"]; ?>" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="pwd">Password</label>
                    <input type="password" id="pwd-new"  required value="<?php echo $user["pwd"];?>" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="email">Email</label>
                    <input type="text" id="email" required value="<?php echo $user["email"];?>" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="birthday">Birthday</label>
                    <input type="date" name="birthday" required class="form-control" value="<?php echo $user["birthday"];?>">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-outline-primary" style="margin-left: 25%;">Save Changes</button>
                    <button class="btn btn-danger" onclick="logOut(event)">Log out</button>
                </div>
            </div>

    </div>
    <?php if(sizeof($groups) == 0) {?>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-10" style="padding:10%;margin-left: 10%;margin-top:30vh;border:3px solid gray;border-radius:15px;">
                <span>You currently aren't a member of any organiser group!</span>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="col-md-6" style="margin-top: 7vh;border-left: 2px dotted red;">
        <div class="row" style="text-align: center">
            <div class="col-md-12">
                <h2 style="text-align: center">Organizer Groups</h2>
            </div>
        </div>
        <div style="margin-top:3.6vh">
            <?php foreach ($groups as $group) {?>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" disabled="disabled" style="text-align: center" class="form-control" value="<?php echo $group["name"];?>">
                    </div>
                    <div class="col-md-1" style="margin-right: 2%;">
                        <a href="orgEvents.php?id=<?php echo $group['id'];?>"><button class="btn btn-dark">Events</button></a>
                    </div>
                    <div class="col-md-1">
                        <a href="viewGroup.php?id=<?php echo $group['id'];?>"> <button class="btn btn-info">View</button></a>
                    </div>

                    <?php if($group["admin_id"] == $_SESSION["user_id"]){?>
                        <div class="col-md-3">
                            <button class="btn btn-light" disabled>Owner</button>
                        </div>
                    <?php } else { ?>
                        <div class="col-md-3">
                            <button class="btn btn-danger" disabled>Member</button>
                        </div>
                    <?php }?>
                </div>
                <br>
            <?php }?>
        </div>
    </div>
    <?php }?>
</div>
