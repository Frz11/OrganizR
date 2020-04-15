<?php
$comments = getComments($eventId);
?>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h2 style="text-align: center">Comments</h2>
            </div>
        </div>
        <?php if($_SESSION["authenticated"]){ ?>
            <br><br>
            <div class="row">
                <div class="col-md-10">
                    <form action="Actions.php" method="post" id="comment-form">
                        <?php $user = getProfileInfo($_SESSION["user_id"]);?>
                        <input type="hidden" value="addComent" name="action"/>
                        <input type="hidden" value="<?php echo $eventId;?>" name="event_id" id="event_id"/>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Add comment..." rows="3" name="comment"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-md-2" style="margin-top: 3vh;">
                    <button class="btn btn-light" onclick="addComment()">ADD</button>
                </div>
            </div>
        <?php } ?>
        <?php if(empty($comments)){ ?>
        <div class="row">
            <div class="col-md-12" style="padding-top: 10vh;padding-left: 37%;font-size: 1.5em;color:slategray">
                No comments to show.
            </div>
        </div>
        <?php } else {?>
            <br>
            <br>
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($comments as $comment_id) {
                    $comment = getCommentInfo($comment_id);
                    $user = getProfileInfo($comment["user_id"]);?>
                    <div class="row">
                        <div class="col-md-3">
                            <div><?php echo $user["uname"];?></div>
                            <img src="images/<?php echo $user['photo'];?>" width="170" height="100">
                        </div>
                        <div class="col-md-8" style="padding:20px;margin-top:3vh;font-size: 1.2em;background: darkgray;border-radius:20px;margin-left: 0!important;">
                            <?php if(checkCommentsRights($eventId,$comment_id)){?>
                                <button onclick='deleteComment(<?php echo $comment_id;?>)' class="btn btn-danger btn-sm" style="float:right;">X</button>
                            <?php } ?>
                            <div style="color:white;"><?php echo $comment["comment"];?></div>
                            <button class="btn btn-dark" disabled><?php echo $comment["created_at"];?></button>

                        </div>
                    </div>
                    <hr>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<script>
    function addComment(){
        $("#comment-form").submit();
    }
    function deleteComment(id){
        if(confirm("Are you sure you want to delete this comment?")) {
            $.ajax({
                url: "Actions.php",
                type: "post",
                data: {
                    action: "deleteComment",
                    id: id
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.ok) {
                        location.reload();
                    } else {
                        swal({
                            title: "Error!",
                            text: result.error,
                            type: "error",
                        });
                    }
                }
            });
        }
    }
</script>