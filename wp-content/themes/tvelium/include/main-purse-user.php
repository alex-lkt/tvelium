<?php
$user = wp_get_current_user();
$curr_date = '';
$end_date_full = '';
$end_date_day = '';
$style_event = '';
$box_block_text_open = '';
$style_event_min = '';
$style_event_max = '';

global $wpdb;

$query_n = "SELECT ID FROM tv_deposit";
$deposit_t = $wpdb->get_results( $query_n );
$deposit_num = array_pop($deposit_t);
//wp_vardump( $deposit_num->ID + 1 );

$query = "SELECT * FROM tv_deposit WHERE dp_user_id = $user->ID"; //  AND dp_active = 1
$deposit = $wpdb->get_results( $query );

$curr_date = new DateTime();

// Дата следующей оплаты
if (time() >= strtotime($deposit[0]->dp_date_next)) {
    $end_date_day = "";
} else {
    if($deposit[0]->dp_date_next != NULL OR $deposit[0]->dp_add > 0) { // Есть сл дата платежа и первый платеж еще не был совершен
        $db_date_day = DateTime::createFromFormat('Y-m-d H:i:s', $deposit[0]->dp_date_next);
        $end_date_day = $db_date_day->diff($curr_date);//->format('%D:%H:%I');
        $end_date_day_btn = $db_date_day->diff($curr_date);
        //$style_event_min = 'opacity: 0.6; cursor: auto;'; // pointer-events: none; // Блокировака до сл. платежа
        $box_block_text_open = 'box-block-text-open';
    }
}

// Блокировка max кнопки
$date_reg = DateTime::createFromFormat('Y-m-d H:i:s', $deposit[0]->dp_date_reg);
$r_date = $date_reg->diff($curr_date)->format('%a');
if ($r_date > 90) {
    $style_event_max = 'pointer-events: none; opacity: 0.4;';
}
// Если перешел на max тариф 
if ($deposit[0]->dp_tarif == 'max') {
    $style_event_min = 'pointer-events: none; opacity: 0.6; cursor: auto;';
    $style_event_max = 'pointer-events: none; opacity: 0.6; cursor: auto;';
} 

// Если выплота прошла или больше не активен пользователь
if ($deposit[0]->dp_active == 0) {
    $style_event_min = 'pointer-events: none; opacity: 0.6; cursor: auto;';
    $style_event_max = 'pointer-events: none; opacity: 0.6; cursor: auto;';
} 

