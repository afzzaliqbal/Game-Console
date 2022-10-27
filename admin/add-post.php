<?php

include 'partials/header.php';
$query ="SELECT * FROM category";
$result =mysqli_query($connection,$query);

?>



    <section class="form_section">
        <div class="container form_section_container">
            <h2>Add post</h2>
            <?php if(isset($_SESSION['add-post'])) :  ?>

            <div class="alert_message error">
                <p><?= $_SESSION['add-post']  ;
                unset($_SESSION['add-post']); ?>
                 </p>
            </div>
            
            <?php endif ?>
            <form action="add-post-logic.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="title">
                <select name="category" >
                    <?php while($category=mysqli_fetch_assoc($result)) : ?>
                    <option value="<?=$category['id']?>"><?=$category['title']?></option>
                   <?php endwhile ?>
                </select>
                <textarea  rows="5" name="body" placeholder="body"></textarea>
                <?php if(isset($_SESSION['is_admin'])  ) : ?>
                <div class="form_control inline">
                    <input type="checkbox" name="is_featured" value="1"  id="is_featured" checked>
                    <label for="is_featured">featured</label>
                </div>
                <?php endif ?>
                <div class="form_control">
                    <label for="is_featured">Add Thumbnail</label>
                    <input type="file" name="thumbnail"  id="Thumbnail">
                </div>
                <button class="btn" name="submit" type="submit">Add post</button>
            </form>
        </div>
    </section>


    <?php

include '../partials/footer.php';

?>