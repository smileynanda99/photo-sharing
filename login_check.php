<?php
  session_start();
  include"includes/connection.php";
  include"includes/security.php";
  if($conn)
  {  
    if(isset($_POST['submit']))
    {
        $username=$_POST['username'];
        $key=setKey($username);  //key for encrypting
        $username=strtolower($username);
        $username=secure($username);
        $temp=$username;
        $username=encrypt($username,$key);
        $password=$_POST['password'];
        $password=secure($password);
        $sql="select * from user ";
        $res=mysqli_query($conn,$sql);
        if($res)
        {  
        while($data=mysqli_fetch_assoc($res))
        {
            if(decrypt($data['email'],$key)==$temp)
            {
                if(password_verify($password,$data['password']))
                {   
                    $_SESSION['username']=$data['id'];
                    $_SESSION['key']=$temp;
                    header("Location:home.php");  
                }
                else
                {
                    $_SESSION['message']="<div class='chip center red black-text' >
                    Please Enter A valid Username and Password </div>";
                    header("Location:login.php");  
                }  
            } 
           
        }  
        }
        else
        {
            $_SESSION['message']="<div class='chip center red black-text' >
            This Username is not Exist,Please Signup before Login</div>";
            header("Location:login.php");
        }
      
    }
    else
    {   $_SESSION['message']="<div class='chip center red black-text' >Sorry,
        Something went wrong, Please Try Again</div>";
        header("Location:login.php");
    }
   }
   

?> 