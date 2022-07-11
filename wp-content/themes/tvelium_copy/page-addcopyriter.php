<?php
/* 
Template Name: Добавить копирайтера
*/
global $current_user;
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
    //$user_adm = false;

    foreach( $current_user->roles as $role ) {
        switch ($role) {
            case 'administrator':
                //$user_adm = true;
                include "include/main-asside-admin.php";
                include "include/main-content-addcopyriter.php";
                break;
        }
    }
    ?>

    </div>
</section>

<?php get_footer(); ?>