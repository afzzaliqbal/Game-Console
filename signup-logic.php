<?php

require 'admin/config/database.php';
session_start();

if(isset($_POST['submit']))
{
   $fname=filter_var($_POST['fname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $lname=filter_var($_POST['lname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $username=filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $email=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
   $pass=filter_var($_POST['pass'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $confirm_pass=filter_var($_POST['confirm_pass'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   $avatar=$_FILES['avatar'];



   if(!$fname){
    $_SESSION['signup'] = 'please enter the first name';
   }
   elseif(!$lname){
    $_SESSION['signup'] = 'please enter the last name';
   }
   elseif(!$username){
    $_SESSION['signup'] = 'please enter the user name';
   }
   elseif(!$email){
    $_SESSION['signup'] = 'please enter a valid email';
   }
   elseif(!$avatar['name']){
    $_SESSION['signup'] = 'please add the image';
   }
   else
   {
         if($pass !== $confirm_pass)
        {
            $_SESSION['signup'] = 'passwords doesnot match';

        }
        else
        {
            $hashed_password=password_hash($pass,PASSWORD_DEFAULT);

                    $user_check_query = " SELECT * FROM users WHERE username ='$username' OR email='$email'";
                    $user_check_result=mysqli_query($connection,$user_check_query);
                    if(mysqli_num_rows($user_check_result)>0){

                        $_SESSION['signup'] = 'email or username is already exist';
                    }
                    else
                    {
                        $time =time();
                        $avatar_name=$time.$avatar['name'];
                        $avatar_tmp_name=$avatar['tmp_name'];
                        $avatar_destination_path='images/'. $avatar_name;

                        $allowed_files = ['png','jpg','jpeg'];
                        $extention =explode('.',$avatar_name);
                        $extention =end($extention);

                        if(in_array($extention,$allowed_files))
                        {
                           
                                move_uploaded_file($avatar_tmp_name,$avatar_destination_path);
                            

                        }
                        else
                        {
                            $_SESSION['signup'] = 'The image file type must be in png ,jpg,jpeg format';
                        }
                    }
        }
   }

if(isset($_SESSION['signup']) )
{
    $_SESSION['signup-data'] =$_POST;
    header('location:'. ROOT_URL .'signup.php' );
    die();
}
else
{
    $user_insert_query = "INSERT INTO users (firstname,lastname,username,email,password,avatar,is_admin) VALUES ('$fname','$lname','$username','$email','$hashed_password','$avatar_name','0')" ;
    $insert_user_result = mysqli_query($connection,$user_insert_query);
            if(!mysqli_errno($connection))
            {
                $_SESSION['signup-success'] = "Registration success ";
                header('location:'. ROOT_URL .'signin.php' );
                die();
            }



}
 

}
else
{
    header('location:'. ROOT_URL .'signup.php' );
    die();
}