<?php
include "master/header.php";
require_once "Actions.php";
$groups = getOrganisersGroupInfo(getGroups($_SESSION["user_id"]));
if(sizeof($groups) == 0){
    echo "You are not an organiser!";
    die();
}
?>

<link href="css/addEvent.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="js/addEvent.js"></script>
<div class="row" style="padding:2%">
    <div class="col-md-6">
        <div class="data">
            <h2>Add New Event</h2>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Event Name</label>
                        <input class="form-control" name="name" id="name" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Event country</label>
                        <input type="text" class="form-control" id="country" name="country"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">Event city</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="price">Price($)</label>
                        <input type="number" name="price" id="price" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Start date</label>
                        <input type="text" class="form-control datetime" id="start_date" name="start_date" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end_date">End date</label>
                        <input type="text" class="form-control datetime" id="end_date" name="end_date" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="organiser_id">Organiser Group</label>
                        <select class="form-control selectpicker" data-live-search="true" data-placeholder="Search groups..." name="organiser_id" id="organiser_id" >
                            <option></option>
                            <?php foreach ($groups as $group){ ?>
                                <option value="<?php echo $group['id'];?>"><?php echo $group["name"];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="info">
                        Upload your photo before saving your event! Otherwise edit your event to change the main photo!
                    </div>
                </div>
            </div>
            <input type="hidden" name="mainphoto" id="mainphoto">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-info" onclick="addEvent()">Add Event</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="data">
            <h2>Photos</h2>
            <br>
            <br>
            <br>
            <div class="content" style="padding:7%;">
                <div class="form-group righter" id="upload-photo">
                    <a onclick="uploadPhoto(event)"><image src="images/detalhes.png" id="photo-click" width="450" ></image></a>
                    <input type="file" name="photo" id="photo"/>
                </div>
                <div id="view-photo" style="display: none;" class="righter">
                    <div class="img">
                        <button class="btn btn-light" id="delPhotoBtn" onclick="deletePhoto()">x</button>
                        <img id="view-photo-src" alt="error" width="450" style="border-radius:15px"/>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>

</script>