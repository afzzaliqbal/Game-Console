<?php
session_start();
require 'config/database.php';

$username_or_email = $_SESSION['signin-data']['username_or_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>signin</title>
</head>
<body>
    <section class="form_section">
        <div class="container form_section_container">
            <h2>signin</h2>
            <?php if (isset($_SESSION['signup-success']))  : ?>
            <div class="alert_message suces">
                <p>
                     <?= $_SESSION['signup-success'] ;
                     unset( $_SESSION['signup-success']) ;
                      ?>
               </p>
            </div>
            <?php elseif (isset($_SESSION['signin']))  : ?>
            <div class="alert_message error">
                <p>
                     <?= $_SESSION['signin'] ;
                     unset( $_SESSION['signin']) ;
                      ?>
               </p>
            </div>
            <?php endif  ?>
            <form action="<?php echo ROOT_URL ?>signin-logic.php" method="POST">
                
                <input type="text" name="username_or_email"  value="<?= $username_or_email  ?>" placeholder="username or email">
                <input type="password" name="password"  value="<?= $password  ?>" placeholder="password">
                <button class="btn" name="submit" type="submit">Sign in</button>
                <small>Don't you have an account? <a href="signup.php">signup</a></small>
            </form>
        </div>
    </section>
</body>
</html>