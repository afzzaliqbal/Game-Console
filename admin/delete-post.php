<?php 

require 'config/database.php';

if(isset($_GET['id']))
{
    
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM post WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $post = mysqli_fetch_assoc($result);
    

    if(mysqli_num_rows($result)==1)
    { 
       $thumbnail_name =$post['thumbnail']    ;
       $thumbnail_path = '../images/'.$thumbnail_name;

       if($thumbnail_path){
        unlink($thumbnail_path);
       }

    }
   

    $dlt_post_query ="DELETE  FROM post WHERE id = $id";
   $res = mysqli_query($connection,$dlt_post_query);
    if(mysqli_errno($connection))
    {
        $_SESSION['post-dlt'] ="couldn't delete that user";

    }
    else{
        $_SESSION['post-dlt-success'] = "post  deleted successfully";
       
    }
    
}
header('location:'.ROOT_URL.'admin/' );