<?php get_header();?>
<?php
    if ( !is_user_logged_in() ) {
        //echo "<script>document.location.href='/';</script>";
        //echo "не залогинен";
    }
?>

<?php
global $current_user;
//wp_vardump( $_SESSION );
//wp_vardump( $_POST );
//exit;   

$client_login = $_SESSION['client_login'];
$orderid = $_SESSION['orderid'];
$payment_summ = $_SESSION['sum'];
$client_phone = $_SESSION['client_phone'];
$user_tarif = $_SESSION['user_tarif'];
$user_id = $_SESSION['user_id'];

//wp_vardump($user_id);
//wp_vardump($client_login);
//wp_vardump($orderid);
//wp_vardump($sum);
//wp_vardump($client_phone);
//wp_vardump($user_tarif);

//print "WMI_RESULT=" . strtoupper("OK") . "&";
//print "WMI_DESCRIPTION=" .urlencode("ok_message. page success");

//wp_vardump( $_SESSION );
//wp_vardump( $_POST );
//exit; 
?>

<?
    // echo '<div class="loader" style="display: block;">';
    // echo '<img src="' . get_template_directory_uri() . '/assets/images/loader.gif" alt="loader">';
    // echo '</div>';

    // //wp_vardump($_SESSION);
    // //exit;
    // global $wpdb;
    // $user = $user_id;
    // if ( !$user )
    //     wp_die( "Нет такого пользователя!..." );
    
    // $query = "SELECT * FROM tv_deposit WHERE dp_user_id = $user_id";
    // $result_db = $wpdb->get_results( $query );


    // if ( $user_tarif == 'min' ) {
    //     $mounth = $payment_summ / DEPOSIT_MONTH;
        
    //     if ( $result_db[0]->dp_date_next == NULL ) {
    //         $dp_date_next = date('Y-m-d H:i:s', strtotime('+' . $mounth . ' month'));
    //     } else {
    //         $dp_date_next = date('Y-m-d H:i:s', strtotime('+' . $mounth . ' month', strtotime($result_db[0]->dp_date_next)));
    //     }
    // } else {
    //     $dp_date_next = date('Y-m-d H:i:s', strtotime('+3 month'));
    // }
    // //$new_next = date('Y-m-d H:i:s', strtotime('+' . $mounth . ' month', strtotime($result_db[0]->dp_date_next)));

    // //var_dump($mounth );
    // //var_dump($result_db[0]->dp_date_next );
    // //var_dump($new_next );
    // //exit;
    // if ( $user_tarif == 'min' ) { // Тариф min
    //     // Пока так, но сумма платежа и дата платеж вносятся после подтверждения банком
    //     if ($result_db[0]->dp_summ == 0) { // Первый платеж
    //         $date_out_t = date('Y-m-d H:i:s', strtotime('+5 year'));
    //         $dp_date_out = DateTime::createFromFormat('Y-m-d H:i:s', $date_out_t);
    //         $end_date_full = $dp_date_out->diff( new DateTime() )->format('%a');

    //         //echo "+++> ";var_dump($date_out_t );
    //         //echo "end date ";var_dump($end_date_full );exit;
    //         $results = $wpdb->update( 
    //             'tv_deposit', 
    //             [
    //                 'dp_active'         => 1,
    //                 'dp_tarif'          => $user_tarif,
    //                 'dp_refpay'         => REFPAY_1,
    //                 'dp_summ'           => $payment_summ,
    //                 'dp_date_add'       => date('Y-m-d H:i:s'),
    //                 'dp_date_next'      => $dp_date_next,
    //                 'dp_add'            => $result_db[0]->dp_add + $payment_summ,
    //                 'dp_remain'         => $result_db[0]->dp_remain - $payment_summ,
    //                 'dp_date_out'       => $date_out_t,
    //                 'dp_date_full_out'  => $end_date_full,
    //             ],
    //             [ 'dp_user_id' => $user_id ]
    //         );

    //         // Ищем реферера, обновляем выплаты дивидендов на 15000
    //         $query_ref = "SELECT * FROM tv_referal WHERE ref_id = $user_id";
    //         $result_ref_db = $wpdb->get_results( $query_ref );
            
    //         if (isset($result_ref_db[0]->user_id)) {
    //             $query_user_id = $result_ref_db[0]->user_id;
    //             $query_referer = "SELECT * FROM tv_deposit WHERE dp_user_id = $query_user_id";
    //             $result_referer = $wpdb->get_results( $query_referer );

    //             if ($result_referer[0]->dp_refpay == REFPAY_1) {
    //                 $results = $wpdb->update( 
    //                     'tv_deposit', 
    //                     [
    //                         'dp_refpay' => REFPAY_2,
    //                     ],
    //                     [ 'dp_user_id' => $query_user_id ]
    //                 );
    //             } 
    //         }

    //         //echo "<h3> Вариант 1 </h3>";
    //         //wp_vardump($results);
    //         $result = "OK";
    //         $description = "Variant 1";
    //         print_answer($result, $description);

    //     } else { // Следующий платеж
    //         $dp_date_out = DateTime::createFromFormat('Y-m-d H:i:s', $result_db[0]->dp_date_out);
    //         $end_date_full = $dp_date_out->diff( new DateTime() )->format('%a');
            
    //         $results = $wpdb->update( 
    //             'tv_deposit', 
    //             [      
    //                 'dp_summ'           => $payment_summ,
    //                 'dp_date_add'       => date('Y-m-d H:i:s'),
    //                 'dp_date_next'      => $dp_date_next,
    //                 'dp_add'            => $result_db[0]->dp_add + $payment_summ,
    //                 'dp_remain'         => $result_db[0]->dp_remain - $payment_summ,
    //                 //'dp_date_full_out'  => $end_date_full,
    //             ],
    //             [ 'dp_user_id' => $user_id ]
    //         );

    //         // echo "<h3> Вариант 2 </h3>";
    //         // wp_vardump($results);
    //         $result = "OK";
    //         $description = "Variant 2";
    //         print_answer($result, $description);

    //     }
    // } else { // Тариф max
    //     //wp_vardump($payment_summ);exit;
    //     // Если полная сумма в течение 90 дней - дивиденды 30000
    //     // На частичную выплату не ставим, т.к. врядли пользователь будет оплачивать в течение 3-х мес. всю сумму этой кнопкой
    //     if ( date('Y-m-d H:i:s') > date('Y-m-d H:i:s', strtotime('+3 month', strtotime($result_db[0]->dp_date_reg))) ) { // $result_db[0]->dp_date_reg >= strtotime(date('Y-m-d H:i:s', strtotime('+3 month')))
    //         //echo "&nbsp;--- ";
    //         $dp_refpay = REFPAY_2;
    //     } else {
    //         //echo "&nbsp;+++ ";
    //         $dp_refpay = REFPAY_3;
    //     }
    //     /*wp_vardump(date('Y-m-d H:i:s', strtotime('+3 month', strtotime($result_db[0]->dp_date_reg))));
    //     echo "&nbsp;<br>";
    //     wp_vardump(date('Y-m-d H:i:s'));
    //     echo "&nbsp;<br>";
    //     wp_vardump($dp_refpay);
    //     exit;*/
    //     $results = $wpdb->update( 
    //         'tv_deposit', 
    //         [      
    //             'dp_active'         => 1,
    //             'dp_tarif'          => $user_tarif,
    //             'dp_refpay'         => $dp_refpay,
    //             'dp_summ'           => $payment_summ,
    //             'dp_date_add'       => date('Y-m-d H:i:s'),
    //             'dp_date_next'      => NULL,
    //             'dp_add'            => $result_db[0]->dp_add + $payment_summ,
    //             'dp_remain'         => $result_db[0]->dp_remain - $payment_summ,
    //             'dp_date_full_out'  => NULL,
    //         ],
    //         [ 'dp_user_id' => $user_id ]
    //     );
    // }
    
    // $_SESSION['client_login'] = '';
    // $_SESSION['orderid'] = '';
    // $_SESSION['sum'] = '';
    // $_SESSION['client_phone'] = '';
    // $_SESSION['user_tarif'] = '';
    // $_SESSION['user_id'] = '';

    // if ( $results === 'false' ) {
    //     //echo "<h3> Вариант 3 </h3>";
    //     //wp_vardump($results);
    //     $result = "RETRY";
    //     $description = "FALSE";

    //     print_answer($result, $description);
    // }

    // function print_answer($result, $description)
    // {
    //     print "WMI_RESULT=" . strtoupper($result) . "&";
    //     print "WMI_DESCRIPTION=" .urlencode($description);

    //     //print "WMI_RESULT=" . strtoupper("RETRY") . "&";
    //     //print "WMI_DESCRIPTION=" .urlencode("FALSE");
        
    //     //exit();
    // }

    // $_SESSION['result'] = $results;
    // $_SESSION['description'] = $description;

    // wp_vardump($results);
    // wp_vardump($description);
    // //echo "<script>document.location.href='/purse';</script>";


    // Секретный ключ интернет-магазина (настраивается в кабинете)

