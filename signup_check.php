<?php
  session_start();
  include"includes/connection.php";
  include"includes/security.php";
  if($conn)
  {
    if(isset($_POST['submit']))
    {
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $email=strtolower($email);
        $phone=$_POST['phone'];
        $key=setKey($email);  //key for encrypting
        $temp=$email;
        $fname=secure($fname);
        $fname=encrypt($fname,keys());
        $lname=secure($lname);
        $lname=encrypt($lname,keys());
        $email=secure($email);
        $email=encrypt($email,$key);
        $phone=secure($phone);
        $phone=encrypt($phone,$key);
        $password=$_POST['password'];
        $password=secure($password);
        $password=password_hash($password,PASSWORD_BCRYPT);
        $sql="select * from user  ";
        $res=mysqli_query($conn,$sql);
        if($res)
        {
            while($data=mysqli_fetch_assoc($res))
            {
                if(decrypt($data['email'],$key)==$temp)
                {
                    $scamer=1;
                    $_SESSION['message']="<div class='chip center red black-text' >
                    You Have Already Account,Please Login to Continue </div>";
                    header("Location:login.php");  
                     
                } 
               
            }  
        
            if($scamer!=1)
            {
             $sql1="insert into user(fname,lname,email,phone,password) 
             values('$fname','$lname','$email','$phone','$password')";
             $res1=mysqli_query($conn,$sql1);
             if($res1)
             {
                $_SESSION['message']="<div class='chip center green white-text'>You Have been Successfully Registered,
                Please Login </div>"; 
                header("Location:login.php");  
             }
             else
             {
                $_SESSION['message']="<div class='chip center red black-text' >Something Went Wrong,
                Please Signup Again</div>";
                header("Location:signup.php");   
             }
            }
        }
        else
        {
            $_SESSION['message']="<div class='chip center red black-text' >Something Went Wrong,
            Please Signup Again</div>";
            header("Location:signup.php");  
        }    
    }
    else
    {   $_SESSION['message']="<div class='chip center red black-text' >Sorry,
        Something went wrong, Please Try Again</div>";
        header("Location:signup.php");
    }
   }
   

?> 