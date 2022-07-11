<h2 class="main-inner__content--title">Новости</h2>
    <div class="main-inner__content--wrapper content-news">
        <div class="content-news__inner">
        <?php
            $my_posts = get_posts( array(
                'numberposts' => 4,
                'orderby'     => 'date',
                'order'       => 'DESC',
                'include'     => array(),
                'exclude'     => array(),
                'post_type'   => 'news',
                'post_status' => 'publish',
                'suppress_filters' => true, 
            ) );
            
            foreach( $my_posts as $post ){
                setup_postdata( $post );
                ?>
                <div class="content-news__item">
                    <div class="news-item__img-box">
                        <?php if( has_post_thumbnail() ): ?>
                            <a href="<?php echo '/' . $post->post_type . '/' . $post->post_name ?>" title="<?php the_title_attribute(); ?>" >
                                <?php the_post_thumbnail( 'full' ); ?>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo '/' . $post->post_type . '/' . $post->post_name ?>" title="<?php the_title(); ?>" >
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/no-image.jpg" alt="<?php the_title(); ?>">
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="news-item__text-box">
                        <a href="<?php echo '/' . $post->post_type . '/' . $post->post_name ?>">
                            <h3 class="news-item__title"><?php the_title(); ?></h3>
                        </a>
                        <div class="news-item__footer">
                            <div class="news-item__date"><?php echo the_time('j F Y'); ?></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            
            wp_reset_postdata(); 
            ?>
        </div>
        
        <div class="content-news__link-btn">
            <a href="/news" class="btn news-btn__full--news">Все новости</a>
        </div>
</div>