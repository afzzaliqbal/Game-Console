<?php

include 'partials/header.php';
$query = "SELECT * FROM category";
$result = mysqli_query($connection,$query);

if(isset($_GET['id']))
{
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $qry = "SELECT * FROM post WHERE id=$id";
    $rslt = mysqli_query($connection,$qry);
    $post = mysqli_fetch_assoc($rslt);      
}
else
{
    header('location:'.ROOT_URL.'admin/manage-user.php');
    die();
}



?>



    <section class="form_section">
        <div class="container form_section_container">
        <?php if (isset($_SESSION['edit-post']))  : ?>
            <div class="alert_message error">
                <p>
                     <?= $_SESSION['edit-post'] ;
                     unset( $_SESSION['edit-post']) ;
                      ?>
               </p>
            </div>
            <?php endif  ?>
            <h2>Edit post</h2>
            <form action="edit-post-logic.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $id ?>"  name="id">   
            <input type="hidden" value="<?= $post['thumbnail'] ?>"  name="prev_thumbnail">   
                <input type="text" value="<?= $post['title'] ?>" name="title" placeholder="title">
                <select name="category" >
                    <?php while($category = mysqli_fetch_assoc($result)) :?>
                    <option value="<?=$category['id']?>"><?=$category['title']?></option>
                    <?php endwhile?>
                </select>
                <textarea  rows="3" name="body"  placeholder="body"><?= $post['body'] ?></textarea>
                <div class="form_control inline">
                    <input type="checkbox" name="is_featured"  id="is_featured" checked>
                    <label for="is_featured">featured</label>
                </div>
                <div class="form_control">
                    <label for="is_featured">change Thumbnail</label>
                    <input type="file" name="thumbnail"  id="Thumbnail">
                </div>
                <button class="btn" name="submit" type="submit">update post</button>
            </form>
        </div>
    </section>


    <?php

include '../partials/footer.php';

?>