function getEvents() {
    $.ajax({
       method: "POST",
       url: "Actions.php",
       data: {action : "getEvents"},
       success: function(response){
           $("#loading").hide();
           response = JSON.parse(response);
           eventsNo = response.events.length;
           events = response.events;
           var lines = 0;
           for(var i = 0;i < eventsNo;i++){
                console.log(events[i]);
                var content = $("#content");
                if(i % 4 === 0){
                    lines++;
                    content.append("<div class='row' id='line-"+lines+"'>");
                }
                $("#line-"+lines).append('<div class="col-md-3" id="event-'+i+'" title="'+events[i].name+'"><div class="title">'+events[i].name+'</div></div>');
                getMainPhoto(i,events[i].main_photo,events[i].id);
           }
        },
        error:function () {
            $("#loading").html("An error occured!");
        }
    });
}
function getMainPhoto(i,photoId,eventId){
    $.ajax({
        url:"Actions.php",
        data: {
            photoId: photoId,
            action: "getEventMainPhoto"
        },
        method:"POST",
        success: function(result){
            $("#event-"+i).append("<a href='Event.php?eventId="+eventId+"'><img src='/OrganizR/images/"+result+"' class='event-photo' width='324' height='218' ></a>");
           // $("#event-"+i).append('<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-html="true" title="<b>'+eventName+'</b>">\n' +
           //     '  Tooltip with HTML\n' +
           //     '</button>');
        }
    });
}
