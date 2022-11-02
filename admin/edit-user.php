<?php

include 'partials/header.php';


if(isset($_GET['id']))
{
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $qry = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection,$qry);
    $users = mysqli_fetch_assoc($result);      
}
else
{
    header('location:'.ROOT_URL.'admin/manage-user.php');
    die();
}

?>



    <section class="form_section">
        <div class="container form_section_container">
            <h2>edit user</h2>
            <form action="edit-user-logic.php" enctype="multipart/form-data" method="POST" >
            <input type="hidden" value="<?= $users['id'] ?>"  name="id">   
            <input type="text" value="<?= $users['firstname'] ?>"  name="firstname" placeholder="first name">
                <input type="text" value="<?= $users['lastname'] ?>" name="lastname" placeholder="last name">
                <label for="user_role">user type</label>
                <select name="user-role" >
                    <option value="0">seller</option>
                    <option value="1">admin</option>
                </select>
                <button class="btn" name="submit" type="submit">update user</button>
            </form>
        </div>
    </section>


    <?php

include '../partials/footer.php';

?>