<?php
$current_user = wp_get_current_user();
//wp_vardump($_GET);

if ( isset($_GET['p']) && $_GET['p'] == 'moderate' ) {
    $status = 'pending';
} else {
    $status = 'publish, pending';
}
?>

<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Новости</h2>
        <div class="main-inner__content--wrapper content-news">
            <div class="content-news__inner">
            <?php
                $my_posts = get_posts( array(
                    'numberposts' => 8,
                    'category'    => 4,
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    'include'     => array(),
                    'exclude'     => array(),
                    'meta_key'    => '',
                    'meta_value'  => '',
                    'post_type'   => 'post',
                    'post_status' => $status,
                    'suppress_filters' => true, 
                ) );

                // $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                // $args = array( 
                //     'posts_per_page' => 4, 
                //     'category_name' => 4, // тут имя категории
                //     'paged' => $paged,
                //     'post_type' => 'post' ,
                //     'post_status' => $status,
                // );
               // $posts = new WP_Query( $args );
                
                foreach( $my_posts as $post ){
                    setup_postdata( $post );
                    //wp_vardump($post);
                   ?>
                    <div class="content-news__item">
                        <div class="news-item__img-box">
                            <?php if( has_post_thumbnail() ): ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
                                    <?php the_post_thumbnail( 'full' ); ?>
                                </a>
                            <?php else: ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/no-image.jpg" alt="<?php the_title(); ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                        <a href="<?php the_permalink(); ?>">
                            <h3 class="news-item__title"><?php the_title(); ?></h3>
                        </a>
                        <div class="news-item__footer">
                            <div class="news-item__date"><?php echo the_time('j F Y'); ?></div>
                            <a href="/editnews?r=<?php echo $post->ID ?>" class="news-item__edit">Редактировать</a>
                        </div>
                    </div>
                   <?php
                }
                
                wp_reset_postdata(); 
                ?>
            </div>
            
            <div class="content__pagination">
                <?php 
                
                the_posts_pagination() 
                ?>
                <a href="#" class="content-pagination_link active">1</a>
                <a href="#" class="content-pagination_link">2</a>
                <a href="#" class="content-pagination_link">3</a>
                <span class="content__pagination-points">...</span>
                <a href="#" class="content-pagination_link">7</a>
            </div>
        </div>
    </div>
</div>