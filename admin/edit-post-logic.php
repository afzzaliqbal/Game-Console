<?php

require 'config/database.php';

if(isset($_POST['submit']))
{
    $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $title = filter_var($_POST['title'],FILTER_SANITIZE_SPECIAL_CHARS);
    $category_id = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
    $body = filter_var($_POST['body'],FILTER_SANITIZE_SPECIAL_CHARS);
    $prev_thumbnail_name =filter_var($_POST['prev_thumbnail'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_featured = filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT);
    $thumbnail=$_FILES['thumbnail'];

    if(!$title )
    {
          $_SESSION['edit-post-error'] = "please enter the title";
    }
    elseif(!$body )
    {
          $_SESSION['edit-post-error'] = "please enter the body";
    }
    elseif(!$thumbnail['name'] )
    {
          $_SESSION['edit-post-error'] = "please upload a thumbnail";
    }
    else
    {
        $time =time();
        $thumbnail_name=$time.$thumbnail['name'];
        $thumbnail_tmp_name=$thumbnail['tmp_name'];
        $thumbnail_destination_path='../images/'. $thumbnail_name;

        $allowed_files = ['png','jpg','jpeg'];
        $extention =explode('.',$thumbnail_name);
        $extention =end($extention);

        if(in_array($extention,$allowed_files))
        {
            if($thumbnail['size']>1000000)
            {
                move_uploaded_file($thumbnail_tmp_name,$thumbnail_destination_path);
            }
            else
            {
                $_SESSION['edit-post-error'] = 'The image file size is greater than 5 mb';
            }
        }
        else
        {
            $_SESSION['edit-post-error'] = 'The image file type must be in png ,jpg,jpeg format';
        }
    }
                       
if(isset($_SESSION['edit-post-error']) )
{
    
    header('location:'. ROOT_URL .'admin/' );
    die();
}
else
{
    if($is_featured==1)
    {
        $zero_all_is_featured_query = "UPDATE post SET is_featured=0";
        $zero_all_is_featured_result = mysqli_query($connection,$zero_all_is_featured_query);
    }

    $thumbnail_to_insert =$thumbnail_name ?? $prev_thumbnail_name;

    $edit_post_query = "UPDATE post SET title='$title',body='$body',thumbnail='$thumbnail_to_insert',category_id='$category_id',is_featured='$is_featured' WHERE id='$id' LIMIT 1 ";
    $edit_post_result = mysqli_query($connection,$edit_post_query);
            if(!mysqli_errno($connection))
            {
                $_SESSION['edit-post-success'] = "post updated successfully ";
                header('location:'. ROOT_URL .'admin/index.php' );
                die();
            }



}


    


}
        
