<div class="main-inner">
    <div class="main-inner__content copyriter-addnews">
        <h2 class="main-inner__content--title">Новости</h2>

        <a href="/addnews" class="btn-news__add">Добавить новость</a>

        <h3 class="main-inner__content--title-h3">Все новости</h3>
        <div class="main-inner__content--wrapper content-news">
            <div class="content-news__inner">
                <?php
                $args = array(
                    'posts_per_page' => 4,
                    'paged'          => get_query_var( 'page' ), // 
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'author'         => $current_user->ID,
                    'post_type'      => 'news',
                    'post_status'    => 'publish, pending',
                    'suppress_filters' => true, 
                );
                
                $query = new WP_Query( $args );
                
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                    //wp_vardump($args);
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
                        <div class="news-item__text-box">
                            <a href="<?php the_permalink(); ?>">
                                <h3 class="news-item__title"><?php the_title(); ?></h3>
                            </a>
                            <div class="news-item__footer">
                                <div class="news-item__date"><?php echo the_time('j F Y'); ?></div>
                                <a href="/editnews?r=<?php echo $post->ID ?>" class="news-item__edit">Редактировать</a>
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
                            <a href="#" data-max-pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>" class="page-numbers">Загрузить ещё</a>
                        </div>
                <?php
                    endif
                ?>
            </div>
    
        </div>
    </div>
</div>