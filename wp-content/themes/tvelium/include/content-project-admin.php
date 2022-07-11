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
        <h2 class="main-inner__content--title">Проекты</h2>
        <div class="main-inner__content--wrapper content-news">
            <div class="content-news__inner">
            <?php
                $args = array(
                    'posts_per_page' => 4,
                    'paged'          => get_query_var( 'page' ),
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'post_type'      => 'project',
                    'post_status'    => 'publish, pending',
                    'suppress_filters' => true, 
                    'prev_next'      => false,
                );
                
                $query = new WP_Query( $args );
                
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                    //wp_vardump($post);
                   ?>
                    <div class="content-news__item">
                        <div class="news-item__img-box">
                            <?php if( has_post_thumbnail() ): ?>
                                <a href="<?php echo '/' . $query->post_type . '/' . $query->post_name ?>" title="<?php the_title_attribute(); ?>" >
                                    <?php the_post_thumbnail( 'full' ); ?>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo '/' . $query->post_type . '/' . $query->post_name ?>" title="<?php the_title(); ?>" >
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/no-image.jpg" alt="<?php the_title(); ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="news-item__text-box">
                            <a href="<?php echo '/' . $query->post_type . '/' . $query->post_name ?>">
                                <h3 class="news-item__title"><?php the_title(); ?></h3>
                            </a>
                            <div class="news-item__footer">
                                <div class="news-item__date"><?php echo the_time('j F Y'); ?></div>
                                <a href="/editproject?r=<?php echo $query->ID ?>" class="news-item__edit">Редактировать</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
                wp_reset_postdata(); 
                ?>
                <?php
                    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                    $max_pages = $query->max_num_pages;

                    if( $paged < $max_pages ):
                ?>
                        <div id="loadmore" style="text-align:center;">
                            <a href="#" data-max-pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>" data-post-type="project" class="page-numbers">Загрузить ещё</a>
                        </div>
                <?php
                    endif
                ?>
            </div>

        </div>
    </div>
</div>