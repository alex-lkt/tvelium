<?php 
$user = wp_get_current_user();

global $wpdb;
$query = "SELECT * FROM tv_withdraw WHERE user_id = $user->ID";
$withdraw = $wpdb->get_results( $query );

$query = "SELECT * FROM tv_deposit WHERE dp_user_id = $user->ID AND dp_active = 1";
$deposit = $wpdb->get_results( $query );

//wp_vardump($user);
?>

<div class="main-inner">
    <div class="main-inner__content">
        <div class="breadcrumbs-box">
            <span class="breadcrumbs-nolink">Главная</span>
            <span class="breadcrumbs-strip">/</span>
            <a href="#" class="breadcrumbs-link">Вывод денежных средств</a>
        </div>

        <div class="main-inner__content--wrapper box-noborder-nocolumn">
            <div class="content-help__box-left withdraw-box">
                <h2 class="content-help__title">Заявка на вывод</h2>
                <form class="help-chat" action="<?php echo esc_url(admin_url( 'admin-post.php' )) ?>" name="" method="POST" enctype="multipart/form-data">
                    <div class="help-title__box">
                        <input type="text" name="enquiry-summ" class="help-edit__title-input" id="help-title" value="<?php echo $deposit[0]->dp_add ?>" readonly> руб.
                    </div>
                    
                    <textarea id="help-text" name="requisite" placeholder="Введите банковские реквизиты или номер карты для вывода денежных средств"></textarea>

                    <?php wp_referer_field() ?>
                    <input type="hidden" name="user-id" value="<?php echo $user->ID ?>">
                    <input type="hidden" name="post-type" value="withdraw">
                    <input type="hidden" name="action" value="add-withdraw">

                    <input type="submit" class="btn btn-green" value="отправить">
                </form>
            </div>
            
            <div class="content-help__box-img">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/bg-help.svg" alt="Техническая поддержка">
            </div>
        </div>

        <div class="main-inner__content--wrapper box-noborder-nocolumn">
            <div class="help-table__box">
                <table class="content-help__table">
                    <tr class="help-table__header">
                        <td>№<br>заявки</td>
                        <td>Дата</td>
                        <td>Реквизиты</td>
                        <td>Статус</td>
                    </tr>
                <?php                
                    foreach( $withdraw as $item ){
                        switch ($item->enquiry_status) {
                            case '0':
                                $status = 'создана';
                                $status_class = 'withdraw_0';
                                break;
                            case '1':
                                $status = 'в обработке';
                                $status_class = 'withdraw_1';
                                break;
                            case '2':
                                $status = 'исполнено';
                                $status_class = 'withdraw_2';
                                break;
                        }
                    ?>
                    <tr class="help-table__text">
                        <td><?php echo $item->ID ?></td>
                        <td><?php echo $item->enquiry_date ?></td>
                        <td><?php echo $item->requisite; ?></td>
                        <td><span class="help-status <?php echo $status_class ?>"><?php echo $status ?></span></td>
                    </tr>    
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>