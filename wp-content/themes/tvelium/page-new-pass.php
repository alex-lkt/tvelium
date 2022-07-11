<?php
/* 
Template Name: Восстановление пароля
*/
?>
<?php 
    if ( is_page( 'auth' ) ) {
        get_header( 'home' );
    } else {
        get_header();
    }
?>

<?php if ( is_user_logged_in() ){
        echo "<script>document.location.href='/kabinet';</script>";  
}?>

<div class="main-inner">
    <div class="main-inner__content">   
        <section class="main">
            <div class="container">
                <div class="main-wrapper page-post">

                <?php echo do_shortcode( '[custom_passreset]' ); ?>

                </div>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>