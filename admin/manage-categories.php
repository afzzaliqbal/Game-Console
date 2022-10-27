<?php

include 'partials/header.php';

$query = "SELECT * FROM category ORDER BY  title";
$categories = mysqli_query($connection,$query);

?>


    <section class="dashboard">
         <?php if(isset($_SESSION['edit-cat-success'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['edit-cat-success']  ;
                unset($_SESSION['edit-cat-success']); ?>
                 </p>
            </div>
            
            <?php endif ?>
             <?php if(isset($_SESSION['cat-dlt-success'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['cat-dlt-success']  ;
                unset($_SESSION['cat-dlt-success']); ?>
                 </p>
            </div>
            
            <?php endif ?>
            <?php if(isset($_SESSION['add-category-success'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['add-category-success']  ;
                unset($_SESSION['add-category-success']); ?>
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
                        <a href="index.php">manage post</a>
                    </li>

                    <?php if(isset($_SESSION['is_admin'])) : ?>


                    <li>
                        <a href="add-user.php">add user</a>
                    </li>
                    <li>
                        <a href="manage-user.php">manage user</a>
                    </li>
                    <li>
                        <a href="add-category.php">add category</a>
                    </li>
                    <li>
                        <a href="manage-categories.php" class="active">manage category</a>
                    </li>

                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>manage-categories</h2>
                <?php if(mysqli_num_rows($categories)>0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php while($category = mysqli_fetch_assoc($categories)) :?>
                        <tr>
                            <td><?= $category['title'] ?></td>
                            <td><a href="edit-category.php?id=<?= $category['id'] ?>" class="btn ">edit</a></td>
                            <td><a href="delete-category.php?id=<?= $category['id'] ?>" class="btn sm danger">delete</a></td>
                        </tr>
                       <?php endwhile ?>
                    </tbody>
                </table>
                <?php else :?>
                    <div class="alert_message error"> <?= "NO categories FOUND "?></div>
                    <?php endif ?>
            </main>
        </div>
    </section>
   

    <?php

include '../partials/footer.php';

?>