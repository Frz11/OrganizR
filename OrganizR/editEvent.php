<?php
include_once "master/header.php";
require_once "Actions.php";
$event = getEventDetails($_GET["id"]);
$groups = getOrganisersGroupInfo(getGroups($_SESSION["user_id"]));
if(!checkGroupAccess($_SESSION["user_id"],$event["org_id"])){
    die("No access!");
}
$photo = getPhoto($event["main_photo"]);
?>
<link href="css/addEvent.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="row" style="padding:2%">
    <div class="col-md-6">
        <div class="data">
            <h2>Edit <?=$event["name"];?></h2>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="name">Event Name</label>
                        <input class="form-control" name="name" id="name" type="text" value="<?=$event['name'];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="5" id="description" name="description"><?=$event["desc"];?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">Event country</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?=$event['country'];?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">Event city</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?=$event['city'];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="price">Price($)</label>
                        <input type="number" name="price" id="price" class="form-control" value="<?=$event['price'];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="start_date">Start date</label>
                        <input type="text" class="form-control datetime" id="start_date" name="start_date" value="<?=$event['start_date'];?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="end_date">End date</label>
                        <input type="text" class="form-control datetime" id="end_date" name="end_date" value="<?=$event['end_date'];?>"/>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="organiser_id">Organiser Group</label>
                        <select class="form-control selectpicker" data-live-search="true" data-placeholder="Search groups..." name="organiser_id" id="organiser_id" >
                            <option></option>
                            <?php foreach ($groups as $group){ ?>
                                <option value="<?php echo $group['id'];?>" <?=($group['id'] == $event['org_id'])?"selected":'';?>><?php echo $group["name"];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="mainphoto" id="mainphoto" value="<?=$event["main_photo"];?>">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-info" onclick="editEvent()">Save Event</button>
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
            <?php if($event["main_photo"] != 0){?>
                <div class="content" style="padding:7%;">
                    <div class="form-group righter" id="upload-photo" style="display: none">
                        <a onclick="uploadPhoto(event)"><image src="images/detalhes.png" id="photo-click" width="450" ></image></a>
                        <input type="file" name="photo" id="photo" value="<?=$event['main_photo'];?>"/>
                    </div>
                    <div id="view-photo" class="righter">
                        <div class="img">
                            <button class="btn btn-light" id="delPhotoBtn" onclick="deletePhoto()">x</button>
                            <img id="view-photo-src" src="images/<?=$photo;?>" alt="error" width="450" style="border-radius:15px"/>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
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
            <?php } ?>
        </div>
    </div>
</div>
<script>
    function editEvent(){
        var ev_id = <?=$_GET["id"];?>;
        var name = $("#name").val();
        var descr = $("#description").val();
        var country = $("#country").val();
        var city = $("#city").val();
        var price = $("#price").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var mainphoto = $("#mainphoto").val();
        var org_id = $("#organiser_id").val();
        $.ajax({
            url:"Actions.php",
            type:"post",
            data:{
                action:"editEvent",
                id:ev_id,
                name:name,
                description:descr,
                country:country,
                city: city,
                price: price,
                start_date: start_date,
                end_date: end_date,
                organiser_id: org_id,
                mainphoto: mainphoto
            } ,
            success: function (result) {
                result = JSON.parse(result);
                if(result.ok){

                    location.reload();

                } else {
                    swal({
                        title:"Error!",
                        text:result.error,
                        type:"error"
                    });
                }
            } ,
            error: function () {
                swal({
                    title:"Error!",
                    text:"Something went wrong!",
                    type:"error"
                });
            }
        });
    }
    function deletePhoto(){
        var id = $("#mainphoto").val();
        $.ajax({
            url: "Actions.php",
            type:"post",
            data:{
                id: id,
                action: "deletePhoto"
            } ,
            success: function () {
                $("#mainphoto").val("");
                $("#view-photo").css("display","none");
                $("#upload-photo").css("display","block");
            }

        });
    }
    function uploadPhoto(e){
        e.preventDefault();
        $("#photo").click();

    }
    $(document).ready(function(){
        $(".datetime").flatpickr({enableTime: true});
        $("#photo").change(function(){
            var file_data = $("#photo").prop('files')[0];
            var form_data = new FormData();
            form_data.append('file',file_data);
            form_data.append('action','uploadPhoto');
            $.ajax({
                url: "actions.php",
                type:"post",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result){
                    result = JSON.parse(result);
                    if(result.ok){
                        $("#mainphoto").val(result.photo_id);
                        $("#upload-photo").css("display","none");
                        $("#view-photo").css("display","block");
                        $("#view-photo-src").attr("src",result.location);
                    } else {
                        swal({
                            title:"Error!",
                            text:result.error,
                            type:"error"
                        });
                        return;
                    }
                }

            });
        });
    });
</script>