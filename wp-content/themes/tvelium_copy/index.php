<?php 
    if ( is_home() ) {
        get_header( 'home' );
    } else {
        get_header();
    }
?>



<?php get_footer(); ?>