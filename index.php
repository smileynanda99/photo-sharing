<?php
  session_start();
  include"includes/connection.php";
  include"includes/security.php";
  $sql1="select * from user ";
  $res1=mysqli_query($conn,$sql1);
  $row=mysqli_num_rows($res1);
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
      font-size: xx-large;
      border-left: 10px solid teal;
    }

    .parallax-container {
      height: 350px;
    }

    .input-field label {

      font-size: 1.4rem;

    }
  </style>
</head>

<body>
  <!--navbar and header-->
  <header>
    <nav class=" transparent">
      <div class="navbar-wrapper transparent">
        <!--Brand Logo and menu -->
        <a href="#" class="brand-logo  logo red-text" style="margin-left: 50px;">
          RKNANDA<i class="fa fa-mortar-board tiny right black-text valign-wrapper"></i></sup>
        </a>
        <a href="#" class="sidenav-trigger" data-target="slide-out"><i class="material-icons black-text">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a href="login.php">Log In</a></li>
          <li><a href="#gallery">Gallery</i></a></li>
          <li><a href="#facilities">Facilities</a></li>
          <li><a href="#contactus">Contact Us</a></li>
          <li><a href="#aboutus">About Us</a></li>
          <li><a href="http://rknanda.c1.biz/">Developed By</a></li>
        </ul>
      </div>
    </nav>
    <div class="center" style="margin-top: 15%;">
      <h4 class="red-text " style="font-weight: 400;">
      UPLOAD NEW PICTURE & SHARE WITH OTHER
      </h4>
       <p>We Making Different Way To Sharing Your Picture and Make Popular, Let's Do It Togther<p>
      <a href="signup.php" class="btn waves-effect waves-light " style="border-radius: 5px;">Sign Up</a>
      <h5 class="red-text " style="font-weight: 400;">Starting New Journey !!....</h5>
    </div>
  </header>
  <!--sidenav bar-->
  <ul id="slide-out" class="sidenav">
    <li>
      <div class="user-view">
        <div class="background grey darken-4"></div>
        <div class="center">
          <a href="#user" class="center"><img class="" src="image/fb.jpg" style="border-radius: 50%;" width="150px"
              height="150px"></a>
          <span class="white-text name">Admin:-Rohit Kumar Nanda</span>
          <span class="white-text email">smileynanda99@gmail.com</span>
        </div>
      </div>
    </li>
    <li><a href="login.php"><i class="fa fa-user-circle-o prefix small red-text text-darken-1"></i> Log In</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a href="#gallery"> <i class="fa fa-image prefix small red-text  text-darken-1"></i> Gallery</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a href="#facilities"><i class="fa fa-suitcase small red-text  text-darken-1"></i> Facilities</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a href="#contactus"><i class="fa fa-phone prefix small red-text  text-darken-1"></i> Contact Us</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a href="#aboutus"><i class="fa fa-address-card small red-text  text-darken-1"></i> About Us</a></li>
    <li>
      <div class="divider"></div>
    </li>
  </ul>


  <!--Gallery Content-->
  <section class="section  scrollspy " id="gallery">
    <blockquote>Gallery</blockquote>
    <div class="row">
     

        <?php
        $sql="select * from post where 1 order by post_id desc limit 9";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
          while( $info=mysqli_fetch_assoc($res))
          {
            $new=setKey($info['post_id']); 
            $post_key=setKey($info['id']); 
        ?>
        <div class="col l4 m4 s6">
        <div class="card " >
           <div class="card-image center">
              <img class="materialboxed "  data-caption="<?php echo "Publish by ".decrypt($info['name'],$post_key)." on ".decrypt($info['date'],$post_key)." Date";     
                                                               echo ". ".decrypt($info['content'],$post_key); ?>" 
              src="post_image/<?php echo decrypt($info['post_photo'],$post_key); ?>" alt="" height="200px">
              <span class="card-title "><?php echo decrypt($info['title'],$post_key);?></span> 
            </div>
            <div class="center card-action">
                <a href="like/like_i.php" class="tooltipped"  data-tooltip="Like">
                <div class="chip teal white-text">
                    <i class="fa fa-heart tiny white-text " ></i> <?php
                                                                   echo decrypt($info['like_no'],$new);
                                                                  ?>
                  </div>
                </a>
                <a href="like/comment_i.php" class="tooltipped"  data-tooltip="Comments">
                <div class="chip teal white-text">
                    <i class="fa fa-comment tiny white-text" ></i> &#160;<?php
                                                                   echo decrypt($info['comment_no'],$new);
                                                                  ?>
                </div>
               </a>
                <a download="<?php echo decrypt($info['post_photo'],$post_key);?>" href="post_image/<?php echo decrypt($info['post_photo'],$post_key);?>"   class="tooltipped"  data-tooltip="Save">
                <div class="chip teal white-text">
                    <i class="fa fa-download tiny white-text"></i>&#160;
                </div>
                </a>
           </div>
        </div>
        </div>
        <?php
          }
        }
        else
        {
          echo "<div class='chip center red black-text' >Sorry,
          Something went wrong, Please Reload page</div>";
          
        }
        ?>
        
    </div>
    <div class="row center" style="margin-bottom: 50px;">
      <a href="home.php" class="btn-large waves-effect waves-light">
        <i class="fa fa-image prefix small left "></i> More Image</a></div>
  </section>
  <!--Facilities Content-->
  <section class="section scrollspy" id="facilities">
    <div class="parallax-container">
      <div class="parallax"><img src="image/15.jpg" class="responsive-img" style="background-size: cover;"></div>
    </div>
    <div class="section white">
      <div class="row container">
        <blockquote class="header">Facilities & Our Team...  </blockquote>
        <p class="grey-text text-darken-3 lighten-3">Here we provied you a online platform to save your picture
         of your life beutifull memories for parmanent.You can also see and Save you friends picture on this platform.We
          are also provide a private feature in future to save your own photo so can't see anybody your personal photo.  
         </p>
         <h6>We have <?php echo $row; ?> members Happy family </h5>
      </div>
    </div>
    <div class="parallax-container">
      <div class="parallax"><img src="image/10.jpg" class="responsive-img" style="background-size: cover;"></div>
    </div>
  </section>

 
  <!--About Us Content-->
  <section class="section container scrollspy" id="aboutus">
    <blockquote class="header">About Us</blockquote>
    <div class="row">

    <div class="col l4 m4 s12" style="margin-top:30px">
        <div class="center">
          <i class="fa fa-edit large red-text"></i>
          <p>We are also provide a private feature
           in future to save your own photo so can't
            see anybody your personal photo.</p>
        </div>
      </div>  

       <div class="col l4 m4 s12" style="margin-top:30px">
        <div class="center">
          <i class="fa fa-gear large red-text"></i>
          <p>Here we provied you a online platform to save your picture
         of your life beutifull memories for parmanent.You can also see 
         and Save you friends picture on this platform.</p>
        </div>
      </div>
 
     
      <div class="col l4 m4 12" style="margin-top:30px">
        <div class="center">
          <i class="fa fa-share-alt large red-text"></i>
          <p>You can upload your photo. we will help you 
          to share photo with other and make to popular</p>
        </div>
      </div>

    </div>
  </section>

 <!--Contant Content-->
 <section class="section container scrollspy" id="contactus">
    <blockquote class="header">Contact Us</blockquote>
    <div class="row">

      <div class="col l6 m6 s12">
        <div class="card-panel z-depth-3">
          <div class="card-content">
            <h4><i class="fa fa-map small prefix red-text"></i> Address</h4>
            <div class="divider"></div>
            <div class="card-image center" style="margin-top: 10px;">
              <img class="materialboxed responsive-img"  data-caption="MNIT Jaipur Rajasthan, INDIA. PIN Code:-302017" src="image/map.png" alt="">
            </div>
            <div class="card-content ">
              <blockquote style="font-size: large; border-left: 5px solid teal;">MNIT Jaipur Rajasthan,302017
              </blockquote>
            </div>
          </div>
        </div>
      </div>
      
      <!-- <div class="col l6 m6 s12">
        <div class="card-panel z-depth-3" id="send">
          <div class="card-content">
            <h4><i class="fa fa-send small prefix red-text"></i> Send Message</h4>
            <div class="divider"></div>
            <div class="input-field " style="margin-top:2vw;">
              <i class="fa fa-envelope-o tiny red-text prefix"></i>
              <input type="email" id="email" name="email" required class="validate">
              <label for="email">Email</label>
              <span data-error="Invalid" class="helper-text"></span>
            </div>
            <div class="input-field " style="margin-top: 1.5vw;">
              <i class="fa fa-comment-o red-text tiny prefix"></i>
              <input type="text" id="msg" name="msg" required>
              <label for="msg">Drop Message Here!</label>
            </div>
            <div class="center" style="margin-top: 30px;">
              <a href="#" class="btn waves-effect waves-light">Send</a>
            </div>
          </div>
        </div>
      </div> -->
     

    </div>
  </section>


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
      <div class="red-text container">
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
    $('.materialboxed').materialbox();
    $('.chips').chips();
    $('.tooltipped').tooltip({
      position:'botton',
      margin:2,
    });

  });
</script>

</html>