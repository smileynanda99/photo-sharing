<?php
  session_start();
  include"includes/connection.php";
  include"includes/security.php";
  if($conn)
  {
    if(isset($_POST['submit']) )
    {     
          $id=$_SESSION['username'];
          $key=$_SESSION['key'];
          $key=setKey($key);  //key for encrypting
          $image=$_FILES['photo'];
          if(isset($image['type']))
          {
              if($image['type']=="image/jpg" || $image['type']=="image/jpeg" || $image['type']=="image/png")
              { 
                  if($image['size']<=2097152)
                  {
                      $photo=$id.".jpg";
                      move_uploaded_file($image['tmp_name'],"profile_image/".$photo);
                      $fname=$_POST['fname'];
                      $lname=$_POST['lname'];
                      $email=$_POST['email'];
                      $phone=$_POST['phone'];
                      $dob=$_POST['dob'];
                      $city=$_POST['city'];
                      $state=$_POST['state'];
                      $fname=secure($fname);
                      $fname=encrypt($fname,keys());
                      $lname=secure($lname);
                      $lname=encrypt($lname,keys());
                      $email=secure($email);
                      $email=encrypt($email,$key);
                      $Phone=secure($Phone);
                      $phone=encrypt($phone,$key);
                      $dob=secure($dob);
                      $dob=encrypt($dob,$key);
                      $city=secure($city);
                      $city=encrypt($city,$key);
                      $state=secure($state);
                      $state=encrypt($state,$key);
                      $photo=encrypt($photo,keys());
                      $sql="update user set fname='$fname', lname='$lname', email='$email', phone='$phone', city='$city', 
                      state='$state', dob='$dob', photo='$photo'  where id=$id ";
                      $res=mysqli_query($conn,$sql);
                      if($res)
                      {  
                          $_SESSION['profile']="<div class='chip center green white-text' >Your profile Have been
                          Updated Successfully </div>";
                          header("Location:profile.php");   
                      }
                      else
                      {
                          $_SESSION['profile']="<div class='chip center red black-text' >Something Went Wrong,
                          Please Try Again </div>";
                          header("Location:profile.php");  
                      }  

                  }
                  else
                  {
                      $_SESSION['profile']="<div class='chip center red black-text' >Sorry,
                      Image size is More than 2MB.</div>";
                      header("Location:profile.php"); 
                  }

              }
              else if($image['type']=="")
              {
              $_SESSION['profile']="<div class='chip center red black-text' >Sorry,
              Image size is More than 2MB. </div>";
              header("Location:profile.php");  
              }
              
              else
              {
                $_SESSION['profile']="<div class='chip center red black-text' >Sorry,
                File format is not supported.". $image['type']."</div>";
                echo $image['type'];
                header("Location:profile.php"); 
              }
            
          }
      
    }
    else
    {   $_SESSION['profile']="<div class='chip center red black-text' >Sorry,
        Something went wrong.</div>";
        header("Location:profile.php");
    }
  }

?> 