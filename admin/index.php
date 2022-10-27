<?php

include 'partials/header.php';

$current_user_id =$_SESSION['usr-id'];
$query ="SELECT id,title,category_id FROM post  WHERE auther_id =$current_user_id ORDER BY id DESC";
$posts = mysqli_query($connection,$query);

?>


    <section class="dashboard">
         <?php if(isset($_SESSION['add-post-success'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['add-post-success']  ;
                unset($_SESSION['add-post-success']); ?>
                 </p>
            </div>
            
            <?php endif ?>
             <?php if(isset($_SESSION['edit-post-success'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['edit-post-success']  ;
                unset($_SESSION['edit-post-success']); ?>
                 </p>
            </div>
            
            <?php endif ?>
            <?php if(isset($_SESSION['edit-post-error'])) :  ?>

            <div class="alert_message error">
                <p><?= $_SESSION['edit-post-error']  ;
                unset($_SESSION['edit-post-error']); ?>
                 </p>
            </div>
            
            <?php endif ?>
            <?php if(isset($_SESSION['post-dlt-success'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['post-dlt-success']  ;
                unset($_SESSION['post-dlt-success']); ?>
                 </p>
            </div>
            
            <?php endif ?>
            <?php if(isset($_SESSION['post-dlt'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['post-dlt']  ;
                unset($_SESSION['post-dlt']); ?>
                 </p>
            </div>
            
            <?php endif ?>
        <div class="container dashboard_container">
            <aside>
                <ul>
                    <li>
                        <a href="add-post.php">add post</a>
                    </li>
                    <li>
                        <a href="index.php" class="active">manage post</a>
                    </li>

                    <?php if(isset($_SESSION['is_admin'])) : ?>

                    <li>
                        <a href="add-user.php">add user</a>
                    </li>
                    <li>
                        <a href="manage-user.php" >manage user</a>
                    </li>
                    <li>
                        <a href="add-category.php">add category</a>
                    </li>
                    <li>
                        <a href="manage-categories.php" >manage category</a>
                    </li>
                    <?php endif ?>
                    
                </ul>
            </aside>
            <main>
                <h2>manage posts </h2>
                <?php if(mysqli_num_rows($posts)>0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>category</th>
                            <th>edit</th>
                            <th>delete</th>
                            
                        </tr>

                    </thead>
                    <tbody>
                        <?php while($post = mysqli_fetch_assoc($posts)) : ?>
                            <?php 
                                
                                $category_id = $post['category_id'];
                                $category_query = "SELECT title FROM category WHERE id=$category_id";
                                $category_result =mysqli_query($connection,$category_query);
                                $category=mysqli_fetch_assoc($category_result);

                            ?>
                        <tr>
                            <td><?= $post['title'] ?></td>
                            <td><?=$category['title'] ?></td>
                            <td><a href="<?=ROOT_URL?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn ">edit</a></td>
                            <td><a href="<?=ROOT_URL?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn sm danger">delete</a></td>
                        </tr>
                       
                       <?php endwhile?>
                    </tbody>
                </table>
                <?php else :?>
                    <div class="alert_message error">posts are empty</div>
                    <?php endif?>
            </main>
        </div>
    </section>
   

    

    <?php

include '../partials/footer.php';

    ?>