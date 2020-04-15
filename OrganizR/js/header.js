function logIn(e){
    e.preventDefault();
    var email = $("#email").val();
    var pwd = $("#pwd").val();
    $.ajax({
       type: 'POST',
       data: {
           action:"logIn",
           email: email,
           pwd: pwd
       },
        url: '/OrganizR/Actions.php',
        success: function (result){
           result = JSON.parse(result);
           if(result.ok === true){
               location.reload();
           } else {
               swal({
                   title: 'Error',
                   text: result.error,
                   type: 'error'
               });
           }
        },
        error: function(){
            swal({
                title: 'Error!',
                text:"Something went wrong... try again later",
                type: 'error'
            });
        }
    });
}