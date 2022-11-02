<?php

include 'partials/header.php';

$current_user_id = $_SESSION['usr-id'];
$query = "SELECT * FROM users WHERE NOT id=$current_user_id";

$users = mysqli_query($connection,$query);

?>


    <section class="dashboard">
        <?php if(isset($_SESSION['add-user-success'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['add-user-success']  ;
                unset($_SESSION['add-user-success']); ?>
                 </p>
            </div>
            
            <?php endif ?>
            <?php if(isset($_SESSION['edit-user-success'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['edit-user-success']  ;
                unset($_SESSION['edit-user-success']); ?>
                 </p>
            </div>
            
            <?php endif ?>
            <?php if(isset($_SESSION['edit-user'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['edit-user']  ;
                unset($_SESSION['edit-user']); ?>
                 </p>
            </div>
            
            <?php endif ?>
             <?php if(isset($_SESSION['user-dlt-success'])) :  ?>

            <div class="alert_message suces">
                <p><?= $_SESSION['user-dlt-success']  ;
                unset($_SESSION['user-dlt-success']); ?>
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
                        <a href="manage-user.php" class="active">manage user</a>
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
                <h2>manage-users</h2>
                <?php if(mysqli_num_rows($users)>0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>username</th>
                            <th>edit</th>
                            <th>delete</th>
                            <th>admin</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php while($user = mysqli_fetch_assoc($users)) : ?>
                        <tr>
                            <td> <?= $user['firstname']?>&nbsp;&nbsp;<?=$user['lastname'] ?> </td>
                            <td><?=$user['username']  ?> </td>
                            <td><a href="edit-user.php?id=<?= $user['id'] ?>" class="btn ">edit</a></td>
                            <td><a href="delete-user.php?id=<?= $user['id'] ?>"  class="btn sm danger">delete</a></td>
                            <td> <?= $user['is_admin']  ?'yes'  : 'NO'  ?></td>
                        </tr>  
                        <?php endwhile ?>                     
                       
                    </tbody>
                </table>
                <?php else :?>
                    <div class="alert_message error"> <?= "NO USERS FOUND "?></div>
                    <?php endif ?>
            </main>
        </div>
    </section>
   

    <?php

include '../partials/footer.php';

?>