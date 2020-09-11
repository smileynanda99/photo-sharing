<?php
session_start();
//check username by session and id of post by get method
if(isset($_SESSION['username']) && isset( $_GET['id']))
{   
    include"../includes/connection.php";
    include"../includes/security.php";
    $post_id= $_GET['id']; 
    $user_id=$_SESSION['username'];   
    $key=setKey($post_id);
    $user_id=secure($user_id);
    $post_id=secure($post_id);
    $conn=mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);
    $sql="select * from likes where post_id=$post_id and user_id=$user_id ";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0)
    {   $data=mysqli_fetch_assoc($res);
        //if user already like post
        if($data['status']==1)
        {   
            //for update user like status (in 1=like and 0=dislike)
            $user_like=$data['status']-1;
            $user_like=secure($user_like);
            $sql="update likes set status='$user_like' where  post_id=$post_id and user_id=$user_id ";
            $res=mysqli_query($conn,$sql);
            print_r($res);
            //for update post total like
            $sql="select * from post where post_id=$post_id ";
            $res=mysqli_query($conn,$sql);
            $info=mysqli_fetch_assoc($res);
            $post_like=decrypt($info['like_no'],$key)-1;
            $post_like=secure($post_like);
            $post_like=encrypt($post_like,$key);
            $sql="update post set like_no='$post_like' where  post_id=$post_id ";
            $res=mysqli_query($conn,$sql);
            header("Location:../resent_post.php");
        }
        //if user  dislike post
        if($data['status']==0)
        {   
            //for update user like status
            $user_like=$data['status']+1;
            $user_like=secure($user_like);
            $sql="update likes set status='$user_like'
             where  post_id=$post_id and user_id=$user_id  ";
            $res=mysqli_query($conn,$sql);
            //for update post total like
            $sql="select * from post where post_id=$post_id ";
            $res=mysqli_query($conn,$sql);
            $info=mysqli_fetch_assoc($res);
            $post_like=decrypt($info['like_no'],$key)+1;
            $post_like=secure($post_like);
            $post_like=encrypt($post_like,$key);
            $sql="update post set like_no='$post_like' where  post_id=$post_id ";
            $res=mysqli_query($conn,$sql);
            header("Location:../resent_post.php");
        }
    }
    else
    {   
        //for update user like status 
        $user_like=1;
        $user_like=secure($user_like);
        $sql="insert into likes(post_id,user_id,status) 
        values('$post_id','$user_id','$user_like')";
        $res=mysqli_query($conn,$sql);
        //for update post total like
        $sql="select * from post where post_id=$post_id ";
        $res=mysqli_query($conn,$sql);
        $info=mysqli_fetch_assoc($res);
        $post_like=decrypt($info['like_no'],$key)+1;
        $post_like=secure($post_like);
        $post_like=encrypt($post_like,$key);
        $sql="update post set like_no='$post_like' where  post_id=$post_id ";
        $res=mysqli_query($conn,$sql);
        header("Location:../resent_post.php");
    }
}

?>