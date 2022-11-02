
<?php 

require 'config/database.php';


if(isset($_POST['submit']))
{
   $title=filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $description=filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  if(!$title){
    $_SESSION['add-category'] = "please enter the title";
  }
  elseif(!$description)
  {
    $_SESSION['add-category']="please enter the discription";
  } 


  if(isset($_SESSION['add-category']))
  {
    $_SESSION['add-category-data'] =$_POST;
    header('location:'.ROOT_URL.'admin/add-category.php');
    die();
  }else{
 
    $query ="INSERT INTO category (title,description) VALUES('$title','$description')";
    $result =mysqli_query($connection,$query);
    if(mysqli_errno($connection))
    {
        $_SESSION['add-category']="couldn't add category";
        header('location:'.ROOT_URL.'admin/add-category.php');
        die();
    }
    else{
        $_SESSION['add-category-success']="successfully added category";
        header('location:'.ROOT_URL.'admin/manage-categories.php');
        die();
    }
}
} 
