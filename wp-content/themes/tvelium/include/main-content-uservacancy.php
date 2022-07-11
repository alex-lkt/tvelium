<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Вакансии</h2>
        <div class="main-inner__content--wrapper box-noborder">
        <div class="content-vacancy__inner">
                <div class="content-vacancy__filter-box">
                    <!-- <div class="filter-box__specif">
                        <span class="specif-text">Специализация:</span>
                        <span class="specif-select">Информационные технологии</span>
                    </div> -->
                    
                    <!-- <div class="filter-box__sort">
                        <select class="sort-box" name="sort" id="sort">
                            <option value="0" selected>Сначала новые</option>
                            <option value="1">Сначала старые</option>
                        </select>
                    </div> -->
                </div>

                <div class="content-vacancy__box">
                <?php             
                $args = array(
                    'posts_per_page' => 4,
                    'paged'          => get_query_var( 'page' ), // 
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    //'author'         => $current_user->ID,
                    'post_type'      => 'vacancy',
                    'post_status'    => 'publish, pending',
                    'suppress_filters' => true, 
                );
                
                $query = new WP_Query( $args );
                
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                   ?>
                    <div class="content-vacancy__item">
                        <h3 class="content-vacancy__title"><?php the_title(); ?></h3>
                        <div class="content-vacancy__desc"><?php echo wp_trim_words( get_the_content() ); ?></div>
                        <div class="content-vacancy__btn-box">
                            <a href="<?php the_permalink() ?>" class="btn-more">Подробнее</a>
                            <button class="btn btn-green">Откликнуться</button>
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
                            <a href="#" data-max-pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>" data-post-type="vacancy" class="page-numbers">Загрузить ещё</a>
                        </div>
                <?php
                    endif
                ?>
                </div>
            </div>

        </div>
    </div>
</div>