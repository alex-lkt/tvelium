<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Резюме</h2>
        <div class="main-inner__content--wrapper content-news">
            <div class="content-news__inner">  
            <?php
                $number = 4;
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $offset = ($paged - 1) * $number;
                $users_s = get_users( array('role' => 'subscriber' ) );  
                $total_users = count($users_s);
                
                $users_subscriber = get_users( array(
                    'role'   => 'subscriber',
                    'offset' => $offset, // 
                    'number' => $number,
                ) );
                
                $total_pages = round($total_users / $number) + 1;
                //wp_vardump($users_subscriber);
                foreach( $users_subscriber as $i => $user ): 
                   ?>
                    <div class="content-news__item content-resume__item">
                        <?php //echo $user->ID ?>
                        <div class="news-item__img-box">
                            <a href="<?php echo '/viewresume/?r=' . $user->user_login ?>">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png" alt="<?php echo $user->display_name ?>">
                            </a>
                        </div>
                        <a href="<?php echo '/viewresume/?r=' . $user->user_login ?>">
                            <h3 class="news-item__title"><?php echo $user->first_name . "<br>" . $user->last_name . ' ' . $user->surname_prof ?></h3>
                            <h5 class="news-item__title"><?php echo $user->title_prof ?></h5>
                        </a>
                        <div class="news-item__footer">
                            <!-- <div class="news-item__date"><?php echo the_time('j F Y'); ?></div> -->
                        </div>
                    </div>
                    <?php
                endforeach; 
                ?>
                <?php
                    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                    
                    if( $paged < $total_pages ):   
                    // $paged++;    
                ?>
                        <div id="loadmore" style="text-align:center;width:100%">
                            <a href="#" data-max-pages="<?php echo $total_pages ?>" data-paged="<?php echo $paged ?>" data-post-type="project" class="page-numbers">Загрузить ещё</a>
                        </div>
                <?php
                    endif
                ?>
            </div>
        </div>
    </div>
</div>