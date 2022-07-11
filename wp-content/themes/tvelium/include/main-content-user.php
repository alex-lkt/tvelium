<?php
$user = wp_get_current_user();
$curr_date = '';
$end_date_full = '';
$end_date_day = '';
$ref_show = '';
$ref_active = 0;

global $wpdb;
// Полный список deposit
$query_dep = "SELECT * FROM tv_deposit"; //  AND dp_active = 1
$deposit_res_db = $wpdb->get_results( $query_dep );
foreach($deposit_res_db as $item_ref) {
    $deposit_arr[$item_ref->dp_user_id] = $item_ref;
}

$query = "SELECT * FROM tv_deposit WHERE dp_user_id = $user->ID"; //  AND dp_active = 1
$deposit = $wpdb->get_results( $query );
// список ID рефералов
$query_ref = "SELECT * FROM tv_referal WHERE user_id = $user->ID"; //  AND dp_active = 1
$referal_db = $wpdb->get_results( $query_ref );
// список рефералов
if (isset($referal_db[0])) {
    foreach($referal_db as $item) {
        $args[] = $item->ref_id;
    }
    $fereral_arr_obj = new WP_User_Query( array('include' => $args) );
    $fereral_arr = $fereral_arr_obj->get_results();
}
// проверка рефералов на активность
if ( isset($referal_db) AND !empty($referal_db) ) {
    $query_r_a = "SELECT * FROM tv_deposit WHERE"; //  AND dp_active = 1
    foreach($referal_db as $key => $ref_item) {
        $query_r_a .= " dp_user_id=" . $ref_item->ref_id;
        if (isset($referal_db[++$key]))
            $query_r_a .= " OR";
    }
    $query_r_a .= " AND dp_add>0";
    $deposit_r_a = $wpdb->get_results( $query_r_a );
}

$curr_date = new DateTime();

if (time() >= strtotime($deposit[0]->dp_date_next)) {
    $end_date_day = "";
} else {
    if($deposit[0]->dp_date_next != NULL OR $deposit[0]->dp_add > 0) {
        $db_date_day = DateTime::createFromFormat('Y-m-d H:i:s', $deposit[0]->dp_date_next);
        $end_date_day = $db_date_day->diff($curr_date);//->format('%D:%H:%I');
        $end_date_day_btn = $db_date_day->diff($curr_date);
    }
}
// Скрыть реф программу если нет реферала в течение 3-х месяцев
//$query_ref = "SELECT * FROM tv_referal WHERE user_id = $user->ID"; //  AND dp_active = 1
//$ref_db = $wpdb->get_results( $query_ref );
if (isset($referal_db[0])) {
    $ref_active = 0;
    foreach ($referal_db as $item_ref) {
        // реферал есть в deposit и сделал оплату
        $query_user = "SELECT * FROM tv_deposit WHERE dp_user_id = $item_ref->ref_id AND dp_add > 0"; //  AND dp_active = 1
        $deposit_user = $wpdb->get_results( $query_user );

        if (isset($deposit_user[0]))
            $ref_active = 1;
    }
    //wp_vardump( $item_ref->ref_id );
    // wp_vardump( $ref_active );
    // wp_vardump( strtotime($deposit[0]->dp_date_reg) );
    // wp_vardump( date('Y-m-d H:i:s', strtotime('+3 month', strtotime($deposit[0]->dp_date_reg))) );
    // wp_vardump(  date('Y-m-d H:i:s') );

    if ( $ref_active == 0 AND date('Y-m-d H:i:s', strtotime('+3 month', strtotime($deposit[0]->dp_date_reg))) <= date('Y-m-d H:i:s') ) {
        $ref_show = ' display-none';
    }
        
}

