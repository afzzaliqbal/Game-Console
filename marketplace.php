<?php

include 'partials/header.php';


    $cateogy_query = "SELECT * FROM category ";
    $cateogy_reslut = mysqli_query($connection,$cateogy_query);
    $cateogy=mysqli_fetch_assoc($cateogy_reslut);
  

    $post_query = "SELECT * from post";
    $post_result = mysqli_query($connection,$post_query);

?>

    <!--navigation section  ends-->

    <!--search  section  starts-->
       
    <section class="search_bar">
        <form action="<?=ROOT_URL?>search.php" class="container search_bar_container" method="GET">
            <div>
               <span class="material-symbols-rounded">
                       
                </span>
                <input type="search" name="search" placeholder="serach">
            </div>
            <button type="submit" name="submit" class="btn">Go</button>
        </form>
    </section>
  

    <!--search  section  ends-->


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