
<?php 

require 'config/database.php';

if(isset($_POST['submit']))
{
    $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $firstname = filter_var($_POST['firstname'],FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'],FILTER_SANITIZE_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['user-role'],FILTER_SANITIZE_NUMBER_INT);
    if(!$lastname || !$firstname )
    {
          $_SESSION['edit-user'] = "the fields canot be null";
    }
    else
    {
        $query ="UPDATE users SET firstname='$firstname' ,lastname='$lastname' ,is_admin='$is_admin' WHERE id='$id' LIMIT 1";
        $result = mysqli_query($connection,$query);

        if(mysqli_errno($connection))
    { 
            $_SESSION['edit-user'] ="failed to update";
    }
    else
    {
        $_SESSION['edit-user-success'] = "$firstname  $lastname is updated successsfully";
        header('location:'.ROOT_URL.'admin/manage-user.php');
    }
    }

}
else{
    header('location:'.ROOT_URL.'admin/edit-user.php');
    die();
}
   