//wp_vardump($deposit);
?>
<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Личный кабинет</h2>
        <div class="main-inner__content--wrapper content-user">
            <div class="content-wrapper__left content-left__box">
                <div class="content-left__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png" alt="ФИО">
                </div>
                <h2 class="content-left__name"><?php echo $user->first_name ?><br><?php echo $user->last_name . " " . $user->surname_prof ?></h2>
                <div class="content-left__location"><span><?php echo $user->city_prof ?></span></div>
                <div class="content-left__phone"><a href="tel:<?php echo $user->phone_prof ?>"><?php echo $user->phone_prof ?></a></div>
                <a href="#" class="content-left__profile-link">Личные данные</a>
                <div class="content-left__email"><a href="mailto:<?php echo $user->user_email ?>"><?php echo $user->user_email ?></a></div>
                
                <div class="content-left__referal-box <?php echo $ref_show ?>">
                    <div class="content-left__ref-title">Реферальный код</div>
                    <div class="content-left__ref-data"><?php echo $user->refcode_prof ?></div>
                </div>
                <div class="content-left__refcod-box <?php echo $ref_show ?>">
                    <span class="cachelink__help-ico refcod__help"></span>
                    <p class="cachelink__help-text cachelink__full-text refcod__help-text" data-tooltip='10 тысяч ежемесячно без активного реферала, 15 тысяч ежемесячно с активным рефералом."'></p>

                    <div class="content-left__ref-title">
                        <?
                        if ( empty($referal_db) ) {
                            echo "Реферал (нет)";
                        } else if (count($deposit_r_a) > 0) {
                            echo "Реферал (активных: ". count($deposit_r_a) .")";
                        } else {
                            echo "Реферал (активных нет')";
                        }
                        ?>
                        
                    </div>
                    <div class="content-left__ref-data">
                        <?php
                            $dep_list_class = "";
                            if ( !empty($fereral_arr)) {
                                foreach($fereral_arr as $item) {
                                    $deposit_arr[$item->ID]->dp_add == 0 ? $dep_list_class = "text-color-red" : $dep_list_class = "";
                        ?>
                                <div class="ref-data__user <?php echo $dep_list_class ?>"><?php echo $item->first_name . " " .  mb_substr($item->last_name, 0, 1, "UTF-8") . "." . mb_substr($item->surname_prof, 0, 1, "UTF-8") . "." ?></div>
                        <?
                                }
                            }
                        ?>
                    </div>
                    
                </div>
            </div>

            <div class="content-wrapper__right">
                <div class="content-right__pay">
                    <span class="cachelink__help-ico cachelink__full-btn"></span>
                    <p class="cachelink__help-text cachelink__full-text" data-tooltip='10 тысяч ежемесячно без активного реферала, 15 тысяч ежемесячно с активным рефералом, 30 тысяч по Акции "При вносе в первые 90 дней всей суммы"'></p>  
                    <div class="right-pay__title">До бонусной выплаты осталось:</div>
                    <div class="right-pay__diagram">
                        <div class="diagram-box">
                            <div class="diagram-box-inner">
                                <span class="diagram-box__num"><?php echo ($deposit[0]->dp_date_full_out != '') ? $deposit[0]->dp_date_full_out : '-' ?></span>
                                <span class="diagram-box__text">дней</span>
                            </div>
                        </div>
                    </div>
                    <div class="right-pay__text"><?php echo $deposit[0]->dp_refpay ?> ежемесячно</div>
                </div>
                <div class="content-right__payment">
                    <div class="right-payment__title">До внесения<br>следующего платежа<br>осталось:</div>
                    <div class="right-payment__data">
                        <div class="payment-data">
                            <?php
                                if ( empty($end_date_day) ) {
                                    echo "00:00:00";
                                } else {
                                    echo ($end_date_day->days ? $end_date_day->days : '00')
                                    . ":" . 
                                    ($end_date_day->h ? $end_date_day->h : '00')
                                    . ":" . 
                                    ($end_date_day->i ? $end_date_day->i : '00');
                                }
                                
                            ?>
                        </div>
                        <div class="payment-text"><span>дней</span><span>часов</span><span>секунд</span></div>
                    </div>
                </div>

                <div class="content-right__balance">
                    <div class="right-balance__img">
                        <svg width="144" height="128" viewBox="0 0 144 128" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M93.7501 75C93.7501 72.8244 94.3952 70.6977 95.6039 68.8887C96.8126 67.0798 98.5306 65.6699 100.541 64.8373C102.551 64.0048 104.762 63.7869 106.896 64.2114C109.03 64.6358 110.99 65.6834 112.528 67.2218C114.067 68.7602 115.114 70.7202 115.539 72.854C115.963 74.9878 115.745 77.1995 114.913 79.2095C114.08 81.2195 112.67 82.9375 110.861 84.1462C109.052 85.3549 106.926 86 104.75 86C101.833 86 99.0348 84.8411 96.9719 82.7782C94.909 80.7153 93.7501 77.9174 93.7501 75ZM143.25 42V113.5C143.232 117.141 141.778 120.628 139.203 123.203C136.628 125.777 133.141 127.232 129.5 127.25H19.5001C14.4003 127.232 9.51447 125.198 5.90832 121.592C2.30216 117.986 0.268224 113.1 0.250107 108V22.8875C0.241065 19.9894 0.80294 17.1179 1.90365 14.4369C3.00437 11.7559 4.62236 9.31803 6.66525 7.26237C8.70814 5.20671 11.1359 3.57356 13.81 2.45616C16.484 1.33877 19.352 0.759014 22.2501 0.75H113C115.188 0.75 117.287 1.61919 118.834 3.16637C120.381 4.71354 121.25 6.81196 121.25 9C121.25 11.188 120.381 13.2865 118.834 14.8336C117.287 16.3808 115.188 17.25 113 17.25H22.2501C20.7577 17.2641 19.3286 17.8554 18.2626 18.9C17.2888 19.9453 16.7482 21.3214 16.7501 22.75V22.8875C16.8553 24.3585 17.5192 25.7335 18.6058 26.7306C19.6924 27.7277 21.1193 28.2713 22.5939 28.25H129.5C133.141 28.2681 136.628 29.7225 139.203 32.2973C141.778 34.872 143.232 38.3588 143.25 42ZM126.75 47.75C126.75 46.0931 125.407 44.75 123.75 44.75H22.5939C20.6216 44.7492 18.6576 44.495 16.7501 43.9938V108C16.7501 108.729 17.0398 109.429 17.5556 109.945C18.0713 110.46 18.7708 110.75 19.5001 110.75H123.75C125.407 110.75 126.75 109.407 126.75 107.75V47.75Z" fill="url(#paint0_linear_60_310)"/>
                            <defs>
                            <linearGradient id="paint0_linear_60_310" x1="-25.0024" y1="215.27" x2="112.485" y2="91.813" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#447752"/>
                            <stop offset="1" stop-color="#79BE44"/>
                            </linearGradient>
                            </defs>
                        </svg>                                            
                    </div>
                    
                    <div class="right-balance__text-box">
                        <div class="right-balance__title">Баланс</div>
                        <div class="right-balance__summ">
                            <h5><?php echo number_format( $deposit[0]->dp_add, 0, '', ' ' ); ?></h5>
                            <span>
                                <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 0V14H0V16H2V20H4V16H10V14H4V11H11.5C14.526 11 17 8.526 17 5.5C17 2.474 14.526 0 11.5 0H2ZM4 2H11.5C13.444 2 15 3.556 15 5.5C15 7.444 13.444 9 11.5 9H4V2Z" fill="#005300"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <?php //include "content-news-list.php"; ?>

    </div>
</div>