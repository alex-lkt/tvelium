<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Новости</h2>

        <a href="/addnews" class="btn-news__add">Добавить новость</a>

        <h3 class="main-inner__content--title-h3">Все новости</h3>
        <div class="main-inner__content--wrapper content-news">
            <div class="content-news__inner">
                <?php
                //wp_vardump($current_user->ID);

                $my_posts = get_posts( array(
                    'numberposts' => 8,
                    'category'    => 4,
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    'include'     => array(),
                    'exclude'     => array(),
                    'author'      => $current_user->ID,
                    'post_type'   => 'post',
                    'post_status' => 'publish, pending',
                    'suppress_filters' => true, 
                ) );
                
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
                <?php the_posts_pagination() ?>222
                <a href="#" class="content-pagination_link active">1</a>
                <a href="#" class="content-pagination_link">2</a>
                <a href="#" class="content-pagination_link">3</a>
                <span class="content__pagination-points">...</span>
                <a href="#" class="content-pagination_link">7</a>
            </div>
        </div>
    </div>
</div>