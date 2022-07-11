<?php
/* 
Template Name: Редактировать Проект
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
        include "include/main-asside-user.php";
        include "include/main-content-addproject.php";
        ?>

    </div>
</section>

<?php get_footer(); ?>