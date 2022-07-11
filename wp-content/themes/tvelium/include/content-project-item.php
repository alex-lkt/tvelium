<div class="content-news__item content-resume__item">
<?php echo $user->ID ?>
    <div class="news-item__img-box">
        <a href="<?php echo '/viewresume/?r=' . $user->user_login ?>">
            <img src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png" alt="<?php echo $user->display_name ?>">
        </a>
    </div>
    <div class="news-item__text-box">
        <a href="<?php echo '/viewresume/?r=' . $user->user_login ?>">
            <h3 class="news-item__title"><?php echo $user->first_name . "<br>" . $user->last_name . ' ' . $user->surname_prof ?></h3>
            <h5 class="news-item__title"><?php echo $user->title_prof ?></h5>
        </a>
        <div class="news-item__footer">
            <div class="news-item__date"><?php echo the_time('j F Y'); ?></div>
        </div>
    </div>
</div>