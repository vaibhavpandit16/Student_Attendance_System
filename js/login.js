
function tryLogin()
{
    let un=$("#txtUsername").val();
    let pw=$("#txtPassword").val();
    if(un.trim()!=="" && pw.trim()!="")
    {
       $.ajax({
        url:"/attendanceapp/ajaxhandler/loginAjax.php",
        type:"POST",
        dataType:"json",
        data:{user_name:un,password:pw,action:"verifyUser"},
        beforeSend:function(){
            $("#diverror").removeClass("applyerrordiv");
            $("#lockscreen").addClass("applylockscreen");
            
        },
        success:function(rv){
            $("#lockscreen").removeClass("applylockscreen");
            if(rv['status']=="ALL OK")
            {
                document.location.replace("attendance.php");
            }
            else{
                $("#diverror").addClass("applyerrordiv");
                $("#errormessage").text(rv['status']);
            }
        },
        error:function(){
            alert("oops something went wrong");
        },
       });
    }
}
$(function(e){
    $(document).on("keyup","input",function(e){
        $("#diverror").removeClass("applyerrordiv");
        let un=$("#txtUsername").val();
        let pw=$("#txtPassword").val();
        if(un.trim()!=="" && pw.trim()!=="")
        {
          $("#btnLogin").removeClass("inactivecolor");
          $("#btnLogin").addClass("activecolor");
        }
        else{
            $("#btnLogin").removeClass("activecolor");
            $("#btnLogin").addClass("inactivecolor");
        }
    }); 
    $(document).on("click","#btnLogin",function(e){
        tryLogin();
    });
});