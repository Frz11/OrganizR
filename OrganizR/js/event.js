function getMainPhoto(photoId){
    $.ajax({
        url:"Actions.php",
        data: {
            photoId: photoId,
            action: "getEventMainPhoto"
        },
        method:"POST",
        success: function(result){
            $("#image-container").append("<img src='/OrganizR/images/"+result+"' class='event-photo' >");
        }
    });
}
function colorStar(number){
    decolorAll();
    for(var i = 1;i <= number;i++){
        $("#s"+i).css("color","gold");
    }
}
function decolorAll(){
    $(".fa-star").css("color","gray");
}
function decolor(stars){
    for(var i = parseInt(stars)+1;i <= 5;i++) {
        $("#s"+i).css("color", "gray");
    }
    colorStar(stars);

}
$(".fa-star").mouseleave(function(){decolor($("#star-value").val())});

function rate(stars){
    if($("#auth").val() != "1"){
        swal({
            title: 'Error!',
            text:"You must be logged in in order to rate!",
            type: 'error'
        });
        return;
    }
    var event_id = $("#event_id").val();
    $.ajax({
        method:"post",
        url:"Actions.php",
        data:{
            stars: stars,
            event_id: event_id,
            action: "rate",
        },
        success: function () {
            location.reload();
        }
    })
}
function ratingColor(){
    var value = $("#stars-total").html();
    if(value != "undefined"){
        value = parseFloat(value);
        if(value <= 1.6){
            $("#stars-total").css("color","red");
        }else if(value >= 1.6 && value <= 3.2) {
            $("#stars-total").css("color","orange");
        } else {
            $("#stars-total").css("color","green");
        }
    }
}
ratingColor();