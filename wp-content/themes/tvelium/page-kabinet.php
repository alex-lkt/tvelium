<?php
/* 
Template Name: Страница Кабинет
*/
global $current_user;
//wp_vardump( $current_user );
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

    foreach( $current_user->roles as $role ) {
        switch ($role) {
            case 'administrator':
                include "include/main-asside-admin.php";
                include "include/main-content-admin.php";
                break;
            case 'author':
                include "include/main-asside-copyriter.php";
                include "include/main-content-copyriter.php"; // content-news-copyriter.php
                break;
            case 'subscriber':
                include "include/main-asside-user.php";
                include "include/main-content-user.php";
                break;
        }
    }
    ?>

    </div>
</section>

<?php get_footer(); ?>