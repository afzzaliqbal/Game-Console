
   
<?php 

include 'partials/header.php';

if(isset($_GET['search']) && isset($_GET['submit']))
{
    $search = filter_var($_GET['search'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM post WHERE title LIKE '%$search%' ORDER BY date_time DESC ";
    $post_result =mysqli_query($connection,$query);


   
}else{
    header('location:'.ROOT_URL.'marketplace.php' );
}

?>
<?php if(mysqli_num_rows($post_result) > 0) : ?>
    <section class="posts ">
    <div class="container posts_container">
    </div>
            <div class="container posts_container">

            <?php while($post = mysqli_fetch_assoc($post_result)):?>
                <article class="post">
                     <div class="post_thumbnail">
                    <img src="./images/<?=$post['thumbnail']?>" alt="">
                </div>
                <div class="postinfo">
                <?php  
                $category_id=$post['category_id'];
                $category_query ="SELECT * FROM category WHERE id='$category_id'";
                $category_result =mysqli_query($connection,$category_query);
                $category = mysqli_fetch_assoc($category_result);
               

                ?>
                    <a href=<?=ROOT_URL?>category_post.php?id=<?=$category['id']?> class="categorybutton"><?=$category['title']?></a>
                     <h2 class="post_title"><a href="post.php?id=<?=$post['id']?>"><?=$post['title']?></a></h2>
                     <p class="post_body"><?=substr( $post['body'],0,100)?>.....</p>
                     <div class="post_author">
                        <div class="author_avatar">
                            <img src="./images/<?=$auther['avatar']?>" alt="">
                        </div>
                        <div class="post_autor_info">
                             <?php
                    $auther_id =$post['auther_id'];
                    $auther_query = "SELECT * FROM users WHERE id='$auther_id'";
                    $auther_result = mysqli_query($connection,$auther_query);
                    $auther = mysqli_fetch_assoc($auther_result);
                    ?>
                            <h5><?="{$auther['firstname']} {$auther['lastname']} " ?></h5>
                            <small><?=date("M d , Y - H:i",strtotime($post['date_time']))?></small>
                        </div>
                     </div>
                </div>
                </article>
                <?php endwhile?>

          
            </div>
       </section>
    <?php else : ?>
   <div class="alert_message error lg">
     <h3>No Result found    </h3>
   </div>
    <?php endif ?>



       <?php

include 'partials/footer.php';

?>