$skey = "4a6153725657415f6d6973614d6a34675c3438744f754a686a3348";

// Функция, которая возвращает результат в Единую кассу

function print_answer($result, $description)
{
print "WMI_RESULT=" . strtoupper($result) . "&";
print "WMI_DESCRIPTION=" .urlencode($description);
exit();
}

// Проверка наличия необходимых параметров в POST-запросе

if (!isset($_POST["WMI_SIGNATURE"]))
print_answer("Retry", "Отсутствует параметр WMI_SIGNATURE");

if (!isset($_POST["WMI_PAYMENT_NO"]))
print_answer("Retry", "Отсутствует параметр WMI_PAYMENT_NO");

if (!isset($_POST["WMI_ORDER_STATE"]))
print_answer("Retry", "Отсутствует параметр WMI_ORDER_STATE");

// Извлечение всех параметров POST-запроса, кроме WMI_SIGNATURE

foreach($_POST as $name => $value)
{
if ($name !== "WMI_SIGNATURE") $params[$name] = $value;
}

// Сортировка массива по именам ключей в порядке возрастания
// и формирование сообщения, путем объединения значений формы

uksort($params, "strcasecmp"); $values = "";

foreach($params as $name => $value)
{
//Конвертация из текущей кодировки (UTF-8)
//необходима только если кодировка магазина отлична от Windows-1251
$value = iconv("utf-8", "windows-1251", $value);
$values .= $value;
}

// Формирование подписи для сравнения ее с параметром WMI_SIGNATURE

$signature = base64_encode(pack("H*", md5($values . $skey)));

//Сравнение полученной подписи с подписью W1

if ($signature == $_POST["WMI_SIGNATURE"])
{
if (strtoupper($_POST["WMI_ORDER_STATE"]) == "ACCEPTED")
{
// TODO: Пометить заказ, как «Оплаченный» в системе учета магазина

print_answer("Ok", "Заказ #" . $_POST["WMI_PAYMENT_NO"] . " оплачен!");
}
else
{
// Случилось что-то странное, пришло неизвестное состояние заказа

print_answer("Retry", "Неверное состояние ". $_POST["WMI_ORDER_STATE"]);
}
}
else
{
// Подпись не совпадает, возможно вы поменяли настройки интернет-магазина

print_answer("Retry", "Неверная подпись " . $_POST["WMI_SIGNATURE"]);
}

?>

<?php get_footer(); ?>