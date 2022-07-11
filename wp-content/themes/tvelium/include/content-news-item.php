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
            <a href="/editnews?r=<?php echo $query->ID ?>" class="news-item__edit">Редактировать</a>
        </div>
    </div>
</div>