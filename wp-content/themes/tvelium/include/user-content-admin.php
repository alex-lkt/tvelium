<?php
global $wpdb;
$query_users = "SELECT * FROM tv_deposit WHERE dp_active = 1";
$db_users = $wpdb->get_results( $query_users );
foreach ( $db_users as $item ) {
    $list_users[$item->dp_user_id] = $item;
}

$number = 50;
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
?>

<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Личный кабинет</h2>

        <div class="main-inner__content--wrapper content-clients admin-box box-noborder">
            <div href="#" class="btn-admin-50">
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s30-1">Пользователи</span>
                    <span class="btn-admin__summ"><?php echo count($users_s); ?></span>
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
                            <td>№</td>
                            <td>ФИО пользователя</td>
                            <td>E-mail</td>
                            <td>Телефон</td>
                            <td class="table-td__center">До выплаты,<br>день</td>
                            <td class="table-td__center">До платежа,<br> день</td>
                        </tr>
                        <?php 
                            $num = ($paged * $number) - $number;

                            foreach( $users_subscriber as $i => $user ): 
                                if ( isset($list_users[$user->ID]) AND $list_users[$user->ID]->dp_date_full_out == NULL ) {
                                    $color_class = "tr-user-status-stop";
                                } else {
                                    $color_class = "";
                                }
                            ?>
                        <tr class="help-table__text <?php echo $color_class ?>">
                            <td><?php echo ++$num ?></td>
                            <td>
                                <a href="/viewresume/?r=<?php echo $user->user_nicename ?>" class="help-table__link">
                                    <?php echo $user->first_name . "<br>" . $user->last_name . " " . $user->surname_prof ?>
                                </a>
                            </td>
                            <td><?php echo $user->user_email ?></td>
                            <td><a href="tel:+7 999 123-45-67"><?php echo $user->phone_prof ?></a></td>
                            <td class="table-td__center">
                                <?php 
                                    if ( !isset($list_users[$user->ID]->dp_date_full_out) OR $list_users[$user->ID]->dp_date_full_out == NULL ) {
                                        echo "0";
                                    } else {
                                        echo $list_users[$user->ID]->dp_date_full_out;
                                    }
                                ?>
                            </td>
                            <td class="table-td__center">
                                <?php 
                                    if ( !isset($list_users[$user->ID]->dp_date_next) OR $list_users[$user->ID]->dp_date_next == NULL ) {
                                        echo "0";
                                    } else {
                                        $c_date = time();
                                        $t_next = strtotime($list_users[$user->ID]->dp_date_next);
                                        $day_date = ceil(abs($t_next - $c_date) / 86400);
                                        echo $day_date;
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                
                <div class="help-color__desc"> <!-- tr-user-status-stop -->
                    <span></span>
                    <p>счётчик остановлен</p>
                </div>
            </div>
        </div>

        <div class="main-inner__content--wrapper box-noborder-nocolumn box-content__footer-link">
            <div class="content__pagination">
                <?php
                    if ($total_users > $total_pages) {  
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
                    foreach ( $paginate_arr as $arr_item) {
                        echo $arr_item;
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