<?php 
    if ( is_home() ) {
        get_header( 'home' );
    } else {
        get_header();
    }
?>

index

<?php get_footer(); ?>