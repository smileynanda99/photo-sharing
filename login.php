<?php
  ob_start();
  session_start();
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

    .input-field label {
      color: teal;
      font-size: 1.6rem;

    }   header {
      /* background-image: url(image/a.jpg); */
      background-size: cover;
      background-position: center;
    }

    .chip {
      background-color: teal;
      color: white;
    }
  </style>
</head>

<body style="background-image: url(image/ff.jpg); background-repeat: no-repeat; background-size:cover;background-position: center bottom;">
  <!--navbar and header-->
  <header>
    <nav class=" transparent">
      <div class="navbar-wrapper transparent">
        <!--Brand Logo and menu -->
        <a href="#" class="brand-logo  logo red-text center" style="margin-left: 50px;">
          RKNANDA<i class="fa fa-mortar-board tiny right black-text valign-wrapper"></i></sup>
        </a>
      </div>
    </nav>
  </header>
  <!--login form-->
  <form action="login_check.php" method="POST">
    <div class="row ">
      <div class="col l4 offset-l4 m6 offset-m3 s8 offset-s2">
        <div class="card z-depth-5" style="margin-top: 10%; background: rgba(255, 0, 0, 0.2); max-height: 100%;">
          <div class="card-action ">
            <h3 class="center white-text">Log In</h3>
            <div class="row center">
            <?php
            if(isset($_SESSION['message']))
            {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
          ?>
            </div>
            
          </div>
          <div class="divider"></div>
          <div class="card-content">
            <div class="row">
              <div class="input-field col s12 ">
                <input placeholder="Enter Email" name="username" id="username" type="email" required>
                <label for="username">Username</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" name="password" placeholder="Enter Password" required class="validate">
                <label for="password">Password</label>
                <span class="helper-text" data-error="Invalid"></span>
              </div>
            </div>
            <div class="row">
              <label for="check">
                <input type="checkbox" id="check" class="filled-in" required />
                <span style="font-size: medium;" class="white-text text-lighten-4">Remember Me</span>
              </label>
            </div>
            <div class="row">
              <div class="center ">
                <input type="submit" name="submit" value="Log In"
                  class="btn btn-large teal-text transparent hoverable ">
              </div>
            </div>

          </div>
        </div>
      </div>


    </div>
  </form>

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
<script type="text/javascript" src="js/materialize.js"></script>
<script type="text/javascript" src="jqueryui/jquery-ui.js"></script>
<script>
  $('document').ready(function () {


  });
</script>

</html>