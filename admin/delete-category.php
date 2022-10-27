<?php 

require 'config/database.php';

if(isset($_GET['id']))
{
    
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

    $update_query = "UPDATE post SET category_id=16 WHERE category_id=$id  ";
    $update_result =mysqli_query($connection,$update_query);

   
   
    if(mysqli_errno($connection))
    {
        $_SESSION['cat-dlt'] ="couldn't delete that user";

    }
    else{
        $dlt_cat_qry ="DELETE  FROM category WHERE id = $id";
        $res = mysqli_query($connection,$dlt_cat_qry);
        $_SESSION['cat-dlt-success'] = "deleted successfully";
       
    }
    
}
header('location:'.ROOT_URL.'admin/manage-categories.php' );