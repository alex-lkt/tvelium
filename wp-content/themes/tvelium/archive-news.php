<?php
/* 
Template Name: Все новости
*/
global $current_user;
?>
<?php
    if ( !is_user_logged_in() ) {
        header( 'Location: /' );
    } 
?>

<?php get_header();?>
<?php //echo 'archive-news' ?>
<section class="main">
    <div class="main-wrapper">

    <?php
    foreach( $current_user->roles as $role ) {
        //wp_vardump( $role );
        switch ($role) {
            case 'administrator':
                include "include/main-asside-admin.php";
                include "include/content-news-admin.php";
                break;
            case 'author':
                include "include/main-asside-copyriter.php";
                include "include/content-news-copyriter.php";
                break;
            case 'subscriber':
                include "include/main-asside-user.php";
                include "include/content-news-user.php";
                break;
        }
    }
    ?>

    </div>
</section>

<?php get_footer(); ?>