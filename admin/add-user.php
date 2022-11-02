<?php

include 'partials/header.php';


$firstname = $_SESSION['add-user-data']['fname'] ?? null;
$lastname = $_SESSION['add-user-data']['lname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email= $_SESSION['add-user-data']['email'] ?? null;
$password = $_SESSION['add-user-data']['pass'] ?? null;
$confirm_password = $_SESSION['add-user-data']['confirm_pass'] ?? null;  
unset($_SESSION['add-user-data']); 

?>



    <section class="form_section">
        <div class="container form_section_container">
            <h2>Add user</h2>
            <?php if(isset($_SESSION['add-user'])) :  ?>

            <div class="alert_message error">
                <p><?= $_SESSION['add-user']  ;
                unset($_SESSION['add-user']); ?>
                 </p>
            </div>
            <?php endif ?>

            <form action="add-user-logic.php" method="POST" enctype="multipart/form-data">
                <input type="text"  name="fname" value="<?= $firstname  ?>"  placeholder="first name">
                <input type="text"  name="lname" value="<?= $lastname  ?>" placeholder="last name">
                <input type="text"  name="username" value="<?= $username  ?>" placeholder="username">
                <input type="email"  name="email" value="<?= $email  ?>" placeholder="email">
                <input type="password"  name="password" value="<?= $password  ?>" placeholder="create password">
                <input type="password" name="c-password" value="<?= $confirm_password  ?>"  placeholder="confirm password">
                <select name="user-role" >
                    <option value="0">seller</option>
                    <option value="1">admin</option>
                </select>
                <div class="form_control">
                    <label for="avatar">user avatar</label>
                    <input type="file" name="avatar"  id="avatar" >
                </div>
                <button class="btn" name="submit"  type="submit">Add user</button>
            </form>
        </div>
    </section>


    <?php

include '../partials/footer.php';

?>