<div class="main-inner">
    <div class="main-inner__content">
        <div class="breadcrumbs-box">
            <span class="breadcrumbs-nolink">Главная</span>
            <span class="breadcrumbs-strip">/</span>
            <a href="/news" class="breadcrumbs-link">Новости</a>
            <span class="breadcrumbs-strip">/</span>
            <p class="breadcrumbs-link"><?php the_title(); ?></p>
        </div>

        <div class="main-inner__content--wrapper content-news">
            <div class="content-news__news-box">
                <h1 class="news-box__title"><?php the_title(); ?></h1>
                <div class="news-box__date"><?php echo the_time('j F Y'); ?></div>
                <div class="news-box__content">
                    <?php the_content(); ?>
                </div>
            </div>
            
            <div class="btn-link__prew-next">
                <a href="/news" class="link-prew">Вернуться к списку новостей</a>
            </div>
        </div>
    </div>
</div>