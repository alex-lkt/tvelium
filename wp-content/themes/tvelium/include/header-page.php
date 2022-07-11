<?php
global $wpdb;
$summ_add = 0;
$is_admin = false;
$list_enquiry = [];
$informer['count'] = 0;

$query_users = "SELECT * FROM tv_deposit WHERE dp_active = 1";
$list_users = $wpdb->get_results( $query_users );

foreach ($list_users as $res_arr) {
    foreach ($res_arr as $key => $res) {
        if ($key == 'dp_add') {
            $summ_add += (int)$res;
        }
    }
}

if ( $user_adm ) {
    $class_admin = "admin-header";
} else {
    $class_admin = "";
}

/* информер */
$my_posts_project = get_posts( array(
    'numberposts' => 8,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'include'     => array(),
    'exclude'     => array(),
    'post_type'   => 'project',
    'post_status' => 'pending, publish',
    'suppress_filters' => true, 
) );
if( count($my_posts_project) > 0 ) {
    $informer['проекты'] = count($my_posts_project);
    $informer['count'] += count($my_posts_project);
}

$my_posts_news = get_posts( array(
    'numberposts' => 8,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'include'     => array(),
    'exclude'     => array(),
    'post_type'   => 'news',
    'post_status' => 'pending',
    'suppress_filters' => true, 
) );
if( count($my_posts_news) > 0 ) {
    $informer['новости'] = count($my_posts_news);
    $informer['count'] += count($my_posts_news);
}

$query_users = "SELECT * FROM tv_withdraw";
$db_users = $wpdb->get_results( $query_users );
foreach ( $db_users as $item ) {
    if ( $item->enquiry_status == 0 ) {
        $list_enquiry[] = $item;
    }
}
if( count($list_enquiry) > 0 ) {
    $informer['заявки на вывод'] = count($list_enquiry);
    $informer['count'] += count($list_enquiry);
}

?>
<div class="wrapper">

<header class="header">
    <div class="container">
        <div class="header-wrapper <?=$class_admin?>">
            <div class="main-asside__header">
                <div class="main-asside__logo">
                    <a class="main-asside__link" href="/">
                        <img class="main-asside-logo__img" src="<?php echo get_template_directory_uri() ?>/assets/images/logo-2.svg" alt="Tvelium.ru">
                    </a>
                </div>
            </div>

            <div class="main-inner__header">
                <div class="main-inner__informer">
                    <div class="main-asside__logo header-min">
                        <a class="main-asside__link" href="/">
                            <img class="main-asside-logo__img" src="<?php echo get_template_directory_uri() ?>/assets/images/logo-2.svg" alt="Tvelium.ru">
                        </a>
                    </div>

                    <?php if ( $user_adm ): ?>
                    <div class="balans__box">
                        <span class="btn-admin__text">Баланс: </span>
                        <span class="btn-admin__summ-out"><?php echo number_format( $summ_add, 0, '', ' ' ); ?></span>
                        <span class="summ__box-ico">
                            <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 0V14H0V16H2V20H4V16H10V14H4V11H11.5C14.526 11 17 8.526 17 5.5C17 2.474 14.526 0 11.5 0H2ZM4 2H11.5C13.444 2 15 3.556 15 5.5C15 7.444 13.444 9 11.5 9H4V2Z" fill="#005300"/>
                            </svg>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="main-inner__icon--box">
                    <div class="main-inner__info">
                        <?php foreach( $c_user->roles as $role ): ?>
                            <div class="main-inner__info--user"><?php echo $c_user->display_name ?></div>
                            <div class="main-inner__info--role">
                                <?php 
                                switch ($role) {
                                    case 'administrator':
                                        echo "администратор";
                                        $is_admin = true;
                                        break;
                                    case 'author':
                                        echo "редактор";
                                        break;
                                    // case 'subscriber':
                                    //     echo "пользователь";
                                    //     break;
                                }
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php 
                        $info_class = '';
                        if ($is_admin): 
                            if ($informer['count'] > 0) 
                                $info_class = 'info-active';
                    ?>
                    <div class="main-inner__info">
                        <button class="main-inner__info--btn btn-info <?php echo $info_class ?>">
                            <div class="tooltip-info__box">
                            <?php 
                                foreach($informer as $info_name => $info_count):
                                    if ($info_name != 'count'): 
                            ?>
                                <span class="tooltip-info__text">Новые <?php echo $info_name ?>: <?php echo $info_count ?></span>
                            <?php 
                                    endif;
                                endforeach 
                            ?>
                            </div>
                        </button>
                    </div>
                    <?php endif ?>
                    <div class="main-inner__info">
                        <a class="main-inner__info--btn btn-logout" href="<?php echo wp_logout_url( home_url() ); ?>">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/logout.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>