<?php
global $wpdb;
$end_date_day = '';
$user = wp_get_current_user();

$query = "SELECT * FROM tv_deposit WHERE dp_user_id = $user->ID"; //  AND dp_active = 1
$deposit = $wpdb->get_results( $query );

$curr_date = new DateTime();
if (time() >= strtotime($deposit[0]->dp_date_next)) {
    $end_date_day = "";
} else {
    if($deposit[0]->dp_date_next != NULL AND $deposit[0]->dp_add > 0) { // Есть сл дата платежа и первый платеж еще не был совершен
        $db_date_day = DateTime::createFromFormat('Y-m-d H:i:s', $deposit[0]->dp_date_next);
        $end_date_day = $db_date_day->diff($curr_date);
    }
}
//is_page( 'kabinet' ) ? 'current' : ''
//wp_vardump($deposit[0]->dp_date_next);
//wp_vardump($end_date_day);
?>
<div class="main-asside">
    <div class="main-asside__content">
        <nav class="main-asside__menu">
            <ul class="main-asside__list">
                <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/kabinet/' ? 'current' : ''?>">
                    <a href="/kabinet" class="menu__link">
                        <span class="menu-li__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-lk.svg" alt="">
                        </span>
                        <span class="menu-li__title">Личный кабинет</span>    
                    </a>
                </li>
                <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/purse/' ? 'current' : ''?>">
                    <a href="/purse" class="menu__link">
                        <span class="menu-li__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-koshel.svg" alt="">
                        </span>
                        <span class="menu-li__title">Кошелёк</span>    
                    </a>
                </li>
                <?php if ( !empty($end_date_day) ): ?>
                <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/resume/' ? 'current' : ''?>">
                    <a href="/resume" class="menu__link">
                        <span class="menu-li__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-resume.svg" alt="">
                        </span>
                        <span class="menu-li__title">Резюме</span>    
                    </a>
                </li>
                
                <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/news/' ? 'current' : ''?>">
                    <a href="/news" class="menu__link">
                        <span class="menu-li__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-news.svg" alt="">
                        </span>
                        <span class="menu-li__title">Новости</span>    
                    </a>
                </li>
                <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/vacancy/' ? 'current' : ''?>">
                    <a href="/vacancy" class="menu__link">
                        <span class="menu-li__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-vakanse.svg" alt="">
                        </span>
                        <span class="menu-li__title">Вакансии</span>    
                    </a>
                </li>
                <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/project/' ? 'current' : ''?>">
                    <a href="/project" class="menu__link">
                        <span class="menu-li__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-progekt.svg" alt="">
                        </span>
                        <span class="menu-li__title">Подать свой проект</span>    
                    </a>
                </li>
                <?php endif ?>
                <li class="menu__li <?echo $_SERVER['REQUEST_URI'] == '/support/' ? 'current' : ''?>">
                    <a href="/support" class="menu__link">
                        <span class="menu-li__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/menu-tehpoddergka.svg" alt="">
                        </span>
                        <span class="menu-li__title">Техподдержка</span>    
                    </a>
                </li>
                
            </ul>
        </nav>
    </div>
</div>