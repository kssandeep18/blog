$("#signup_btn").click(function(e) {
    e.preventDefault();
    var mobno = $("#mobile").val();
    var uname = $("#username").val();
    var pass = $("#password").val();
    var cpass = $("#cpassword").val();
    if(mobno.length==0||uname.length==0||pass.length==0||cpass.length==0){
        $("#signup_error").empty();
        $("#signup_error").append("<p>Please fill all the fields!</p>");
        $("#signup_error").show().delay(1000).fadeOut(1500);
        return false;
    }
    if(! (pass==cpass)){
        $("#signup_error").empty();
        $("#signup_error").append("<p>Password mismatch!</p>");
        $("#signup_error").show().delay(1000).fadeOut(1500);
        return false;
    }
    $.ajax({
        type: 'post',
        url: 'authentication.php',
        data: {
            'mobno': mobno,
            'uname': uname,
            'pass': pass
        },
        success: function(response) {
            if(response=='1'){
                $("#signup_form").trigger("reset");
                $("#signup_success").empty();
                $("#signup_success").append("<p>Registration Successfull!</p>");
                $("#signup_success").show().delay(3000).fadeOut(1500);
                console.log(response);
            }
            else{
                $("#signup_error").empty();
                $("#signup_error").append("<p>"+response+"</p>");
                $("#signup_error").show().delay(3000).fadeOut(1500);
            }
        },
        error: function(response) {

        }
    });
});

$("#login_btn").click(function() {
    var mobno = $("#mobno").val();
    var pass = $("#pass").val();
     if(mobno.length==0||pass.length==0){
        $("#login_error").empty();
        $("#login_error").append("<p>Please fill all the fields!</p>");
        $("#login_error").show().delay(1000).fadeOut(1500);
        return false;
    }
    $.ajax({
        type: 'get',
        url: 'authentication.php',
        data: {
            'mobno': mobno,
            'pass': pass
        },
        success: function(response) {
            //console.log(response);
            if(response==2){
                window.location.href="admin_dashboard.php";
            }
            else if (response>0) {
                console.log(response);
                $("#login_form").trigger("reset");
                $("#login_modal").modal('hide');
                $("#nav_signup,#nav_login").remove();
                $("#uid").val(response);
                $(".navbar-right").append("<li id='nav_logout'><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span>Logout</a></li>");
            } 
            else {
                $("#login_error").empty();
                $("#login_error").append("<p>Invalid Login Credentials!</p>");
                $("#login_error").show().delay(1000).fadeOut(1500);
            }

            console.log(response);
        },
        error: function(response) {

        }
    });
});