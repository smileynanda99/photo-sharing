<?php
  session_start();
  include"includes/connection.php";
  if($conn)
  {
    if(isset($_POST['submit']))
    {    
        include"includes/security.php";
        include"includes/connection.php";
        $id=$_SESSION['username'];
        $key=$id;
        $key=setKey($key);  //key for encrypting
        $image=$_FILES['post'];
        if(isset($image['type']))
        {
      
            if($image['type']=="image/jpg" || $image['type']=="image/jpeg" || $image['type']=="image/png" )
            {  
   
              if($image['size']<=2097152 )
              {
               $sql="select * from post ";
               $res=mysqli_query($conn,$sql);
               $i=mysqli_num_rows($res)+1;
               $photo=$i.".jpg";
               move_uploaded_file($image['tmp_name'],"post_image/".$photo);
               $photo=secure($photo);
               $photo=encrypt($photo,$key);
               $name=$_POST['name'];
               $title=$_POST['title'];
               $date=$_POST['date'];
               $content=$_POST['content'];
               $name=secure($name);
               $name=encrypt($name,$key);
               $title=secure($title);
               $title=encrypt($title,$key);
               $date=secure($date);
               $date=encrypt($date,$key);
               $content=secure($content);
               $content=encrypt($content,$key);
               $sql1="insert into post(name,id,title,date,content,post_photo) 
               values('$name','$id','$title','$date','$content','$photo')";
               $res1=mysqli_query($conn,$sql1);
               if($res1)
               {
                 
                   $_SESSION['upload']="<div class='chip center green white-text' >Post Successfully published,
                   Thanks!!..</div>";
                   header("Location:upload.php");
                   
               }
               else
               {
                   $_SESSION['upload']="<div class='chip center red black-text' >Something Went Wrong,
                   Please Try Again </div>";
                   header("Location:upload.php");  
               }    
              }
              else
              {
               $_SESSION['upload']="<div class='chip center red black-text' >Sorry,
               Image size is More than 2MB.</div>";
               header("Location:upload.php"); 
              }
            }
            else if($image['type']=="")
            {
                $_SESSION['upload']="<div class='chip center red black-text' >Sorry,
                Image size is More than 2MB. </div>";
                header("Location:upload.php");  
            }
            else
            {
             $_SESSION['upload']="<div class='chip center red black-text' >Sorry,
             File format is not supported.</div>";
             header("Location:upload.php");  
            }
            
        }
       
        
    }
   
   }
   else
   {   $_SESSION['upload']="<div class='chip center red black-text' >Sorry,
       Something went wrong, Please Try Again</div>";
       header("Location:upload.php");
   }
   

?> 