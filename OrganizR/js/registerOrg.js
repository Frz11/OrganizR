
if($("#auth").val() !== "1"){
    swal({
        title: 'Error!',
        text:"First you must have an account in order to create an Organiser Group!",
        type: 'error'
    }).then(()=>{location.href="register.php"});
}
$("#members").selectpicker();

$("#register-btn").click(function () {
   var name = $("#name").val();
   var description = $("#description").val();
   var members = $("#members").val();
   console.log(description);
   $.ajax({
      method: "POST",
      url:"Actions.php",
      data: {
          action: "registerOrganiser",
          name: name,
          members: members,
          description: description,
      },
      success: function (result) {
          var result = JSON.parse(result);
          if(result.ok){
              swal({
                  title: 'Alright!',
                  text:"Your group has been created! Now you can add your own events! Show the people the magic you can do ;) !",
                  type: 'success'
              }).then(()=>{location.href="events.php"});
          } else {
              swal({
                  title: 'Error!',
                  text: result.error,
                  type: 'error'
              });
          }
      },
      error: function (result) {
          swal({
              title: 'Error!',
              text:"An unexpected error occurred!",
              type: 'error'
          });
      }

   });
});