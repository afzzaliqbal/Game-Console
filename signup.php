<?php

require 'config/database.php';
session_start();

$firstname = $_SESSION['signup-data']['fname'] ?? null;
$lastname = $_SESSION['signup-data']['lname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email= $_SESSION['signup-data']['email'] ?? null;
$password = $_SESSION['signup-data']['pass'] ?? null;
$confirm_password = $_SESSION['signup-data']['confirm_pass'] ?? null;   

unset($_SESSION['signup-data']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT_URL ?>css/style.css">
    <title>signup</title>
</head>
<body>
    <section class="form_section">
        <div class="container form_section_container">
            <h2>Signup</h2>
            <?php if(isset($_SESSION['signup'])) : ?>

            <div class="alert_message error">
                <p>
                    <?= $_SESSION['signup'] ;
                    unset($_SESSION['signup']);
                    ?>

                </p>
            </div>

            <?php endif ?>
            <form action="<?php echo ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="fname" value="<?= $firstname  ?>" placeholder="first name">
                <input type="text" name="lname" value="<?= $lastname  ?>" placeholder="last name">
                <input type="text" name="username" value="<?= $username ?>" placeholder="username">
                <input type="email" name="email" value="<?= $email  ?>" placeholder="email">
                <input type="password" name="pass" value="<?= $password  ?>" placeholder="create password">
                <input type="password" name="confirm_pass" value="<?= $confirm_password ?>" placeholder="confirm password">
                <div class="form_control">
                    <label for="avatar"></label>
                    <input type="file" name="avatar" id="avatar" >
                </div>
                <button class="btn" type="submit" name="submit">Sign up</button>
                <small>Already have an account? <a href="signin.php">signin</a></small>
            </form>
        </div>
    </section>
</body>
</html>