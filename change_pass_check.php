<?php
  session_start();
  include"includes/connection.php";
  include"includes/security.php";

  if($conn)
  {
    if(isset($_POST['submit']))
    {   
        $id=$_SESSION['username'];
        $key=$_SESSION['key'];
        $key=setKey($key);  //key for encrypting
        $password=$_POST['old'];
        $password=secure($password);
        $sql="select * from user where id=$id";
        $res=mysqli_query($conn,$sql);
        $data=mysqli_fetch_assoc($res);
        if(password_verify($password,$data['password']))
        {   
            $password1=$_POST['new'];
            $password1=secure($password1);
            $password1=password_hash($password1,PASSWORD_BCRYPT);
            $sql1="update user set password='$password1'  where id=$id ";
            $res1=mysqli_query($conn,$sql1);
            if($res1)
            {  
                $_SESSION['message']="<div class='chip center green white-text' >Your Password Have been
                 Updated Successfully </div>";
                header("Location:change_pass.php");   
            }
            else
            {
                $_SESSION['message']="<div class='chip center red black-text' >Something Went Wrong,
                Please Try Again </div>";
                header("Location:change_pass.php");  
            }   
             
        }
        else
        {
            $_SESSION['message']="<div class='chip center red black-text' >
            Please Enter Right Old Password</div>";
            header("Location:change_pass.php");  
        }    
      
    }
    else
    {   $_SESSION['message']="<div class='chip center red black-text' >Sorry,
        Something went wrong, Please Try Again</div>";
        header("Location:change_pass.php");
    }
  }
   

?> 