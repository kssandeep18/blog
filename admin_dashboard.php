<?php
include "db.php";
session_start();
if($_SESSION['username']!="admin"){
  header("location:index.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
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
                    <li>
                        <a href="index.php">HOME</a>
                    </li>
                    <?php 
                    if(isset($_SESSION['username']) && $_SESSION['username']=="admin"){
                        echo "<li class='active'>
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
                        <li id='nav_action'><a href='#' data-toggle='modal' data-target='#action_modal'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
                        <li id='nav_login'><a href='#' data-toggle='modal' data-target='#login_modal'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
                } ?>
                </ul> 
            </div>

        </div>
    </nav>

    <div class="container" id="admin_wrap">
        <div class="jumbotron">
        <h1 class="font">Admin Panel</h1>  
     </div> 
<div id="action_success" class="alert alert-success"></div>
<div id="action_error" class="alert alert-danger"></div>
<div>
  <ul class="nav nav-pills nav-justified">
    <li class="active"><a data-toggle="pill" href="#add">Add Post</a></li>
    <li><a data-toggle="pill" href="#edit">Edit Post</a></li>
    <li><a data-toggle="pill" href="#delete">Delete Post</a></li>
  </ul>
  
  <div class="tab-content">
<br>
        <form class="tab-pane fade in active" id="add" enctype="multipart/form-data">
            <div>
                <div class="form-group">
                    <label for="heading">Post Heading:</label>
                    <input type="text" class="form-control" name="heading" id="heading" required="">
                </div>
                <div class="form-group">
                    <label for="desc">Post Description:</label>
                    <textarea class="form-control" name="desc" id="desc" required=""></textarea>
                </div>
                <div class="form-group">
                    <label for="desc">Image Thumbnail:</label>
                    <input type="file" name="file" class="form-control" id="file" required="">
                </div>
                <button type="submit" class="btn btn-default add">Add Post</button>
            </div>
        </form>

    <div class="tab-pane fade in" id="edit">
        <div class="list-group">
        <?php 
            $query="SELECT * FROM post";
            $result=mysqli_query($con,$query); 
            while( $row = mysqli_fetch_row($result)){ ?>
            <div class="list-group-item row" id="row_<?php echo $row[0]; ?>">
                <div class="col-lg-6 headline_<?php echo $row[0]; ?>" >
                   <strong><h4><?php echo $row[1]; ?></h4></strong>
                </div>
                <div class="col-lg-6">
                    <span class="pull-right">
                <span class="badge"><h6><?php echo $row[4]; ?></h6></span>
                <span>
                <button type="button" class="btn btn-success" id="<?php echo $row[0]; ?>"><span class="glyphicon glyphicon-pencil"></span> Edit</button></span>
                </span>
                </div>  
            </div>
        <?php } ?>
        </div>
    </div>

    <div id="delete" class="tab-pane fade">
      <div class="list-group">
        <?php 
            $query="SELECT * FROM post";
            $result=mysqli_query($con,$query); 
            while( $row = mysqli_fetch_row($result)){ ?>
            <div class="list-group-item row" id="row_<?php echo $row[0]; ?>">
                <div class="col-lg-6 headline_<?php echo $row[0]; ?>" >
                   <strong><h4><?php echo $row[1]; ?></h4></strong>
                </div>
                <div class="col-lg-6">
                    <span class="pull-right">
                <span class="badge"><h6><?php echo $row[4]; ?></h6></span>
                <span>
                <button type="button" class="btn btn-danger" id="<?php echo $row[0]; ?>"><span class="glyphicon glyphicon-remove"></span> Delete</button></span>
                </span>
                </div>  
            </div>
        <?php } ?>
    </div>
  </div>

    </div>

    <div class="modal fade" id="edit_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="well">
                                <form class="form-group" id="add">
                                    <div>
                                        <div class="form-group">
                                            <label for="heading">Post Heading:</label>
                                            <input type="text" class="form-control" name="edit_heading" id="edit_heading">
                                        </div>
                                        <div class="form-group">
                                            <label for="desc">Post Description:</label>
                                            <textarea class="form-control" name="edit_desc" id="edit_desc"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-default" id="update">Make Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
               
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="login.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
             $('#action_success,#action_error').hide();

             $("#add").submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'admin_action.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType:'json',
                    success: function(response) {
                        console.log(response);
                         if(response==1){
                            $("#action_success").empty();
                            $("#action_success").append("<p class='text-center'> Post Added Successfully!</p>");
                            $("#action_success").show().delay(200).fadeOut(1500);
                        }
                        else{
                            $("#action_error").empty();
                            $("#action_error").append("<p>Error in Adding Post!</p>");
                            $("#action_error").show().delay(3000).fadeOut(1500);

                        }
                    },
                    error:function(response){
                        console.log(response);
                    }
                    });
            });

              $(".btn-success").click(function(){
                edit_id=$(this).attr("id");
                console.log(edit_id);
                $.ajax({
                    type: 'GET',
                    url: 'admin_action.php',
                    data: {
                        'id': edit_id,
                        'op':"edit"       
                    },
                    dataType:'json',
                    success: function(response) {
                        console.log(response);
                        if(response!=0){
                            //console.log(response);
                            $("#edit_modal").modal('show');
                            $("#edit_heading").val(response[1]);
                            $("#edit_desc").val(response[2]);
                        }
                        else{
                            $("#action_error").empty();
                            $("#action_error").append("<p>Error in Updation!</p>");
                            $("#action_error").show().delay(3000).fadeOut(1500);

                        }
                    },
                    error:function(response){
                        console.log(response);
                    }
                });
            });

            $("#update").click(function(){
                var edit_heading=$("#edit_heading").val();
                var edit_desc=$("#edit_desc").val();
                if(edit_heading.length>0 && edit_desc.length>0 ){
                    console.log(edit_id);
                    $.ajax({
                    type: 'GET',
                    url: 'admin_action.php',
                    data: {
                        'edit_id': edit_id,
                        'edit_heading':edit_heading,
                        'edit_desc':edit_desc,
                        'op':"update"
                    },
                    success: function(response) {
                        console.log(response);
                        if(response!=0){
                            $("#edit_modal").modal('hide');
                            $(".headline_"+edit_id).html("<strong><h4>"+response+"</h4></strong>");
                            $("#action_success").empty();
                            $("#action_success").append("<p class='text-center'> Post Successfully Updated!</p>");
                            $("#action_success").show().delay(200).fadeOut(1500);
                        }
                        else{
                            $("#edit_modal").modal('hide');
                            $("#action_error").empty();
                            $("#action_error").append("<p>Error in Updation!</p>");
                            $("#action_error").show().delay(3000).fadeOut(1500);

                        }
                    }
                });
                }
                
            });

            $(".btn-danger").click(function(){
                var del_id=$(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url: 'admin_action.php',
                    data: {
                        'id': del_id,
                        'op':"delete"
                    },
                    success: function(response) {
                        if(response==1){
                            $(".list-group #row_"+del_id).remove();
                            $("#action_success").empty();
                            $("#action_success").append("<p class='text-center'> Post Successfully Deleted!</p>");
                            $("#action_success").show().delay(200).fadeOut(1500);
                        }
                        else{
                            $("#action_error").empty();
                            $("#action_error").append("<p>Error in Deletion!</p>");
                            $("#action_error").show().delay(3000).fadeOut(1500);

                        }
                    }
                });
            });

        });
    </script>
</body>
</html>