<?php
ob_start();
session_start();
if(isset($_SESSION['username']) &&isset($_GET['id']))
{
 include"includes/security.php";
 include"includes/connection.php";
 $id=$_SESSION['username'];
 $key=$_SESSION['key'];
 $key=setKey($key); 
 $post_key=setKey($_GET['id']); //key for encrypting
 $post_id= $_GET['id']; 
 $id=secure($id);
 $post_id=secure($post_id);
 $sql="select * from user where  id=$id";
 $res=mysqli_query($conn,$sql);
 $info=mysqli_fetch_assoc($res);
 $sql1="select * from post where  post_id=$post_id";
 $res1=mysqli_query($conn,$sql1);
 $info1=mysqli_fetch_assoc($res1);
 $new=setkey($info1['id']);
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

    .input-field label {
      color: teal;
      font-size: 1.6rem;

    }   header {
      background-image: url(image/a.jpg);
      background-size: cover;
      background-position: center;
    }

    .chip {
      background-color: teal;
      color: white;
    }
  </style>
</head>
<body>
  <!--navbar and header-->
  <header>
    <nav class=" transparent">
      <div class="navbar-wrapper transparent">
        <!--Brand Logo and menu -->
        <a href="#" class="brand-logo  logo red-text center" style="margin-left: 50px;">
          RKNANDA<i class="fa fa-mortar-board tiny right black-text valign-wrapper"></i></sup>
        </a>
        <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="profile.php">
                        <div class="chip ">
                                <img src="<?php if($info['photo'])
                                                        echo "profile_image/".decrypt($info['photo'],keys());
                                                     else
                                                        echo "profile_image/defaulat.png";?>" alt=""
                                                         class="circle responsive-img">
                                   <?php
                                      echo decrypt($info['fname'],keys());
                                   ?>
                        </div>
                        </a>
                   </li>
                   <li>
                        <a href="home.php" class="modal-trigger">
                            <div class="chip">
                                <i class="fa fa-home tiny red-text  text-darken-1"></i> Home
                            </div>
                        </a>
                  </li>
         </ul>
      </div>
    </nav>
  </header>

<!--Comment content-->
<div class="row " style="margin-top: 1%;">
   <div class="col l6 m8 offset-m2 s12">
       <div class="card">
           <div class="card-image" >
            <img class="materialboxed " data-caption="<?php echo "Publish by ".decrypt($info1['name'],$new)." on ".decrypt($info1['date'],$new)." Date";     
                                                               echo ". ".decrypt($info1['content'],$new); ?>"
                 src="post_image/<?php echo decrypt($info1['post_photo'],$new); ?>"  alt="" height="500px" class="circle"> 
            <span class="card-title "><?php echo decrypt($info1['title'],$new);?></span>   
           </div>
           <div class="card-action">
               <a href="like/like_c.php?id=<?php echo $info1['post_id'];?>" class="tooltipped"  data-tooltip="Like" >
                <div class="chip teal white-text">
                    <i class="fa fa-heart tiny  <?php
                                                  $sql2="select * from likes where post_id=$post_id and user_id=$id ";
                                                  $res2=mysqli_query($conn,$sql2);
                                                  $data=mysqli_fetch_assoc($res2);
                                                  if($data['status']==1)
                                                   {echo "red-text";}
                                                  else
                                                   {echo "white-text";}
                                                ?> "> </i> &#160;
                                               <?php
                                                   echo decrypt($info1['like_no'],$post_key);
                                               ?>
                </div>
               </a>
               <a  href="#!" class="tooltipped"  data-tooltip="Comments">
                <div class="chip teal white-text">
                    <i class="fa fa-comment tiny white-text"></i> &#160;<?php
                                                                  echo decrypt($info1['comment_no'],$post_key);
                                                                  ?>
                </div>
               </a>
               <a download="<?php echo decrypt($info1['post_photo'],$new);?>" href="post_image/<?php echo decrypt($info1['post_photo'],$new)?>"
               class="tooltipped"  data-tooltip="Save" >
                <div class="chip teal white-text">
                    <i class="fa fa-download tiny white-text"></i> save
                </div>
               </a>
           </div>
       </div>
   </div>
   <div class="col l6 m8 offset-m2 s12">       
   <ul class="collection with-header">

    <li class="collection-header">
        <h4 style="font-size: xx-large;">Comments</span>
       
    </li>
    <li class="collection-item avatar ">
       <form action="" method="POST">
       <div class="col s10 ">
             <input type="text" id="name" name="name" placeholder="Drop Comment..">
         </div>
        <div class="col s2 ">
            <input type="submit" value="send" name="submit"  class="btn ">
        </div>
       </form>
       <?php
              if(isset($_POST['name']))
              {
              if(isset($_SESSION['username'])&& isset($_POST['submit']))
              {
               $post_id=$_GET['id'];
               $post_id=secure($post_id);
               $id=$_SESSION['username'];//////
               $new=setKey($id);
               $id=secure($id);
               $comment=$_POST['name'];//////
               $comment=secure($comment);
               $comment=encrypt($comment,$new);
               $sql=" insert into comments(post_id,user_id,comment) 
               values('$post_id','$id','$comment')";
               $res=mysqli_query($conn,$sql);
               
              
               $sql="select * from post where post_id=$post_id";
               $res=mysqli_query($conn,$sql);
               $info=mysqli_fetch_assoc($res);
               $comment_no=decrypt($info['comment_no'],$post_key);/////
               $comment_no=$comment_no+1;
               $comment_no=encrypt($comment_no,$post_key);
               $sql="update post set comment_no='$comment_no' where  post_id=$post_id";
               $res=mysqli_query($conn,$sql);
               
              }
            }
          
       ?>
     </li>
     <?php
          $sql2="select * from comments where post_id=$post_id order by comment_id desc ";
          $res2=mysqli_query($conn,$sql2);
          if(mysqli_num_rows($res2)>0)
          {
             while($data=mysqli_fetch_assoc($res2))
            { $cmdkey=setKey($data['user_id']);
              $user_id=$data['user_id'];
              $sql3="select * from user where id=$user_id" ;
              $res3=mysqli_query($conn,$sql3);
              $info3=mysqli_fetch_assoc($res3);
       ?>
    <li class="collection-item avatar">
          <img src="profile_image/<?php if($info3['photo'])
          {
            echo decrypt($info3['photo'],keys());
          }
          else{
              echo "defaulat.png";
          }?>
          " class="circle" alt="">
          <span class="title"><?php echo decrypt($info3['fname'],keys())." ".decrypt($info3['lname'],keys());?></span>
          <p><?php echo decrypt($data['comment'],$cmdkey);?></p>
          
    </li>
       <?php
             }
           }
           else
           {
             ?>
     <li class="collection-item avatar">       
             <?php
               echo "<div class='chip  green white-text' >Be the first to Comment</div>";
              
             ?>
     </li>         
             <?php
           }
       ?>
   
    </ul>
    </div>
  </div>
  <?phpecho ($info1['like_no']);?>

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
<script>
  $('document').ready(function () {
        
        $('#name').keyup(function(){
            var name =$(this).val();
            $.ajax({
                type: 'post',
                data: {name:name},
                success: function(res){
                    console.log(res);
                }
            });
        });
        
        
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