//wp_vardump( $deposit[0]->dp_date_next );
//session_start();
//$_SESSION['client_login'] = $user->first_name . " " . $user->last_name . " " . $user->surname_prof;
//$_SESSION['orderid'] = $deposit_num->ID + 1;
//$_SESSION['sum'] = 
//$_SESSION['client_phone'] = $user->phone_prof;
?>
<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Кошелёк</h2>
        <div class="main-inner__content--wrapper content-profile">
            <div class="content-wrapper__left">
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

                <div class="content-right__pay">
                    <span class="cachelink__help-ico cachelink__full-btn"></span>
                    <p class="cachelink__help-text cachelink__full-text" data-tooltip='10 тысяч ежемесячно без активного реферала, 15 тысяч ежемесячно с активным рефералом, 30 тысяч по Акции "При вносе в первые 90 дней всей суммы"'></p>  
                    <div class="right-pay__title">До бонусной выплаты осталось:</div>
                    <div class="right-pay__diagram">
                        <div class="diagram-box">
                            <div class="diagram-box-inner">
                                <span class="diagram-box__num"><?php echo ($deposit[0]->dp_date_full_out != NULL) ? $deposit[0]->dp_date_full_out : '-' ?></span>
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
                        <div class="payment-text"><span>дней</span><span>часов</span><span>минут</span></div>
                    </div>
                </div>
            </div>

            <div class="content-wrapper__right" id="pay__screen-1">
                <div class="content-left__deposit">
                    <form id="send-pay" class="send-pay__form" action="/pay" name="" method="POST" enctype="multipart/form-data"> <?php //echo esc_url(admin_url( 'admin-post.php' )) ?>
                        
                        <div class="btn-select__box">
                            <select name="user_summ" id="user_summ" class="btn-select__inner">                               
                            <?php for($dep_sum = DEPOSIT_MONTH; $dep_sum <= $deposit[0]->dp_remain; $dep_sum = $dep_sum + DEPOSIT_MONTH): ?>
                                <?php 
                                    $dep_sum == DEPOSIT_MONTH ? $selected = "selected" : $selected = ""; 
                                    if ($dep_sum > $deposit[0]->dp_remain) 
                                    {
                                        $dep_sum = $deposit[0]->dp_remain;
                                    }   
                                ?>
                                <option value="<?php echo $dep_sum ?>" <?php echo $selected ?>>
                                    <?php echo $dep_sum ?> руб.(<?php echo $dep_sum / DEPOSIT_MONTH ?>&nbsp;мес.)
                                </option>
                            <?endfor?>
                            </select>
                        </div>

                        <button type="submit" class="content-left__deposit-btn deposit-btn__sum" style="<?php echo $style_event_min ?>">
                            <?php if(isset($end_date_day_btn->days)): ?>
                            <div class="box-block-text <?php echo $box_block_text_open ?>">
                                Следующую оплату можно будет<br>произвести через <?php echo $end_date_day_btn->days ?> дней
                            </div>
                            <?php endif ?>
                            <div class="left-deposit__img">
                                <svg width="130" height="130" viewBox="0 0 130 130" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M65 130C100.899 130 130 100.899 130 65C130 29.1015 100.899 0 65 0C29.1015 0 0 29.1015 0 65C0 100.899 29.1015 130 65 130ZM80.8817 53.9785C80.8816 53.9816 80.8814 53.9848 80.8813 53.9879V53.9856V53.9692C80.8814 53.9723 80.8816 53.9754 80.8817 53.9785ZM80.2857 50.4753C80.7259 51.5875 80.929 52.7813 80.8817 53.9785C80.9303 55.1785 80.7276 56.3754 80.2869 57.4905C79.8451 58.6085 79.1742 59.6188 78.3184 60.4547L78.3253 60.4477C77.4184 61.2926 76.3552 61.9471 75.197 62.3734C74.0389 62.7997 72.8089 62.9893 71.578 62.9313H58.9623V45.0399H71.5572C72.7899 44.9788 74.0223 45.1662 75.183 45.5914C76.3436 46.0165 77.4094 46.6709 78.3184 47.5165L78.3207 47.5188C79.1746 48.3526 79.8443 49.3603 80.2857 50.4753ZM89.0505 60.8142C89.9104 58.6474 90.311 56.3217 90.2263 53.9879H90.2251C90.3088 51.6607 89.9099 49.3414 89.054 47.1798C88.1944 45.0088 86.893 43.0454 85.2346 41.4176L85.2438 41.427C83.5266 39.7834 81.502 38.5046 79.2892 37.666C77.0765 36.8274 74.7204 36.446 72.3598 36.5441H51.1116H51.1093H51.0607C50.3899 36.5441 49.8464 37.0947 49.8464 37.7742V62.9406H41.0172H41.0149H40.9733C40.6475 62.9462 40.3368 63.0812 40.1084 63.3165C39.8799 63.5519 39.7519 63.8688 39.7519 64.1988V70.1618V70.1642V70.2134C39.7519 70.5396 39.8799 70.8525 40.1076 71.0832C40.3354 71.3139 40.6443 71.4435 40.9663 71.4435H49.8464V76.1553H41.0172H41.0149H40.9663C40.2955 76.1553 39.7519 76.7059 39.7519 77.3854V82.5447V82.5471V82.5963C39.7519 82.9225 39.8799 83.2354 40.1076 83.4661C40.3354 83.6968 40.6443 83.8264 40.9663 83.8264H49.8464V91.4927V91.4951V91.5443C49.8464 91.8705 49.9743 92.1834 50.202 92.4141C50.4298 92.6448 50.7387 92.7744 51.0607 92.7744H57.7086C58.0345 92.7744 58.3473 92.6448 58.5797 92.4133C58.812 92.1819 58.9453 91.8673 58.9507 91.5373V83.8264H78.8597H78.862H78.9106C79.5814 83.8264 80.1249 83.2757 80.1249 82.5963V77.4369V77.4346V77.3854C80.1249 76.7059 79.5814 76.1553 78.9106 76.1553H58.9507V71.4435H72.3205C74.6847 71.5468 77.0453 71.1687 79.2627 70.3316C81.4801 69.4945 83.5092 68.2154 85.23 66.57L85.2346 66.5653C86.8905 64.9404 88.1905 62.9809 89.0505 60.8142Z" fill="white"/>
                                </svg>                                            
                            </div>
                            
                            <?php wp_referer_field() ?>
                            <input type="hidden" name="user-id" value="<?php echo $user->ID ?>">
                            <input type="hidden" name="client_login" value="<?echo $user->first_name . " " . $user->last_name . " " . $user->surname_prof?>">
                            <input type="hidden" name="orderid" value="<?echo $user->ID . "ID" . time()?>">
                            <input type="hidden" name="optional_phone" value="<?echo $user->phone_prof?>">
                            <input type="hidden" name="user_tarif" value="min">
                            <input type="hidden" name="action" value="add-deposit">

                            <div class="left-deposit__title">Внести<br>платеж</div>
                        </button>
                    </form>

                    <form id="send-pay" action="/pay" name="" method="POST" enctype="multipart/form-data">
                        <button type="submit" class="content-left__deposit-btn" style="<?php echo $style_event_max ?>">
                            <span class="cachelink__help-ico cachelink__full-btn"></span>
                            <p class="cachelink__help-text cachelink__full-text" data-tooltip="Акция! Оплачивая полную сумму в первые 90 дней - вы будете получать не 15, а 30 тысяч в месяц!"></p>     

                            <div class="left-deposit__img">
                                <svg width="130" height="130" viewBox="0 0 130 130" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M65 130C100.899 130 130 100.899 130 65C130 29.1015 100.899 0 65 0C29.1015 0 0 29.1015 0 65C0 100.899 29.1015 130 65 130ZM80.8817 53.9785C80.8816 53.9816 80.8814 53.9848 80.8813 53.9879V53.9856V53.9692C80.8814 53.9723 80.8816 53.9754 80.8817 53.9785ZM80.2857 50.4753C80.7259 51.5875 80.929 52.7813 80.8817 53.9785C80.9303 55.1785 80.7276 56.3754 80.2869 57.4905C79.8451 58.6085 79.1742 59.6188 78.3184 60.4547L78.3253 60.4477C77.4184 61.2926 76.3552 61.9471 75.197 62.3734C74.0389 62.7997 72.8089 62.9893 71.578 62.9313H58.9623V45.0399H71.5572C72.7899 44.9788 74.0223 45.1662 75.183 45.5914C76.3436 46.0165 77.4094 46.6709 78.3184 47.5165L78.3207 47.5188C79.1746 48.3526 79.8443 49.3603 80.2857 50.4753ZM89.0505 60.8142C89.9104 58.6474 90.311 56.3217 90.2263 53.9879H90.2251C90.3088 51.6607 89.9099 49.3414 89.054 47.1798C88.1944 45.0088 86.893 43.0454 85.2346 41.4176L85.2438 41.427C83.5266 39.7834 81.502 38.5046 79.2892 37.666C77.0765 36.8274 74.7204 36.446 72.3598 36.5441H51.1116H51.1093H51.0607C50.3899 36.5441 49.8464 37.0947 49.8464 37.7742V62.9406H41.0172H41.0149H40.9733C40.6475 62.9462 40.3368 63.0812 40.1084 63.3165C39.8799 63.5519 39.7519 63.8688 39.7519 64.1988V70.1618V70.1642V70.2134C39.7519 70.5396 39.8799 70.8525 40.1076 71.0832C40.3354 71.3139 40.6443 71.4435 40.9663 71.4435H49.8464V76.1553H41.0172H41.0149H40.9663C40.2955 76.1553 39.7519 76.7059 39.7519 77.3854V82.5447V82.5471V82.5963C39.7519 82.9225 39.8799 83.2354 40.1076 83.4661C40.3354 83.6968 40.6443 83.8264 40.9663 83.8264H49.8464V91.4927V91.4951V91.5443C49.8464 91.8705 49.9743 92.1834 50.202 92.4141C50.4298 92.6448 50.7387 92.7744 51.0607 92.7744H57.7086C58.0345 92.7744 58.3473 92.6448 58.5797 92.4133C58.812 92.1819 58.9453 91.8673 58.9507 91.5373V83.8264H78.8597H78.862H78.9106C79.5814 83.8264 80.1249 83.2757 80.1249 82.5963V77.4369V77.4346V77.3854C80.1249 76.7059 79.5814 76.1553 78.9106 76.1553H58.9507V71.4435H72.3205C74.6847 71.5468 77.0453 71.1687 79.2627 70.3316C81.4801 69.4945 83.5092 68.2154 85.23 66.57L85.2346 66.5653C86.8905 64.9404 88.1905 62.9809 89.0505 60.8142Z" fill="white"/>
                                </svg>                                            
                            </div>
                        
                            <?php wp_referer_field() ?>
                            <input type="hidden" name="user-id" value="<?php echo $user->ID ?>">
                            <input type="hidden" name="client_login" value="<?echo $user->first_name . " " . $user->last_name . " " . $user->surname_prof?>">
                            <input type="hidden" name="orderid" value="<?echo $deposit_num->ID + 1?>">
                            <input type="hidden" name="optional_phone" value="<?echo $user->phone_prof?>">
                            <input type="hidden" name="user_tarif" value="max">
                            <input type="hidden" name="user_summ" value="<?php echo $deposit[0]->dp_remain ?>">
                            <input type="hidden" name="action" value="add-deposit">

                            <div class="left-deposit__title">Внести<br>полную сумму<?php //echo $r_date ?></div>
                        </button>
                    </form>
                </div>

                <div class="content-right__deposit">
                    <div class="content-right__contribute">
                        <div class="right-contribute__title">Осталось внести</div>
                        <div class="right-contribute__summ">
                            <h5>
                                <?php 
                                    if ($deposit[0]->dp_remain == 0) {
                                        echo "-";
                                    } else {
                                        echo number_format( $deposit[0]->dp_remain, 0, '', ' ' ); 
                                    }
                                ?>
                            </h5>
                            <span>
                                <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 0V14H0V16H2V20H4V16H10V14H4V11H11.5C14.526 11 17 8.526 17 5.5C17 2.474 14.526 0 11.5 0H2ZM4 2H11.5C13.444 2 15 3.556 15 5.5C15 7.444 13.444 9 11.5 9H4V2Z" fill="#005300"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="content-right__cachelink">
                        <span class="cachelink__help-ico"></span>
                        <p class="cachelink__help-text" data-tooltip="Если вы выведите средства, то таймер остановится и обнулится."></p>
                        <a href="/withdraw" class="right-cachelink__title">Вывести деньги и обнулить счётчик</a>
                    </div>
                </div>
            </div>

            <div class="content-wrapper__right" id="pay__screen-2">
                <div id="pay-screen__inner"></div>
            </div>
            <div class="loader">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/loader.gif" alt="loader">
            </div>
        </div>

        <!-- <div class="main-inner__content--wrapper link-tariff">
            <a href="/tariff" class="content-wrapper__link-tariff">Тарифы</a>
        </div>
        <div class="main-inner__content--wrapper link-politik">
            <a href="/privacy-policy" target="_blank" class="content-wrapper__link-politik">Политика компании</a>
        </div> -->

        <?php //include "content-news-list.php"; ?>
    </div>
</div>


