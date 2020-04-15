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
function addEvent(){
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
          action:"addEvent",
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

               location.href="events.php";

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
