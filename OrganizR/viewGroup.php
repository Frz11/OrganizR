<?php
require "master/site_stats.php";
include "master/header.php";
require_once "Actions.php";
$users = getUsers();
$id = $_GET["id"];
$group = (sizeof($group = getOrganisersGroupInfo(array($id))) > 0)? $group[0]:null;
if($group == null){die("Error: That organiser wasn't found...");}
if(!checkGroupAccess($_SESSION["user_id"],$id)) {
    die("You are not a member of this group!");
}
$members = getGroupMembers($id);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script src="js/viewGroup.js"></script>
<br>
<input type="hidden" value="<?php echo $id;?>" id="group_id"/>
<div class="row">
    <div class="col-md-12">
        <h2 style="text-align: center">View<?php if(checkIfGroupOwner($_SESSION["user_id"],$group["admin_id"])) {?>/Edit<?php }?> Group</h2>
    </div>
    <br><br><br><br>
</div>
<div class="row" style="padding-left:15%;padding-right:15%;padding-top:5%;">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Name:</label>
            <input name ="name" class="form-control" id="name" value="<?php echo $group['name'];?>">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="description:">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="5"><?php echo $group["description"];?></textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="members">Members:</label>
            <select name="members" class="selectpicker form-control" id="members" multiple data-live-search="true" data-live-search-placeholder="Search users...">
            <?php foreach ($users as $user){ ?>
                        <option value="<?php echo $user['id'];?>"<?php if(in_array($user["id"],$members)){echo "selected";}?>><?php echo $user["username"];?></option>

                    <?php }?>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <button class="btn btn-info" style="width:10%;float:right!important;" onclick="updateGroup(event)">Save</button>
    </div>
</div>
