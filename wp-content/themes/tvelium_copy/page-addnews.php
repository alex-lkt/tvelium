<?php
/* 
Template Name: Добавить Новость
*/
?>
<?php
    if ( !is_user_logged_in() ) {
        echo "<script>document.location.href='/';</script>";
    } 
?>

<?php get_header();?>

<section class="main">
    <div class="main-wrapper">

        <?php
        include "include/main-asside-copyriter.php";
        include "include/main-content-addnews.php";
        ?>

    </div>
</section>

<?php get_footer(); ?>