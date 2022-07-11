<?php
global $wpdb;
$list_users = [];
$list_enquiry = [];

$withdraw_status = [
    0 => 'создано',
    1 => 'в обработке',
    2 => 'исполнено',
    3 => 'отклонено',
];

$query_users = "SELECT * FROM tv_withdraw";
$db_users = $wpdb->get_results( $query_users );
foreach ( $db_users as $item ) {
    $list_withdraw[$item->user_id] = $item;
    if ( $item->enquiry_status == 2 ) {
        $list_enquiry[$item->user_id] = $item;
    }
}

$number = 5;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset = ($paged - 1) * $number;
$total_users = count($db_users);

$users_subscriber_db = get_users( array(
    'role'   => 'subscriber',
    'offset' => $offset, // 
    'number' => $number,
) );
foreach ( $users_subscriber_db as $u_item ) {
    $users_subscriber[$u_item->ID] = $u_item;
}

$total_pages = round($total_users / $number) + 1;
//wp_vardump($list_withdraw);
//wp_vardump($users_subscriber);
?>

<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Заявки на вывод денежных средств</h2>

        <div class="main-inner__content--wrapper content-clients admin-box box-noborder">
            <div href="#" class="btn-admin-50" style="width: 60%;">
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s30-1">Выведено</span>
                    <span class="btn-admin__summ"><?php echo count($list_enquiry); ?></span>
                    <span class="btn-admin__text-other">человек</span>
                </div>
                <span class="ico-btn-other adm-btn-rotate"></span>
            </div>
        </div>

        <div class="main-inner__content--wrapper content-clients box-noborder-nocolumn">
            <div class="help-table__box">
                <div class="overflow-box">
                    <table class="content-help__table">
                        <tr class="help-table__header">
                            <td class="table-td__center">№<br>п/п</td>
                            <td class="table-td__center">№<br>заявки</td>
                            <td class="table-td__center">ФИО пользователя</td>
                            <td class="table-td__center">E-mail</td>
                            <td class="table-td__center">Телефон</td>
                            <td class="table-td__center">Реквизиты</td>
                            <td class="table-td__center">Сумма, руб.</td>
                            <td class="table-td__center">Статус</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php 
                            $num = ($paged * $number) - $number;

                            foreach( $list_withdraw as $key => $withdraw ): 
                                if ( isset($users_subscriber[$key]) ):
                                    switch ($item->enquiry_status) {
                                        case '0':
                                            $status_class = 'withdraw_0';
                                            break;
                                        case '1':
                                            $status_class = 'withdraw_1';
                                            break;
                                        case '2':
                                            $status_class = 'withdraw_2';
                                            break;
                                        case '3':
                                            $status_class = 'withdraw_2';
                                            break;
                                    }
                            ?>
                        <tr class="help-table__text <?php echo $status_class ?>">
                            <form class="" action="<?php echo esc_url(admin_url( 'admin-post.php' )) ?>" name="" method="POST" enctype="multipart/form-data">
                                <td><?php echo ++$num ?></td>
                                <td><?php echo $withdraw->ID ?></td>
                                <td>
                                    <!-- <a href="/paymentout/?r=<?php echo $withdraw->ID ?>" class="help-table__link"> -->
                                        <?php echo $users_subscriber[$key]->first_name . "<br>" . $users_subscriber[$key]->last_name . " " . $users_subscriber[$key]->surname_prof ?>
                                    <!-- </a> -->
                                </td>
                                
                                <td><?php echo $users_subscriber[$key]->user_email ?></td>
                                <td><a href="tel:<?php echo $users_subscriber[$key]->phone_prof ?>"><?php echo $users_subscriber[$key]->phone_prof ?></a></td>
                                <td class="table-td__center"><?php echo $withdraw->requisite ?></td>
                                <td class="table-td__center"><?php echo number_format( $withdraw->enquiry_summ, 0, '', ' ' ); ?></td>
                                <td class="table-td__center">
                                    <select name="withdraw-status" id="">
                                        <?php foreach( $withdraw_status as $n => $status ): ?>
                                            <?php if ( $n == $withdraw->enquiry_status ): ?>
                                                <option value="<?php echo $n ?>" selected><?php echo $status ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $n ?>"><?php echo $status ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>    
                                </td>
                                <td class="table-td__center">
                                    <?php wp_referer_field() ?>
                                    <input type="hidden" name="user-id" value="<?php echo $users_subscriber[$key]->ID ?>">
                                    <input type="hidden" name="withdraw-id" value="<?php echo $withdraw->ID ?>">
                                    <input type="hidden" name="withdraw-summ" value="<?php echo $withdraw->enquiry_summ ?>">
                                    <input type="hidden" name="action" value="out-withdraw">
                                    <button type="submit" class="btn withdraw-btn">Выполнить</button>
                                </td>
                            </form>
                        </tr>
                        <?php 
                            endif;
                        endforeach; ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="main-inner__content--wrapper box-noborder-nocolumn box-content__footer-link">
            <div class="content__pagination">
                <?php
                    if ($total_users > $total_pages) { 
                        $paginate_arr = [];
                        
                        $current_page = max(1, get_query_var('paged'));  

                        $paginate_arr = paginate_links(array(  
                              'base'      => get_pagenum_link(1) . '%_%',  
                              'format'    => 'page/%#%/',  
                              'current'   => $current_page,  
                              'total'     => $total_pages,  
                              'prev_next' => false,  
                              'type'      => 'array',  
                        ));  
                    }  
                    if ( !empty($paginate_arr) ) {
                        foreach ( $paginate_arr as $arr_item) {
                            echo $arr_item;
                        }
                    }
                    
                    //wp_vardump( $offset );
                ?>
            </div>

            <div class="btn-link__prew-next">
                <a href="/kabinet" class="link-prew">Назад</a>
            </div>
        </div>
    </div>
</div>