<?php  
 require 'config/database.php';

 if(isset($_SESSION['usr-id']))
 {
    $id =filter_var($_SESSION['usr-id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result =mysqli_query($connection,$query);
    $user = mysqli_fetch_assoc($result);
 }

 ?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <title>Game Console Home</title>
</head>
<body>

    <!--navigation section  starts-->
    <nav>
        <div class="container nav_container">
               <div class="logo"><a href="<?php ROOT_URL ?>index.php">Game Console</a></div> 
             <ul class="nav_items">
                <li><a href="<?= ROOT_URL ?>marketplace.php">Marketplace</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
                <li><a href="<?= ROOT_URL ?>services.php">Services</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
                
                <?php if(isset($_SESSION['usr-id'])) : ?>
                <li class="nav_profile">
                    <div class="avatar"><img src="<?= ROOT_URL .'images/'.$user['avatar'] ?>" alt=""></div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">logout</a></li>
                    </ul>
                </li>
                <?php endif ?>
                <?php if(!isset($_SESSION['usr-id'])) : ?>
                    <li><a href="<?= ROOT_URL ?>signin.php">Signin</a></li>
                    <?php endif ?>  
                    
             </ul>
             <button  id="open_nav"><img src="assets/icons/menu_FILL0_wght400_GRAD0_opsz48.png" alt=""></button>
             <button id="close_nav"><img src="assets/icons/close_FILL0_wght400_GRAD0_opsz48.png" alt=""></button>
        </div>

    </nav>