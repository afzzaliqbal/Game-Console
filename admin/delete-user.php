<?php 

require 'config/database.php';

if(isset($_GET['id']))
{
    
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $user = mysqli_fetch_assoc($result);
    $name =$user['firstname'];

    if(mysqli_num_rows($result)==1)
    { 
       $avatar_name =$user['avatar']    ;
       $avatar_path = '../images/'.$avatar_name;

       if($avatar_path){
        unlink($avatar_path);
       }

    }

    $thumbnail_query ="SELECT thumbnail FROM  post WHERE auther_id = $id";
    $thumbnail_result = mysqli_query($connection,$thumbnail_query);
    if(mysqli_num_rows($thumbnail_result)==1)
    { 
       $thumbnail_name =$user['avatar']    ;
       $thumbnail_path = '../images/'.$thumbnail_name;

       if($thumbnail_path){
        unlink($thumbnail_path);
       }

    }
   

    $dlt_usr_query ="DELETE  FROM users WHERE id = $id";
   $res = mysqli_query($connection,$dlt_usr_query);
    if(mysqli_errno($connection))
    {
        $_SESSION['user-dlt'] ="couldn't delete that user";

    }
    else{
        $_SESSION['user-dlt-success'] = "$name is delete successfully";
       
    }
    
}
header('location:'.ROOT_URL.'admin/manage-categories.php' );