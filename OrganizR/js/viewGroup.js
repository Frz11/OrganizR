function updateGroup(e){
    e.preventDefault();
    var id = $("#group_id").val();
    var name = $("#name").val();
    var description = $("#description").val();
    var members = $("#members").val();
    if(name === ""){
        swal({
            title: 'Error!',
            text:"Name cannot be empty!",
            type: 'error'
        });
        return;
    }
    $.ajax({
       url:"Actions.php",
       method:"post",
       data:{
           action: "updateOrganiser",
           name: name,
           description: description,
           members: members,
           id: id
       },
       success: function (result) {
            result = JSON.parse(result);
            if(result.ok){
                swal({
                   title: "Alright!",
                   text:  "This group has been updated! Refreshing...",
                   type:  "success"
                }).then(()=>{location.href = location.href});
            } else {
                swal({
                    title: "Error!",
                    text:  result.error,
                    type: "error",
                });
            }
       },
       error: function () {
           swal({
              title: "Error!",
              text: "Something went wrong...",
              type: "error",
           });
       }
    });
}