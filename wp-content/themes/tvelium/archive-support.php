<?php
/* 
**Template Name: Сраница Техподдержка
**Template Post Type: support
*/
global $current_user;
?>
<?php
    if ( !is_user_logged_in() ) {
        echo "<script>document.location.href='/';</script>";
    } 
?>

<?php get_header();?>
<?php //echo 'archive-support' ?>
<section class="main">
    <div class="main-wrapper">

    <?php
    foreach( $current_user->roles as $role ) {
        switch ($role) {
            case 'administrator':
                include "include/main-asside-admin.php";
                include "include/content-support-admin.php";
                break;
            case 'subscriber':
                include "include/main-asside-user.php";
                include "include/content-support-user.php";
                break;
            case 'author':
                include "include/main-asside-copyriter.php";
                include "include/content-support-user.php";
                break;
        }
    }
    ?>

    </div>
</section>

<?php get_footer(); ?>