<?php
/**
 * Created by PhpStorm.
 * User: cristianion
 * Date: 21/12/2018
 * Time: 15:02
 */

include_once "master/header.php";
require_once "Actions.php";
if(!checkGroupAccess($_SESSION["user_id"],$_GET["id"])){
    die("No access!");
}
$events = getOrganiserEvents($_GET["id"]);
?>
<br>
<br>
<div class="row">
    <div class="col-md-11">
        <h2 style="text-align: center">Events</h2>
    </div>
</div>
<hr>
<div style="padding-left: 12%;">
    
<?php foreach ($events as $event){ ?>
    <div class="row">
        <div class="col-md-9">
            <input type="text" class="form-control" disabled value="<?=$event['name'];?>"/>
        </div>
        <div class="col-xs-1"><a href="editEvent.php?id=<?=$event['id'];?>"><button class="btn btn-info">Edit</button></a></div>
        <div class="col-md-1"><button class="btn btn-danger" onclick="deleteEv(<?=$event['id'];?>)">Delete</button></div>
    </div>
    <br>
<?php } ?>
</div>
<script>
    function deleteEv(id){
        if(confirm("Are you sure you want to delete this event?")){
            $.ajax({
                url:"Actions.php",
                type:"post",
                data:{
                    action:"deleteEvent",
                    id:id,
                    org_id:<?=$_GET["id"]?>
                },
                success: function(){
                    location.reload();
                }
            });
        }
    }
</script>

