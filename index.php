<?php
include "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tech Vibes</title>
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
                        <a href="index.php">HOME</a>
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

                <h1 class="page-header">
                    Tech Vibes
                    <small>- a Technical Blog</small>
                </h1>

                <?php
                    $query="SELECT * FROM post";
                    $result=mysqli_query($con,$query);
                    $row_count=mysqli_num_rows($result);
                    $count=1;$c=0;
                    while($row=mysqli_fetch_row($result)){
                        if($count%2){
                            $c++;
                            echo "<div class='col-lg-12 wrap_post' id=wrap_$c >";
                        }
                        echo "<h2>$row[1]</h2>
                        <p><span class='glyphicon glyphicon-time'></span> Posted on $row[4]</p>
                        <img class='img-responsive' src=images/$row[3] alt='Error Loading Image'> 
                        <br/>
                        <h4 class='text-justify'>".substr($row[2], 0,250).".......</h4><br/>
                        <a class='btn btn-primary' href=view_post.php?id=$row[0]>Read More <span class='glyphicon glyphicon-chevron-right'></span></a><hr/>";
                        if($count%2==0 || $count==$row_count){
                            if($count>2 && $count<$row_count){
                                echo "<ul class='pager'>
                                    <li class='previous' id=$c>
                                        <a href='#'>&larr; Older</a>
                                    </li>
                                    <li class='next' id=$c>
                                        <a href='#'>Newer &rarr;</a>
                                    </li>
                                </ul>";
                            }
                            else if($count>2 || $count==$row_count){
                                echo "<ul class='pager'>
                                    <li class='previous' id=$c>
                                        <a href='#'>&larr; Older</a>
                                    </li>
                                </ul>";
                            }
                            else if($count==2 && $count<$row_count){
                                echo "<ul class='pager'>
                                    <li class='next' id=$c>
                                        <a href='#''>Newer &rarr;</a>
                                    </li>
                                </ul>";
                            }
                            echo "</div>";
                        }   
                        $count++;
                    }
                ?>

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
                                    <button type="button" id="login_btn" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i>  Login</button>
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
            $('#signup_success,#signup_error,#login_error').hide();
            $('.wrap_post').addClass('hide');
            $('#wrap_1').removeClass('hide');
            $('.next').click(function(){
                var cur=parseInt($(this).attr('id'));
                var nextt=cur+1;
                $('#wrap_'+cur).addClass('hide');
                $('#wrap_'+nextt).removeClass('hide');
                
            });
            $('.previous').click(function(){
                var present=parseInt($(this).attr('id'));
                var prev=present-1;
                console.log(present +" "+prev);
                $('#wrap_'+present).addClass('hide');
                $('#wrap_'+prev).removeClass('hide');
            });
        });
      
    </script>

</body>

</html>
