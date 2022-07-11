<?php
/* 
Template Name: Все Вакансии
*/
global $current_user;
?>
<?php
    if ( !is_user_logged_in() ) {
        header( 'Location: /' );
    } 
?>

<?php get_header();?>
<?php //echo 'archive-vacancy' ?>
<section class="main">
    <div class="main-wrapper">

    <?php
    foreach( $current_user->roles as $role ) {
        //wp_vardump( $role );
        switch ($role) {
            case 'administrator':
                include "include/main-asside-admin.php";
                include "include/main-content-adminvacancy.php";
                break;
            // case 'author':
            //     include "include/main-asside-copyriter.php";
            //     include "include/content-news-copyriter.php";
            //     break;
            case 'subscriber':
                include "include/main-asside-user.php";
                include "include/main-content-uservacancy.php";
                break;
        }
    }
    ?>

    </div>
</section>

<?php get_footer(); ?>