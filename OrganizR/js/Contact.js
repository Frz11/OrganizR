function sendContact(){
    var name = $("#name").val();
    var email = $("#client-email").val();
    var message = $("#message").val();
    var subject = $("#subject").val();


    $.ajax({
        url:"Actions.php",
        type:"post",
        data:{
            action: "sendContact",
            name: name,
            email: email,
            subject:subject,
            message: message
        },
        success: function (result) {
            result = JSON.parse(result);
            if(result.ok){
                swal({
                    type:"success",
                    text:"An email was sent to our support team! Please stand-by and wait for their reply on the email address your provided!",
                    title:"Yey!"
                });
            } else {
                swal({
                    title:"Error!",
                    text: result.error,
                    type:"error"
                });
            }
        },
        error: function () {
            swal({
                title:"Error!",
                text:"Something went wrong...",
                type:"error"
            });
        }
    });
}