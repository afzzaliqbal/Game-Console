<?php

include 'partials/header.php';

$featured_query = "SELECT * FROM post WHERE is_featured=1 ";
$featured_result =mysqli_query($connection,$featured_query);
$featured =mysqli_fetch_assoc($featured_result);

$post_query = "SELECT * from post ORDER BY date_time";
$post_result = mysqli_query($connection,$post_query);


?>

   

    <!--featured section  starts-->
<?php if(mysqli_num_rows($featured_result)) : ?>
    <section class="featured"> 
        <div class="container featured_container post_container">
            <div class="post_thumbnail">
                <img src="./images/<?=$featured['thumbnail']?>" alt="">
            </div>
            <div class="postinfo">
                <?php  
                $category_id=$featured['category_id'];
                $category_query ="SELECT * FROM category WHERE id='$category_id'";
                $category_result =mysqli_query($connection,$category_query);
                $category = mysqli_fetch_assoc($category_result);
               

                ?>
                <a href="<?=ROOT_URL?>category_post.php?id=<?=$category['id']?>" class="categorybutton"><?= $category['title']?></a>
                 <h2 class="post_title"><a href="post.php?id=<?=$featured['id']?>"><?=$featured['title']?></a></h2>
                 <p class="post_body"><?=substr( $featured['body'],0,300)?></p>
                 <div class="post_author">
                    <?php
                    $auther_id =$featured['auther_id'];
                    $auther_query = "SELECT * FROM users WHERE id='$auther_id'";
                    $auther_result = mysqli_query($connection,$auther_query);
                    $auther = mysqli_fetch_assoc($auther_result);
                    ?>
                    <div class="author_avatar">
                        <img src="./images/<?=$auther['avatar']?>" alt="">
                    </div>
                    <div class="post_autor_info">
                        <h5>By:<?="{$auther['firstname']} {$auther['lastname']} " ?></h5>
                        <small><?=date("M d , Y - H:i",strtotime($featured['date_time']))?></small>
                    </div>
                 </div>
            </div>
        </div>
    </section>
    <?php endif ?>

    <!--featured section  ends-->


       <!--post section  start-->

       <section class="posts">
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


       <!--category section-->

       <section class="category_buttons">
            <div class="container category_btn_container">
                <?php  
                $all_category_query= "SELECT * FROM category";
                $result = mysqli_query($connection,$all_category_query);
                ?>
            <?php while($category = mysqli_fetch_assoc($result)) :?>
                <a href="<?=ROOT_URL?>category_post.php?id=<?=$category['id']?>" class="categorybutton"><?= $category['title'] ?></a>
                <?php endwhile ?>   
            </div>
       </section>





       <!---footer-->
      
       <?php

include 'partials/footer.php';

?>