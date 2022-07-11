<?php
/* 
Template Name: Страница оплаты
*/
global $current_user;
//wp_vardump($_POST);
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
            case 'subscriber':
                include "include/main-asside-user.php";
                include "include/pay-form.php";
                break;
        }
    }
    ?>

    </div>
</section>

<?php get_footer(); ?>