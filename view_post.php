<?php
include "db.php";
session_start();
$post_id=$_GET['id'];
if(!isset($_GET['id'])){
  header("location:index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Home - Start Bootstrap Template</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/blog-home.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">       
</head>

<body>

   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">TECH VIBES</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="#">HOME</a>
                    </li>
                    <?php 
                    if(isset($_SESSION['username']) && $_SESSION['username']=="admin"){
                        echo "<li>
                        <a href='admin_dashboard.php'>DASHBOARD</a></li>";
                    }
                    else{
                         echo "<li>
                        <a href='$'>SERVICES</a></li>";
                    }
                    ?>
                    <li>
                        <a href="#">CONTACT</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <?php 
                if(isset($_SESSION['isLogin'])){
                    echo"
                        <li><a href='logout.php'><span class='glyphicon glyphicon-log-out'></span> Logout</a></li>";
                }
                else{
                    echo "
                        <li id='nav_signup'><a href='#' data-toggle='modal' data-target='#signup_modal'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                        <li id='nav_login'><a href='#' data-toggle='modal' data-target='#login_modal'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                } ?>
                </ul> 
            </div>

        </div>
    </nav>

    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <div class="col-lg-12">
                <?php
                    $query="SELECT * FROM post WHERE post_id='$post_id'";
                    $result=mysqli_query($con,$query);
                    while($row=mysqli_fetch_row($result)){
                         echo "<h2>$row[1]</h2>";  
                         echo "<p><span class='glyphicon glyphicon-time'></span> Posted on $row[4]</p>
                        <hr>
                        <img class='img-responsive' src=images/$row[3] alt='Error Loading Image'> 
                        <hr>
                        <p class='text-justify'>$row[2]</p><br/>";
                    }
                ?>
                </div>
                <div class="col-lg-12" id="comments">
                    <div class="panel panel-body" id="write-comment">
                        <h4>Add a Comment</h4>
                        <form id="comment_form">
                            <input type="hidden" name="uid" class="form-control" id="uid" value="<?php if(isset($_SESSION['user_id'])){echo $_SESSION['user_id'];} else{echo '0';} ?>">
                            <textarea class="form-control" rows="4" id="comment" placeholder="Add your comments!.."></textarea><br>
                            <select class="form-control" id="rating" name="rating" style="width:30%;">
                                <option value="0" selected>Rating</option>
                                <option value="1">1.0</option>
                                <option value="1.5">1.5</option>
                                <option value="2">2.0</option>
                                <option value="2.5">2.5</option>
                                <option value="3">3.0</option>
                                <option value="3.5">3.5</option>
                                <option value="4">4.0</option>
                                <option value="4.5">4.5</option>
                                <option value="5">5.0</option>
                            </select><br>
                            <button type="button" class="btn btn-black" id="comment_btn">Post Comment</button><br>
                            <div class="alert alert-success alert-dismissable" id="comment_success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>  
                            </div><br>
                            <div class="alert alert-danger alert-dismissable" id="comment_error">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a> 
                            </div>
                        </form>
                    </div>
                    <div id="comment-box">

                    </div>
                </div>
            </div>

            <div class="col-md-4">

                 <div class="well">
                    <h4>Blog Search</h4>
                    <form class="input-group" method="post" action="search_results.php">
                        <input type="text" class="form-control" name="keyword" required>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </form>
                </div>

                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">#Science</a>
                                </li>
                                <li><a href="#">#Technology</a>
                                </li>
                                <li><a href="#">#Gadgets</a>
                                </li>
                                <li><a href="#">#Business</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">#Research</a>
                                </li>
                                <li><a href="#">#Advancements</a>
                                </li>
                                <li><a href="#">#Smartphones</a>
                                </li>
                                <li><a href="#">#Laptops</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="well">
                    <h4>Get all my best stuff in your inbox!</h4><br>
                    <button type="button" class="btn btn-danger btn-block">Subscribe</button>
                </div>


            </div>

        </div>

    </div>
    <footer>
            <ul class="list-unstyled list-inline text-center">
                <li>
                    <a href="#" class="btn btn-danger">
                                    <i class="fab fa-twitter"></i>
                                </a>
                </li>
                <li>
                    <a href="#" class="btn btn-danger">
                                    <i class="fab fa-facebook"></i>
                                </a>
                </li>
                <li>
                    <a href="#" class="btn btn-danger">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                </li>
                <li>
                    <a href="#" class="btn btn-danger">
                                    <i class="fab fa-skype"></i>
                                </a>
                </li>
                <li>
                    <a href="#" class="btn btn-danger">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                </li>
            </ul>
            <center><b><p>© TechVibes 2018</p></b></center>
            <center><b><p>Handcrafted by Sandeep Kumar</p></b></center>
        </footer>

        <div class="modal fade" id="login_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Login</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="well">
                                    <img src="images/avatar.png" class="img-responsive img-rounded center-block">    
                                <br>
                                <form id="login_form" method="POST" action="/login/">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                        <input type="text" class="form-control" id="mobno" name="mobno" placeholder="Mobile Number.." required>
                                    </div><br><br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Password.." required>
                                    </div>
                                    <div id="login_error" class="alert alert-danger">Invalid Login Credentials!</div>
                                    <div class="checkbox">
                                        <label>
                                      <input type="checkbox" name="remember" id="remember"> Remember login
                                  </label>
                                    </div>
                                    <button type="button" id="login_btn" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> Login</button>
                                </form>
                            </div>
                        </div>
               
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="signup_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Register</h4>
                </div>
                <div class="modal-body">
                    <div class="well">
                        <img src="images/avatar.png" class="img-responsive img-rounded center-block"> <br> 
                        <form id="signup_form" class="form-horizontal" method="POST" action="">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number.." required>
                            </div><br><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username.." required>
                            </div><br><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password.." required>
                            </div><br><br>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password.." required>
                            </div><br><br>
                            <div id="signup_success" class="alert alert-success"></div>
                            <div id="signup_error" class="alert alert-danger"></div>
                            <button type="button" id="signup_btn" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="login.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            post_id=<?php echo $post_id ?>;
            $("#signup_success,#signup_error,#login_error").hide();
            $('.alert-success,.alert-danger').hide();
            $.fn.myfunc();

            $("#comment_btn").click(function() {
                var uid = $("#uid").val();
                var rating = $("#rating").val();
                if (uid == 0) {
                    $("#login_modal").modal("show");
                } else {
                    var comment = $("#comment").val();
                    if(comment.length==0||rating==0){
                        $("#comment_error").empty();
                        $("#comment_error").append("<p>Please fill all  the fields!</p>");
                        $("#comment_error").show().delay(1000).fadeOut(1500);
                        return false;
                    }
                    $.ajax({
                        type: 'post',
                        url: 'get_comments.php',
                        data: {
                            'uid': uid,
                            'comment': comment,
                            'rating': rating,
                            'post_id': post_id
                        },
                        success: function(response) {
                            if (response == 1) {
                                $("#rating").val("0");
                                $("#comment").val("");
                                $("#comment_success").empty();
                                $("#comment_success").append("<p>comment Successfully added!</p>");
                                $("#comment_success").show().delay(1000).fadeOut(1500);
                                $("#comment-box").empty();
                                $.fn.myfunc();
                            } else {
                                $("#comment_error").empty();
                                $("#comment_error").append("<p>Error in adding comment!</p>");
                                $("#comment_error").show().delay(1000).fadeOut(1500);
                            }
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });

            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
            });
        });
        $.fn.myfunc = function() {
            $.ajax({
                type: 'GET',
                url: 'get_comments.php',
                data: {
                    'id': post_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.length > 0) {
                        console.log(response);
                        $.each(response, function(i, k) {
                            if(i==0){
                                $("#comment-box").append("<div class='comment-list' id=comment-" + response[i].cmnt_id + "><h2 class=text-center>User Comments</h2><div class='clearfix'><div class='pull-left'><h5><i class='fa fa-calendar'></i>&nbsp;&nbsp;" + response[i].timestamp + "</h5><strong><h5>" + response[i].username + "</h5></strong><ul class='list-unstyled list-inline rating-star-list' id=rating-" + response[i].cmnt_id + "></ul></div><img src='images/comment-img.png' alt='Image' class='img-responsive pull-right'></div><div class='comment-list-content'><h5>" + response[i].comment + "</h5></div></div></div>");
                            }
                            else{
                                $("#comment-box").append("<div class='comment-list' id=comment-" + response[i].cmnt_id + "><div class='clearfix'><div class='pull-left'><h5><i class='fa fa-calendar'></i>&nbsp;&nbsp;" + response[i].timestamp + "</h5><h5>" + response[i].username + "</h5><ul class='list-unstyled list-inline rating-star-list' id=rating-" + response[i].cmnt_id + "></ul></div><img src='images/comment-img.png' alt='Image' class='img-responsive pull-right'></div><div class='comment-list-content'><h5>" + response[i].comment + "</h5></div></div></div>");
                            }
                            var rate = response[i].rating;
                            var len = rate / 1,
                                rem = rate % 1;
                            for (var k = 1; k <= len; k++) {
                                $("#rating-" + response[i].cmnt_id).append("<li><i class='fa fa-star'></i></li>");
                            }
                            if (rem != 0) {
                                $("#rating-" + response[i].cmnt_id).append("<li><i class='fa fa-star-half'></i></li>");
                                len++;
                            }

                            for (var k = len; k < 5; k++) {
                                $("#rating-" + response[i].cmnt_id).append("<li><i class='fa fa-star fa-star-o'></i></li>");
                            }
                        });
                    } else {
                        $("#comment-box").append("<h3 class='text-center'>Be the first to write comment!</h3>");
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
        };
    </script>

</body>

</html>
