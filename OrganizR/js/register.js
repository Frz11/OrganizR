
function register(event){
    event.preventDefault();
    var username = $("[name='username']").val();
    var password = $("#pwd-register").val();
    var confirm  = $("[name='confirm']").val();
    var email = $("[name='email-register']").val();
    var birthday = $("[name='birthday']").val();
    console.log("password:" + password + "--" +confirm);
    if(password !== confirm){
        swal({
            title: 'Error!',
            text:"Passwords don't match!",
            type: 'error'
        });
        return;
    }
    $.ajax({
        type: 'POST',
        url: $("#register-form").attr('action'),
        data:{
            uname: username,
            password: password,
            confirm: confirm,
            email: email,
            birthday: birthday,
            action:'register'
        },
        success: function(response){
            response = JSON.parse(response);
            if(response.ok === true){
                swal({
                    title: 'Great!',
                    text:"Account created! Please check your email in order to confirm your account!",
                    type: 'success'
                });
            } else{
                swal({
                    title: 'Error!',
                    text:response.error,
                    type: 'error'
                });
            }

        },
        error: function () {
            swal({
                title: 'Error!',
                text:"Something went wrong... try again later",
                type: 'error'
            });
        }

    });
}