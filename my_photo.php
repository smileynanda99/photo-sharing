<?php
ob_start();
session_start();
if(isset($_SESSION['username']))
{
 include"includes/security.php";
 include"includes/connection.php";
 $id=$_SESSION['username'];
 $key=$_SESSION['key'];
 $key=setKey($key);
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

            font-size: 1.4rem;

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
                <a href="#" class="brand-logo  logo red-text center " style="margin-left: 50px;">
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
        <li><a href="profile.php"><i class="fa fa-address-card-o prefix small red-text text-darken-1"></i> Profile</a>
        </li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="#!" class="active white-text" style="background-color:teal; border-radius: 10px;"> <i class="fa fa-camera-retro prefix small red-text  text-darken-1"></i> My Photos</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="upload.php"><i class="fa fa-upload small red-text  text-darken-1"></i> Upload</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="resent_post.php"><i class="fa fa-clipboard prefix small red-text  text-darken-1"></i> Recent Posts</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="change_pass.php"><i class="fa fa-gear prefix small red-text  text-darken-1"></i> Change password</a></li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a href="#logout" class="modal-trigger"><i class="fa fa-sign-out small red-text  text-darken-1"></i> Log Out</a></li>
        <li>
            <div class="divider"></div>
        </li>
    </ul>

    <div class="row main" style="margin-top: 30px;">

    <?php
        if(isset($_GET['page']))
        {
           $page=$_GET['page'];
           $page=secure($page); 
        }
        else
        {
            $page=1;
        }
        $sql1="select * from post where id=$id";
        $res1=mysqli_query($conn,$sql1);
        $count=mysqli_num_rows($res1);
        $per_page=9;
        $no_of_page=ceil($count/$per_page);
        $start=($page-1)*$per_page;
        $sql1="select * from post where id=$id  limit $start,$per_page ";
        $res1=mysqli_query($conn,$sql1);
        if(mysqli_num_rows($res1)>0)
        {
          while( $info1=mysqli_fetch_assoc($res1))
          { $new=setKey($info1['post_id']);  
            $post_key=setKey($info['id']); 
            ?>
            <div class="col l4 m4 s6">
            <div class="card " >
               <div class="card-image center">
                  <img class="materialboxed "  data-caption="<?php echo "Publish by ".decrypt($info1['name'],$post_key)." on ".decrypt($info1['date'],$post_key)." Date";     
                                                                   echo ". ".decrypt($info1['content'],$post_key); ?>" 
                  src="post_image/<?php echo decrypt($info1['post_photo'],$post_key); ?>" alt="" height="200px">
                  <span class="card-title "><?php echo decrypt($info1['title'],$post_key);?></span> 
                </div>
            <div class="center card-action">
                <a href="like/like_m.php?id=<?php echo $info1['post_id'];?>&page=<?php echo $page;?>" 
                                             class="tooltipped"  data-tooltip="Like">
                <div class="chip teal white-text">
                    <i class="fa fa-heart tiny <?php
                                                  $post_id=$info1['post_id'];
                                                  $sql2="select * from likes where post_id=$post_id and user_id=$id ";
                                                  $res2=mysqli_query($conn,$sql2);
                                                  $data=mysqli_fetch_assoc($res2);
                                                  if($data['status']==1)
                                                   {echo "red-text";}
                                                  else
                                                   {echo "white-text";}
                                                  ?> " ></i>  &#160;
                                                                <?php
                                                                echo decrypt($info1['like_no'],$new);
                                                                ?>
                  </div>
                </a>
                <a href="comment.php?id=<?php echo $info1['post_id'];?>"   class="tooltipped"  data-tooltip="Comments">
                <div class="chip teal white-text">
                    <i class="fa fa-comment tiny white-text"></i> &#160;<?php
                                                                  echo decrypt($info1['comment_no'],$new);
                                                                  ?>
                </div>
               </a>
                <a download="<?php echo decrypt($info1['post_photo'],$post_key);?>" href="post_image/<?php echo decrypt($info1['post_photo'],$post_key);?>"  class="tooltipped"  data-tooltip="Save">
                <div class="chip teal white-text">
                    <i class="fa fa-download tiny white-text"></i> &#160;
                </div>
                </a>
           </div>
        </div>
        </div>
        <?php
          }
          ?>
        </div>   
    <!--Pagination -->
    
    <div class="row center main">
        <ul class="pagination ">
      
            <li class="<?php
             if($page==1)
             echo "disabled";?>" ><a href="<?php if($page==1) 
                                        { echo "#!"; }
                                        else
                                        { echo "my_photo.php?page=".($page-1); }
                                        ?>">
             <i class="material-icons">chevron_left</i></a></li>
            <?php
             for($i=1;$i<=$no_of_page;$i++)
             {
             ?>
            <li <?php
             if($page==$i)
             echo "class='active teal'";?> ><a href="my_photo.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
           <?php
             }?> 
            <li class="<?php
             if($page==$no_of_page)
             echo "disabled";?>" ><a href="<?php if($page==$no_of_page) 
                                                { echo "#!"; }
                                                else
                                                { echo "my_photo.php?page=".($page+1); }
                                                ?>">
             <i class="material-icons">chevron_right</i></a></li>
        </ul>
    </div>
          <?php
        }
        else
        {?>
          <div class="center">
              <?php echo "<div class='chip  red black-text' >You Have not yet uploaded any own photo</div>";?>
          </div>
        <?php  
        }
        ?>
     
   

   



    <!--footer Content-->
    <div class="page-footer grey darken-4 ">
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
        <div class="footer-copyright ">
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

        $('.sidenav').sidenav({
            isFixed:true,
        });
        $('.parallax').parallax();
        $('.scrollspy').scrollSpy();
        $('.materialboxed').materialbox();
        $('.chips').chips();
        $('.modal').modal({
            dismissible:false,
        });
        $('.tooltipped').tooltip({
        position:'botton',
        margin:2,
        });

    });
</script>

</html>
<?php

}
else
{   
    $_SESSION['message']="<div class='chip center red black-text' >
    Please Login To Continue</div>";
    header("Location:login.php");
}

?>