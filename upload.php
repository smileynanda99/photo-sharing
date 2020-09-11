<?php
ob_start();
session_start();
if(isset($_SESSION['username']))
{
    $id=$_SESSION['username'];
    include"includes/connection.php";
    include"includes/security.php";
    $key=$_SESSION['key'];
    $key=setKey($key);  //key for encrypting
    $sql="select * from user where  id=$id";
    $res=mysqli_query($conn,$sql);
    $info=mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>

<head>
    <!--Import Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Import font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <!--Import jqueryui.css-->
    <link type="text/css" rel="stylesheet" href="jqueryui/jquery-ui.min.css" />
    <link type="text/css" rel="stylesheet" href="jqueryui/jquery-ui.structure.min.css" />
    <link type="text/css" rel="stylesheet" href="jqueryui/jquery-ui.theme.min.css" />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <style>
        .logo {
            font-weight: 500;
            text-shadow: 2px 2px black;
        }

        header {
            background-image: url(image/a.jpg);
            background-size: cover;
            background-position: center;
            min-height: 700px;
        }

        @media screen and (max-width: 800px) {
            header {

                min-height: 500px;
            }
        }

        blockquote {
            font-size:xx-large;
            border-left: 10px solid teal;
        }

        .parallax-container {
            height: 350px;
        }

        .input-field label {
            color: teal;
            font-size: 1.6rem;

        }


        .chip {
            background-color: teal;
            color: white;
        }

        .pagination li.active a {
            background-color: teal;
            border-radius: 5px;
        }

        header,
        nav,
        .main,
        footer {
            padding-left: 300px;
        }

        @media only screen and (max-width : 992px) {

            header,
            nav,
            .main,
            footer {
                padding-left: 0;
            }
        }
    </style>
</head>

<body>
     <!--navbar and header-->
     <header>
        <nav class=" transparent">
            <div class="navbar-wrapper transparent">
                <!--Brand Logo and menu -->
                <a href="#!" class="brand-logo  logo red-text center " style="margin-left: 50px;">
                    RKNANDA<i class="fa fa-mortar-board tiny right black-text valign-wrapper"></i></sup>
                </a>
                <a href="#" class="sidenav-trigger " data-target="slide-out"><i
                        class="material-icons black-text">menu</i></a>

                <ul class="right hide-on-med-and-down">
                    <li><a href="profile.php">
                            <div class="chip">
                                <img src="<?php if($info['photo'])
                                                        echo "profile_image/".decrypt($info['photo'],keys());
                                                     else
                                                        echo "profile_image/defaulat.png";?>" alt=""
                                                         class="circle responsive-img">
                                <?php
                                    echo decrypt($info['fname'],keys());
                                ?>
                            </div>
                        </a></li>
                    <li><a href="#logout" class="modal-trigger">
                            <div class="chip">
                                <i class="fa fa-sign-out tiny red-text  text-darken-1"></i> Log Out
                            </div>
                        </a></li>
                </ul>

            </div>
        </nav>
        <div class="center" style="margin-top: 15%;">
            <h4 class="red-text " style="font-weight: 400;">
                UPLOAD NEW PICTURE & SHARE WITH OTHER
            </h4>
            <p>We Making Different Way To Sharing, Let's Do It Togther<p>
            <div class="center chip " style="font-weight:500;">Welcome <?php
            echo decrypt($info['fname'],keys());
            ?> !!...</div>
        </div>
    </header>
    <!--logout-->
    <div id="logout" class="modal  " height="150px" weight="500px" >
    <div class="modal-content">
      <blockquote style="text-darken-2">Log Out</blockquote>
      <p>You are sure to log out</p>
    </div>
    <div class="modal-footer ">
      <a href="#!" class="modal-close waves-effect waves-light btn hoverable">No</a>
      <a href="logout.php" class="modal-close waves-effect waves-light btn hoverable">Yes</a>
    </div>
  </div>
    <!--sidenav bar-->
    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li>
            <div class="user-view">
                <div class="background grey darken-4"></div>
                <div class="center">
                <img class="" src="<?php if($info['photo'])
                                                echo "profile_image/".decrypt($info['photo'],keys());
                                         else
                                                echo "profile_image/defaulat.png";?>"
                                                 style="border-radius: 50%;" width="150px" height="150px">
                    <span class="white-text name">User:-<?php echo decrypt($info['fname'],keys())." ".decrypt($info['lname'],keys()) ?></span>
                    <span class="white-text email"><?php echo decrypt($info['email'],$key) ?></span>
                </div>
            </div>
        </li>
        <li><a href="home.php"><i class="fa fa-home prefix small red-text text-darken-1"></i> Home</a>
        </li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="profile.php" ><i class="fa fa-address-card-o prefix small red-text text-darken-1"></i> Profile</a>
        </li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="my_photo.php"> <i class="fa fa-camera-retro prefix small red-text  text-darken-1"></i> My Photos</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="#!" class="active white-text" style="background-color:teal; border-radius: 10px;"><i class="fa fa-upload small red-text  text-darken-1"></i> Upload</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="resent_post.php"><i class="fa fa-clipboard prefix small red-text  text-darken-1"></i> Recent Posts</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="change_pass.php" ><i class="fa fa-gear prefix small red-text  text-darken-1"></i> Change password</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="#logout" class="modal-trigger"><i class="fa fa-sign-out small red-text  text-darken-1"></i> Log Out</a></li>
        <li>
            <div class="divider"></div>
        </li>
    </ul>

    <!--upload content-->
    <div class="row container main">
        <div class="col s10 offset-s1 ">
            <form action="upload_check.php" method="POST" enctype="multipart/form-data">
                <div class="card-panel z-depth-3"
                    style="margin-top: 5%; background: rgba(255, 0, 0, 0.2); max-height: 100%;">
                    <div class="user-view">
                        <div class="center">
                            <i class="fa fa-upload large prefix red-text text-darken-3"></i>
                            <h3 style="font-weight: 500;"> Upload Images</h3>
                            <div class="row center">
                            <?php
                                if(isset($_SESSION['upload']))
                                {
                                    echo $_SESSION['upload'];
                                    unset($_SESSION['upload']);
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="card-content">
                        <div class="row" style="margin-top: 2%;">
                            <div class="input-field col s12 ">
                                <input placeholder="Enter Name" id="name" value="<?php if($info['fname'])
                                                                                           echo decrypt($info['fname'],keys())." ".decrypt($info['lname'],keys());
                                                                                           else
                                                                                           echo "";?>" name="name" type="text" required>
                                <label for="name">Name</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top: -50px;">
                            <div class="input-field col s6">
                                <input id="title" type="text" name="title" placeholder="Enter Title " required>
                                <label for="title">Title</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="date" type="text" name="date" placeholder="Select Submation Date" class="datepicker"
                                    required>
                                <label for="date">Sub-Date</label>
                            </div>
                        </div>
                        <div class="row " style="margin-top: -50px;">
                            <div class="input-field col s12">
                                <input id="content" type="text" name="content" placeholder="About Post Picture" >
                                <label for="content">Content</label>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -50px;">
                            <div class="input-field file-field col s12">
                                <div class="btn btn-large teal-text transparent hoverable ">
                                    <span><i class="fa fa-upload small red-text  text-darken-1"></i> Upload</span>
                                    <input type="file" name="post" id="post" required>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate"  placeholder="Choose File">
                                    <label for="post">Post Picture</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="center ">
                                <input type="submit" value="Submit" name="submit"
                                    class="btn btn-large teal-text transparent hoverable  ">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>



    <!--footer Content-->
    <div class="page-footer grey darken-4">
        <!--conatact-contect-->
        <div class="row">
            <div class="col l4 offset-l4 m5 s12">
                <span style="font-size:large"> Contact Us
                    <br>
                    <a href="" style="cursor: default;" class="white-text">
                        Email:-smileynanda99@gmail.com
                    </a><br>
                    <a href="" class="white-text">Mobile No.:-7340073383</a>
                </span>
            </div>
            <div class="col l4 m6 offset-m1 s12">
                <span class="text" style="font-size: large;">
                    Follow Us &#160;&#160;
                    <a href="https://www.facebook.com/rohit.nanda.7923"><i class="btn btn-floating fa fa-facebook-official small blue-text white"></i></a>
                    <a href="https://www.instagram.com/er.rknanda_hmh/"><i class="btn btn-floating fa fa-instagram small red-text white"></i></a>
                    <a href="https://twitter.com/RohitkumarNand6"><i class="btn btn-floating fa fa-twitter-square small blue-text white"></i></a>
                    <a href="https://www.youtube.com/channel/UCqJy66UaJUhIbzhu9W36xqw?view_as=subscriber"><i class="btn btn-floating fa fa-youtube red-text small white"></i></a>
                </span>
            </div>
        </div>
        <!--copy right-contect-->
        <div class="footer-copyright">
            <div class="red-text container main">
                &copy;All Right Reseved, RKNANDA
            </div>
        </div>

    </div>

</body>
<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<script>
    $('document').ready(function () {

        $('.sidenav').sidenav();
        $('.parallax').parallax();
        $('.scrollspy').scrollSpy();
        $('.modal').modal({
            dismissible:false,
        });
        $('.materialboxed').materialbox();
        $('.datepicker').datepicker({
            autoClose: true,
            format: 'ddmmmm,yyyy',
            disableWeekends: false,
            yearRange:5,
        });

    });
</script>

</html>
<?php

}
else
{   $_SESSION['message']="<div class='chip center red black-text' >
    Please Login To Continue</div>";
    header("Location:login.php");
}

?>