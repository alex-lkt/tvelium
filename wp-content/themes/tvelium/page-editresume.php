<?php
/* 
Template Name: Редактировать Резюме
*/
global $current_user;
?>
<?php
    if ( !is_user_logged_in() ) {
        echo "<script>document.location.href='/';</script>";
    } 
?>

<?php get_header();?>
<?php //echo 'page-editresume' ?>
<section class="main">
    <div class="main-wrapper">

    <?php
    foreach( $current_user->roles as $role ) {
        switch ($role) {
            case 'administrator':
                include "include/main-asside-admin.php";
                include "include/content-resume-admin.php";
                break;
            case 'subscriber':
                include "include/main-asside-user.php";
                include "include/content-editresume-user.php";
                break;
        }
    }
    ?>

    </div>
</section>

<?php get_footer(); ?>