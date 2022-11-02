<?php

include 'partials/header.php';
if(isset($_GET['id']))
{
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM category WHERE id=$id";
    $result = mysqli_query($connection,$query);
   
    if(mysqli_num_rows($result)==1)
    {
        $category = mysqli_fetch_assoc($result);
    }


}
else{
    header('location:'.ROOT_URL.'manage-categories.php');
    die();
}

?>



    <section class="form_section">
        <div class="container form_section_container">
            <h2>edit Category</h2>
             <?php if(isset($_SESSION['edit-cat'])) :  ?>

            <div class="alert_message error">
                <p><?= $_SESSION['edit-cat']  ;
                unset($_SESSION['edit-cat']); ?>
                 </p>
            </div>
            <?php endif ?>
           
            <form action="<?=ROOT_URL?>admin/edit-cat-logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $category['id'] ?>" > 
                <input type="text" name="title" value="<?= $category['title'] ?>" placeholder="title">
                <textarea  rows="3" name="description" placeholder="description"><?= $category['description'] ?></textarea>
                <button class="btn" name="submit" type="submit">update Category</button>
            </form>
        </div>
    </section>


    <?php

include '../partials/footer.php';

?>