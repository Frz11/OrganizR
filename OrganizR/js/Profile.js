$(document).ready(function () {
    $("#photo").change(function () {
        var file_data = $("#photo").prop('files')[0];
        var form_data = new FormData();
        form_data.append('file',file_data);
        form_data.append('action','changeProfilePicture');
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
                  location.reload();
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
function logOut(e){
    e.preventDefault();
    location.href="home.php";
    return;
}
function changeProfilePicture(){
    $("#photo").click();

}
