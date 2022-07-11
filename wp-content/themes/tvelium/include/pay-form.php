<?php 
//wp_vardump($_POST);exit;
if (
    (isset($_POST['client_login']) AND !empty($_POST['client_login'])) AND
    (isset($_POST['orderid']) AND !empty($_POST['orderid'])) AND
    (isset($_POST['optional_phone']) AND !empty($_POST['optional_phone']))
) {
    $_SESSION['user_tarif'] = $_POST['user_tarif'];

    if (isset($_POST['user_summ']) AND !empty($_POST['user_summ'])) 
    {
        $sum = $_POST['user_summ'];
    } else 
    {
        $sum = DEPOSIT_MONTH;
    }
    $client_login = $_POST['client_login'];
    $orderid = $_POST['orderid'];
    $client_phone = $_POST['optional_phone'];
} else {
    echo 0;
}
?>


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

$query = "SELECT * FROM tv_deposit WHERE dp_user_id = $user->ID AND dp_active = 1";
$deposit = $wpdb->get_results( $query );

$curr_date = new DateTime();

// Дата следующей оплаты
if (time() >= strtotime($deposit[0]->dp_date_next)) {
    $end_date_day = "";
} else {
    if($deposit[0]->dp_date_next != NULL OR $deposit[0]->dp_add > 0) {
        $db_date_day = DateTime::createFromFormat('Y-m-d H:i:s', $deposit[0]->dp_date_next);
        $end_date_day = $db_date_day->diff($curr_date);//->format('%D:%H:%I');
        $end_date_day_btn = $db_date_day->diff($curr_date);
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
//wp_vardump( $deposit[0]->dp_date_next );


$item_min = json_encode(
    array (
        "Title" => "Tarif-min",
        "Quantity" => '1.000',
        "UnitPrice" => '3000.00', //
        "SubTotal" => '3000.00', //
        "TaxType" => "tax_ru_1",
        "Tax" => '0.00'
        )
    ); 

$timestamp = time()+date("Z");

$key = "4a6153725657415f6d6973614d6a34675c3438744f754a686a3348"; 
$merch_id = "193464634062"; // 161596709896
$order_items = '[' . $item_min .']';

$fields = array();
	
$fields["WMI_CURRENCY_ID"]        = "643";
$fields["WMI_DESCRIPTION"]        = "BASE64:".base64_encode("Пополнение лицевого счета");	
$fields["WMI_FAIL_URL"]           = "https://soft-tester.ru/fail/";
$fields["WMI_SUCCESS_URL"]        = "https://soft-tester.ru/success/";
$fields["WMI_MERCHANT_ID"]        = $merch_id;
$fields["WMI_PAYMENT_AMOUNT"]     = $sum; // $sum
$fields["WMI_PAYMENT_NO"]         = $orderid;
$fields["WMI_ORDER_ITEMS"]        = $order_items;
$fields["WMI_PTENABLED"]          = ["TestCardRUB"]; // "CreditCardRUB","PsbRetailRUB","AlfaclickRUB","WalletOneRUB"  /  
//$fields["WMI_CUSTOMER_PHONE"]     = "+79855694578"; // $user->phone_prof
$fields["WMI_CUSTOMER_EMAIL"]     = $user->user_email;
$fields["WMI_EXPIRED_DATE"]       = gmdate("Y/m/d H:i:s T", $timestamp); // gmdate(DATE_W3C)

foreach($fields as $name => $val)
{
    if(is_array($val))
    {
        usort($val, "strcasecmp");
        $fields[$name] = $val;
    }
}

uksort($fields, "strcasecmp");
$fieldValues = "";

foreach($fields as $value)
{
    if(is_array($value))
        foreach($value as $v)
        {
            $v = iconv("utf-8", "windows-1251", $v);
            $fieldValues .= $v;
        }
    else
    {
        $value = iconv("utf-8", "windows-1251", $value);
        $fieldValues .= $value;
    }
}

$signature = base64_encode(pack("H*", md5($fieldValues . $key)));
$fields["WMI_SIGNATURE"] = $signature;

$_SESSION['client_login'] = $user->first_name . " " . $user->last_name . " " . $user->surname_prof;
$_SESSION['orderid'] = $deposit_num->ID + 1;
$_SESSION['sum'] = $sum;
$_SESSION['client_phone'] = $user->phone_prof; //
$_SESSION['user_id'] = $user->ID;
$_SESSION['order_item'] = $order_items;
//echo "user_id "; wp_vardump($_SESSION['user_id']);
//echo "client_login "; wp_vardump($_SESSION['client_login']);
//echo "orderid "; wp_vardump($_SESSION['orderid']);
//echo "sum "; wp_vardump($_SESSION['sum']);
//echo "client_phone "; wp_vardump($_SESSION['client_phone']);
//echo "user_tarif "; wp_vardump($_SESSION['user_tarif']);
//wp_vardump($_SESSION);
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
                    <div class="right-pay__title">До выплаты осталось:</div>
                    <div class="right-pay__diagram">
                        <div class="diagram-box">
                            <div class="diagram-box-inner">
                                <span class="diagram-box__num"><?php echo ($deposit[0]->dp_date_full_out != '') ? $deposit[0]->dp_date_full_out : '0' ?></span>
                                <span class="diagram-box__text">дней</span>
                            </div>
                        </div>
                    </div>
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

            <div class="content-wrapper__right">
                <div id="pay-screen__inner">
                <?
                print "<form action='https://wl.walletone.com/checkout/checkout/Index' method='POST'>";

                foreach($fields as $key => $val)
                {
                    if(is_array($val))
                        foreach($val as $value)
                        {
                            print "$key: <input type='text' name='$key' value='$value' style='margin: 10px 0px; width: 400px;' readonly/><br />";
                        }
                    else
                        print "$key: <input type='text' name='$key' value='$val' style='margin: 10px 0px; width: 400px;' readonly/><br />";
                }
                
                print "<input type='submit' style='margin: 10px 0px;'/></form>";
                ?>

                </div>
            </div>

            <div class="loader">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/loader.gif" alt="loader">
            </div>
        </div>

    </div>
</div>


