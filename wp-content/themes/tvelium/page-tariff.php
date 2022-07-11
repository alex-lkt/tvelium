<?php get_header();?>

<div class="main-inner">
    <div class="main-inner__content">   
        <section class="main">
            <div class="container">
                <div class="main-wrapper page-post">

                <?php
                    $the_query = new WP_Query( 'name=tariff' );
                    //wp_vardump( $the_query );
                    while  ($the_query->have_posts() ) {
                        $the_query->the_post();
                        the_content();
                    } 
                    wp_reset_postdata();
                ?>

                </div>
            </div>
        </section>
    </div>
</div>

<?php get_footer(); ?>