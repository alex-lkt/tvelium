<?php
global $current_user;
?>

<div class="content-vacancy__item">
    <h3 class="content-vacancy__title"><?php the_title(); ?></h3>
    <div class="content-vacancy__desc"><?php echo wp_trim_words( get_the_content() ); ?></div>
    <div class="content-vacancy__btn-box">
        <?php 
        wp_vardump( $current_user->roles[0] );
        if ( $current_user->roles[0] == 'administrator' ): ?>
            <a href="/editvacancy?r=<?php echo $post->ID ?>" class="btn-more">Редактировать</a>
        <?php elseif ( $current_user->roles[0] == 'subscriber' ): ?>
            <a href="<?php the_permalink() ?>" class="btn-more">Подробнее</a>
            <button class="btn btn-green">Откликнуться</button>
        <?php endif ?>
        
    </div>
</div>