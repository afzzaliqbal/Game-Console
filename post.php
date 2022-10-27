<?php

include 'partials/header.php';

if(isset($_GET['id']))
{
   $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
      $query = "SELECT * FROM post WHERE id=$id ";
      $result = mysqli_query($connection, $query);
      $post = mysqli_fetch_assoc($result);
}
else{
   header('location:index.php ');
   die();
}

?>

    <!--navigation section  ends-->

  <section class="singlepost">
    <div class="container singlepost_container">
    
        <h2><?=$post['title']?></h2>
       
        <div class="post_author">

        <?php
        $auther_id = $post['auther_id'];
        $auther_select_query ="SELECT * FROM users WHERE id=$auther_id";
        $auther_select_result = mysqli_query($connection,$auther_select_query);
        $auther = mysqli_fetch_assoc($auther_select_result);
        
        ?>
       
            <div class="author_avatar">
                <img src="./images/<?=$auther['avatar']?>" alt="">
            </div>
            <div class="post_autor_info">
                <h5>By:<?="{$auther['firstname']} {$auther['lastname']} " ?></h5>
                <small><?=date("M d , Y - H:i",strtotime($post['date_time']))?></small>
            </div>
         </div>
         <div class="singlepost_thumbnail">
         <img src="./images/<?=$post['thumbnail']?>" alt="">

         </div>
         <p>
            <?=$post['body']?>
         </p>
         <div class="post_footer">
            <button class="btn add">add</button>
            <button class="btn buy">Buy</button>
         </div>
    </div>
  </section>


       <!---footer-->



<?php

include 'partials/footer.php';

?>

                
            