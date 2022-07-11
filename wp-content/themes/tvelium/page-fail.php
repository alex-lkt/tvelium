<?php
global $current_user;
wp_vardump( $_POST['variable'] );
wp_vardump( $_SESSION );
exit;
?>

<?php
    if ( !is_user_logged_in() ) {
        //echo "<script>document.location.href='/';</script>";
    } 
?>

<?php get_header();?>

<section class="main">
    <div class="main-wrapper">

    fail

    </div>
</section>

<?php get_footer(); ?>