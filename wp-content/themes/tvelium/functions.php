<?php
use PHPMailer\PHPMailer\PHPMailer;

add_action('init', 'start_session', 1);

function start_session() {
    if(!session_id()) {
        session_start();
    }
}

add_action('wp_logout', 'end_session');
add_action('wp_login', 'end_session');
add_action('end_session_action', 'end_session');

function end_session() {
    session_destroy ();
}

add_action( 'wp_enqueue_scripts', 'theme_styles' );
add_action( 'wp_enqueue_scripts', 'theme_scripts' );
add_action( 'wp_enqueue_scripts', 'true_loadmore_scripts' );

add_theme_support( 'post-thumbnails', array('post', 'catalog', 'product') );

function theme_styles() {
    wp_enqueue_style( 'styles', get_stylesheet_uri() );
    wp_enqueue_style( 'default', get_template_directory_uri() . '/assets/css/style.min.css' );
}

function theme_scripts() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//code.jquery.com/jquery-3.6.0.min.js' );
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'main', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], null, true );
    wp_localize_script( 'main', 'mainajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' )
    ) );
    wp_enqueue_script( 'main' );
}

/* Подключение скриптов для ленивой загрузки */
function true_loadmore_scripts() {
 	wp_enqueue_script( 'true_loadmore', get_stylesheet_directory_uri() . '/js/loadmore.js', array( 'jquery' ), time() // не кэшируем файл, убираем эту строчку после завершение разработки
	);
 
	wp_enqueue_script( 'true_loadmore' );
}

/* Тип записи: Новости, Проекты, Вакансии */
add_action( 'init', 'register_post_types' );

function register_post_types(){
	register_post_type( 'news', [
		'label'  => null,
		'labels' => [
			'name'               => 'Новости', 
			'singular_name'      => 'Новости', 
			'add_new'            => 'Добавить новость', 
			'add_new_item'       => 'Добавление новости', 
			'edit_item'          => 'Редактирование новости', 
			'new_item'           => 'Новая новость', 
			'view_item'          => 'Смотреть новость', 
			'search_items'       => 'Искать новость', 
			'not_found'          => 'Не найдено', 
			'not_found_in_trash' => 'Не найдено', 
			'parent_item_colon'  => '', 
			'menu_name'          => 'Новости', 
		],
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true, 
		'exclude_from_search' => false, 
		'show_ui'             => true, 
		'show_in_nav_menus'   => true, 
		'show_in_menu'        => true, 
		'show_in_admin_bar'   => true, 
		'show_in_rest'        => null, 
		'rest_base'           => null, 
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-insert', 
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
		'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
    register_post_type( 'project', [
		'label'  => null,
		'labels' => [
			'name'               => 'Проекты', 
			'singular_name'      => 'Проекты', 
			'add_new'            => 'Добавить проект', 
			'add_new_item'       => 'Добавить проект', 
			'edit_item'          => 'Редактировать проект', 
			'new_item'           => 'Новый проект', 
			'view_item'          => 'Смотреть проект', 
			'search_items'       => 'Искать проект', 
			'not_found'          => 'Не найдено', 
			'not_found_in_trash' => 'Не найдено', 
			'parent_item_colon'  => '', 
			'menu_name'          => 'Проекты', 
		],
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true, 
		'exclude_from_search' => false, 
		'show_ui'             => true, 
		'show_in_nav_menus'   => true, 
		'show_in_menu'        => true, 
		'show_in_admin_bar'   => true, 
		'show_in_rest'        => null, 
		'rest_base'           => null, 
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-media-document', //
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
		'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
    register_post_type( 'vacancy', [
		'label'  => null,
		'labels' => [
			'name'               => 'Вакансии', 
			'singular_name'      => 'Вакансии', 
			'add_new'            => 'Добавить вакансию', 
			'add_new_item'       => 'Добавление вакансии', 
			'edit_item'          => 'Редактировать вакансию', 
			'new_item'           => 'Новая вакансия', 
			'view_item'          => 'Смотреть вакансию', 
			'search_items'       => 'Искать вакансию', 
			'not_found'          => 'Не найдено', 
			'not_found_in_trash' => 'Не найдено', 
			'parent_item_colon'  => '', 
			'menu_name'          => 'Вакансии', 
		],
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true, 
		'exclude_from_search' => false, 
		'show_ui'             => true, 
		'show_in_nav_menus'   => true, 
		'show_in_menu'        => true, 
		'show_in_admin_bar'   => true, 
		'show_in_rest'        => null, 
		'rest_base'           => null, 
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-welcome-write-blog', //
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
		'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
    register_post_type( 'support', [
		'label'  => null,
		'labels' => [
			'name'               => 'Техподдержка', 
			'singular_name'      => 'Техподдержка', 
			'add_new'            => 'Задать вопрос', 
			'add_new_item'       => 'Сделать запрос', 
			'edit_item'          => 'Редактировать вопрос', 
			'new_item'           => 'Новый запрос', 
			'view_item'          => 'Смотреть запросы', 
			'search_items'       => 'Искать запрос', 
			'not_found'          => 'Не найдено', 
			'not_found_in_trash' => 'Не найдено', 
			'parent_item_colon'  => '', 
			'menu_name'          => 'Техподдержка', 
		],
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true, 
		'exclude_from_search' => false, 
		'show_ui'             => true, 
		'show_in_nav_menus'   => true, 
		'show_in_menu'        => true, 
		'show_in_admin_bar'   => true, 
		'show_in_rest'        => null, 
		'rest_base'           => null, 
		'menu_position'       => 4,
		'menu_icon'           => 'dashicons-buddicons-buddypress-logo', //
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'custom-fields' ],
		'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );
}

/* Авторизация */
add_action( 'wp_ajax_truepostauth', 'true_post_auth' );
add_action( 'wp_ajax_nopriv_truepostauth', 'true_post_auth' );

function true_post_auth() {
    $login = trim(strip_tags($_POST['userlogin']));
    $password = trim(strip_tags($_POST['userpass']));
    $res = wp_authenticate($login, $password);

    if( !is_wp_error($res) ) {
        wp_set_auth_cookie( $res->ID );
        wp_die( get_userdata( $res->ID )->user_login, 200 );
    } else {
        //wp_die($auth->get_error_message());
        wp_die(0);
    }

    die;
}

/* Регистрация пользователя */
add_action( 'wp_ajax_nopriv_truepostreg', 'true_post_reg' );

function true_post_reg() {
    global $wpdb;
    //wp_vardump( $_POST );

    $surname = $_POST['surname'];
    $userphone = $_POST['userphone'];
    $refcode = $_POST['refcode'];
    $city = $_POST['city_prof'];

    $query_users = "SELECT * FROM tv_usermeta WHERE meta_key='refcode_prof' AND meta_value='$refcode'";
    $user_db = $wpdb->get_results( $query_users );
    
    //wp_vardump( $user_db );//exit;

    if ( !empty($user_db[0]) ) { // !empty($user_db[0])
        $userdata = [
            'user_login' => $_POST['useremail'],
            'user_email' => $_POST['useremail'],
            'user_pass'  => $_POST['userpassword'],

            'first_name' => $_POST['firstname'],
            'last_name' => $_POST['lastname'],
        ];

        $new_user_id =  wp_insert_user( $userdata );
        //wp_vardump( $new_user_id->errors['existing_user_login'][0] );
        if( ! is_wp_error( $new_user_id ) ){
            update_user_meta( $new_user_id,'refcode_prof', generate_string(15));
            update_user_meta( $new_user_id,'phone_prof', sanitize_text_field( $userphone ) );
            update_user_meta( $new_user_id,'surname_prof', sanitize_text_field( $surname ) );
            update_user_meta( $new_user_id,'city_prof', sanitize_text_field( $city ) );
            update_user_meta( $new_user_id,'show_admin_bar_front', 'false' );
            
            // Установка реферала. /*Удаление реф кода*/
            update_user_meta( $user_db[0]->user_id, 'refuser_prof', $new_user_id );
            //update_user_meta( $user_db[0]->user_id, 'refcode_prof', '' );

            // Установка реферала в tv_referal
            $results = $wpdb->insert(
                'tv_referal',
                array(
                    'user_id'        => $user_db[0]->user_id,
                    'ref_id'         => $new_user_id,
                    'date_add'       => current_time( 'mysql' ),
                )
            );

            $results = $wpdb->insert(
                'tv_deposit',
                array(
                    'dp_active'         => 1,
                    'dp_user_id'        => $new_user_id,
                    'dp_remain'         => DEPOSIT_SUMM,
                    'dp_date_reg'       => current_time( 'mysql' ),
                    //'dp_date_next'      => date('Y-m-d H:i:s', strtotime('+3 month')),
                )
            );

            if ( $results === 'false' ) {
               wp_die( 'Что то не так!' );
               //wp_die( $results ); // return убрать
               //return $results;
            }
            wp_new_user_notification( $new_user_id, 'both' );
            //wp_vardump( "111" );

            //return $new_user_id;
            wp_die( $new_user_id, 200 );
            
        }
        else {
            //wp_vardump( "222" );
            //return  $new_user_id->get_error_message();
            wp_die( $new_user_id->errors['existing_user_login'][0] );
            //wp_vardump( $new_user_id );
        }
    } else {
        wp_die( 'Такого реферального кода не существует!' );
        //wp_vardump( "333" );
       // wp_die( $new_user_id );
        //wp_vardump( "333" );
            //return $new_user_id;
    }
}

/* Проверка пользователя на существование */
add_action( 'wp_ajax_nopriv_trueuser', 'true_getuser' );

function true_getuser() {
    global $wpdb;
    $user_id = trim($_POST['user_id']);

    $query_users = "SELECT * FROM  tv_users WHERE ID='$user_id'";
    $user_db = $wpdb->get_results( $query_users );

    if ( isset($user_db[0]) ) {
        die( $user_db[0]->ID );
    } else {
        die( 0 );
    }
}

/* Письмо о регистрации */
add_filter( 'wp_new_user_notification_email', 'hpl_user_notification_email', 10, 3 );

function hpl_user_notification_email( $email_data, $user, $blogname ) {
    //$user = new WP_User($user_id);

    $user_login = stripslashes($user->display_name);
    $user_email = stripslashes($user->user_email);

    $message  = __('Здравствуйте,') . sprintf(__(' %s'), $user_login) . "\r\n\r\n";
    $message .= sprintf(__("Приветствуем вас в клубе %s! Теперь вы можете войти, используя эти данные:"), get_option('blogname')) . "\r\n\r\n";
    $message .=  "https://tvelium.ru/#auth". "\r\n"; // wp_login_url()
    $message .= sprintf(__('Логин: %s'), $user_email) . "\r\n\r\n";
    //$message .= sprintf(__('Пароль: %s'), $plaintext_pass) . "rnrn";
    $message .= sprintf(__('Если у вас возникли какие-то проблемы с регистрацией или входом, свяжитесь с администратором - %s.'), get_option('admin_email')) . "\r\n\r\n";
    $message .= __('Удачи!');

    $email_data['subject'] = 'Регистрация на сайте  ' . wp_specialchars_decode( $blogname );
    $email_data['message'] = $message/* . $email_data['message']*/;

    return $email_data;
}

/* добавление поля в профиле*/
add_action( 'show_user_profile', 'add_extra_profile_links' );
add_action( 'edit_user_profile', 'add_extra_profile_links' );
 
function add_extra_profile_links( $user )
{
?>
<h3>Дополнительные данные пользователя</h3>
 
<table class="form-table">
    <tr>
        <th><label for="refcode_prof">Реферальный код</label></th>
        <td><input type="text" name="refcode_prof" value="<?php echo esc_attr(get_the_author_meta( 'refcode_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="refuser_prof">Реферал</label></th>
        <td><input type="text" name="refuser_prof" value="<?php echo esc_attr(get_the_author_meta( 'refuser_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="phone_prof">Телефон</label></th>
        <td><input type="text" name="phone_prof" value="<?php echo esc_attr(get_the_author_meta( 'phone_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="surname_prof">Отчество</label></th>
        <td><input type="text" name="surname_prof" value="<?php echo esc_attr(get_the_author_meta( 'surname_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>

    <tr>
        <th><label for="title_prof">Профессия для резюме</label></th>
        <td><input type="text" name="title_prof" value="<?php echo esc_attr(get_the_author_meta( 'title_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="city_prof">Населенный пункт</label></th>
        <td><input type="text" name="city_prof" value="<?php echo esc_attr(get_the_author_meta( 'city_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="bird_prof">Дата рождения</label></th>
        <td><input type="text" name="bird_prof" value="<?php echo esc_attr(get_the_author_meta( 'bird_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="education_prof">Образование</label></th>
        <td><input type="text" name="education_prof" value="<?php echo esc_attr(get_the_author_meta( 'education_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="skills_prof">Навыки</label></th>
        <td><input type="text" name="skills_prof" value="<?php echo esc_attr(get_the_author_meta( 'skills_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="languages_prof">Иностранные языки</label></th>
        <td><input type="text" name="languages_prof" value="<?php echo esc_attr(get_the_author_meta( 'languages_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="additional_prof">Дополнительная информация</label></th>
        <td><input type="text" name="additional_prof" value="<?php echo esc_attr(get_the_author_meta( 'additional_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
    <tr>
        <th><label for="experience_prof">Опыт (строки разделены символом | , дата от описания разделены точкой с запятой)</label></th>
        <td><input type="text" name="experience_prof" value="<?php echo esc_attr(get_the_author_meta( 'experience_prof', $user->ID )); ?>" class="regular-text" /></td>
    </tr>
</table>
<?php
}


/* Дополнительные поля пользователя */
add_action( 'personal_options_update', 'save_extra_profile_links' );
add_action( 'edit_user_profile_update', 'save_extra_profile_links' );
 
function save_extra_profile_links( $user_id )
{
    update_user_meta( $user_id,'refcode_prof', sanitize_text_field( $_POST['refcode_prof'] ) );
    update_user_meta( $user_id,'refuser_prof', sanitize_text_field( $_POST['refuser_prof'] ) );
    update_user_meta( $user_id,'phone_prof', sanitize_text_field( $_POST['phone_prof'] ) );
    update_user_meta( $user_id,'surname_prof', sanitize_text_field( $_POST['surname_prof'] ) );

    update_user_meta( $user_id,'title_prof', sanitize_text_field( $_POST['title_prof'] ) );
    update_user_meta( $user_id,'city_prof', sanitize_text_field( $_POST['city_prof'] ) );
    update_user_meta( $user_id,'bird_prof', sanitize_text_field( $_POST['bird_prof'] ) );
    update_user_meta( $user_id,'education_prof', sanitize_text_field( $_POST['education_prof'] ) );
    update_user_meta( $user_id,'skills_prof', sanitize_text_field( $_POST['skills_prof'] ) );
    update_user_meta( $user_id,'languages_prof', sanitize_text_field( $_POST['languages_prof'] ) );
    update_user_meta( $user_id,'additional_prof', sanitize_text_field( $_POST['additional_prof'] ) );
    update_user_meta( $user_id,'experience_prof', sanitize_text_field( $_POST['experience_prof'] ) );
}

/* Взнос депозита (Основной в файле page-success) */
add_action( 'admin_post_add-deposit', 'add_deposit');
add_action( 'admin_post_nopriv_add-deposit', 'add_deposit');

function add_deposit() {
    
    //wp_vardump($_POST);
    //exit;
    global $wpdb;
    $user = get_user_by( 'ID', $_POST['user_id'] ); //
    if ( !$user )
        wp_die( "Нет такого пользователя!..." );
    
    $user_tarif = $_POST['user_tarif'];

    if ( $user_tarif == 'min' ) {
        $payment_summ = DEPOSIT_MONTH;
        $dp_date_next = date('Y-m-d H:i:s', strtotime('+1 month'));
    } else {
        $payment_summ = $_POST['user_summ']; // Вся сумма, оплатить в течение 3-х месяцев
        $dp_date_next = date('Y-m-d H:i:s', strtotime('+3 month'));
    }

    $query = "SELECT * FROM tv_deposit WHERE dp_user_id = $user->ID";
    $result_db = $wpdb->get_results( $query );

    //wp_vardump($result_db[0]->dp_date_next);
    exit;
    if ( $user_tarif == 'min' ) { // Тариф min
        // Пока так, но сумма платежа и дата платеж вносятся после подтверждения банком
        if ($result_db[0]->dp_summ == 0) { // Первый платеж
            $date_out_t = date('Y-m-d H:i:s', strtotime('+5 year'));
            $dp_date_out = DateTime::createFromFormat('Y-m-d H:i:s', $date_out_t);
            $end_date_full = $dp_date_out->diff( new DateTime() )->format('%a');
            
            $results = $wpdb->update( 
                'tv_deposit', 
                [
                    'dp_active'    => 1,
                    'dp_tarif'     => $user_tarif,
                    'dp_summ'      => $payment_summ,
                    'dp_date_add'  => date('Y-m-d H:i:s'),
                    'dp_date_next' => $dp_date_next,
                    'dp_add'       => $result_db[0]->dp_add + $payment_summ,
                    'dp_remain'    => $result_db[0]->dp_remain - $payment_summ,
                    'dp_date_out'  => $date_out_t,
                ],
                [ 'dp_user_id' => $user->ID ]
            );
        } else { // Следующий платеж
            $dp_date_out = DateTime::createFromFormat('Y-m-d H:i:s', $result_db[0]->dp_date_out);
            $end_date_full = $dp_date_out->diff( new DateTime() )->format('%a');
            
            $results = $wpdb->update( 
                'tv_deposit', 
                [      
                    'dp_summ'           => $payment_summ,
                    'dp_date_add'       => date('Y-m-d H:i:s'),
                    'dp_date_next'      => $dp_date_next,
                    'dp_add'            => $result_db[0]->dp_add + $payment_summ,
                    'dp_remain'         => $result_db[0]->dp_remain - $payment_summ,
                    'dp_date_full_out'  => $end_date_full,
                ],
                [ 'dp_user_id' => $user->ID ]
            );
        }
    } else { // Тариф max
        //wp_vardump($payment_summ);exit;
        $results = $wpdb->update( 
            'tv_deposit', 
            [      
                'dp_active'         => 1,
                'dp_tarif'          => $user_tarif,
                'dp_summ'           => $payment_summ,
                'dp_date_add'       => date('Y-m-d H:i:s'),
                'dp_date_next'      => NULL,
                'dp_add'            => $result_db[0]->dp_add + $payment_summ,
                'dp_remain'         => $result_db[0]->dp_remain - $payment_summ,
                'dp_date_full_out'  => NULL,
            ],
            [ 'dp_user_id' => $user->ID ]
        );
    }
    

    if ( $results === 'false' ) {
        wp_die( 'Что то не так!' );
        wp_die( $results );
    }
    echo "<script>document.location.href='/purse';</script>";
}

/* Запрос на вывод */
add_action( 'admin_post_add-withdraw', 'add_withdraw');

function add_withdraw() {
    global $wpdb;
    
    $user = get_user_by( 'ID', $_POST['user-id'] ); //
    if ( !$user )
        wp_die( "Нет такого пользователя!..." );
    
    $query = "SELECT * FROM tv_deposit WHERE dp_user_id = $user->ID AND dp_active = 1";
    $deposit = $wpdb->get_results( $query );

    if ($_POST['enquiry-summ'] != $deposit[0]->dp_add) 
    {
        $dp_add = $deposit[0]->dp_add;
    } 
    else 
    {
        $dp_add = trim($_POST['enquiry-summ']);
    }
    
    $results = $wpdb->insert( 
        'tv_withdraw', 
        [      
            'user_id'         => $user->ID,
            'requisite'       => $_POST['requisite'],
            'enquiry_summ'    => $dp_add,
            'enquiry_date'    => date('Y-m-d H:i:s'),
            'enquiry_status'  => 0,
        ]
    );

    if ( $results === 'false' ) {
        wp_die( 'Что то не так!' );
        wp_die( $results );
    }
    echo "<script>document.location.href='/kabinet';</script>";
}

/* Подтверждение вывода */
add_action( 'admin_post_out-withdraw', 'out_withdraw');

function out_withdraw() {
    global $wpdb;
    //wp_vardump($_POST);exit;

    $user = get_user_by( 'ID', $_POST['user-id'] ); //
    if ( !$user )
       wp_die( "Нет такого пользователя!..." );
    
    $results = $wpdb->update( 
        'tv_withdraw', 
        [      
            'date_out'        => date('Y-m-d H:i:s'),
            'enquiry_status'  => $_POST['withdraw-status'],
        ],
        [ 'ID' => $_POST['withdraw-id'] ]
    );

    if ( $results === 'false' ) {
        wp_die( 'Что то не так!' );
        wp_die( $results );
    } else {
        if ($_POST['withdraw-status'] == 2) {
            $results = $wpdb->update( 
                'tv_deposit', 
                [
                    'dp_active'         => 0,
                    'dp_add'            => 0,
                    'dp_out'            => $_POST['withdraw-summ'],
                    'dp_date_full_out'  => 0,
                    'dp_remain'         => 0,
                    'dp_date_next'      => NULL,
                    'dp_date_out'       => date('Y-m-d H:i:s'),
                ],
                [ 'dp_user_id' => $_POST['user-id'] ]
            );
        }
    }
    
    echo "<script>document.location.href='/withdraw';</script>";
    //wp_vardump($user);
}

/* Добавить копирайтера */
add_action( 'admin_post_add-copyriter', 'add_copyriter');

function add_copyriter() {
    $userdata = [
        'user_login' => $_POST['user-login'],
        'user_email' => $_POST['user-email'],
        'user_pass'  => $_POST['user-pass'],

        'first_name' => $_POST['username'],
        'last_name'  => $_POST['lastname'],
        'role'       => 'author',
    ];

    $new_user_id = wp_insert_user( $userdata );

    if( ! is_wp_error( $new_user_id ) ){
        update_user_meta( $new_user_id,'surname_prof', sanitize_text_field( $_POST['surname'] ) );
        update_user_meta( $new_user_id,'show_admin_bar_front', 'false' );

        //header( 'Location: /addcopyriter' );
        echo "<script>document.location.href='/addcopyriter';</script>";
    }
    else {
        wp_die( $new_user_id->get_error_message() );
    }
}

/* Редактирование резюме пользователя */
add_action( 'admin_post_edit-resume-entry', 'edit_resume');

function edit_resume() {
    
    if ( !empty( $_POST['post-id'] ) ) {
        $post_link = $_POST['post-link'];

        $userdata = [
            'ID'         => $_POST['post-id'],
            'user_email' => $_POST['user_email'],
            'first_name' => $_POST['first_name'],
            'last_name'  => $_POST['last_name'],
        ];
        //wp_vardump( $_POST );
        //exit;
        $user_id = wp_update_user( $userdata );
        
        if ( is_wp_error( $user_id ) ) {
            wp_die( "Ошибка обновления." );
        }
        else {
            update_user_meta( $user_id,'phone_prof', sanitize_text_field( $_POST['phone_prof'] ) );
            update_user_meta( $user_id,'surname_prof', sanitize_text_field( $_POST['surname_prof'] ) );
            update_user_meta( $user_id,'title_prof', sanitize_text_field( $_POST['title_prof'] ) );
            update_user_meta( $user_id,'city_prof', sanitize_text_field( $_POST['city_prof'] ) );
            update_user_meta( $user_id,'bird_prof', sanitize_text_field( $_POST['bird_prof'] ) );

            $education_prof = "";
            if ( isset($_POST['education_prof']) ) {
                foreach ( $_POST['education_prof'] as $key => $item) {
                    if ( !empty($item) ) {
                        if ( $education_prof == "" ) {
                            $education_prof .= sanitize_text_field( $item );
                        } else {
                            $education_prof .= ";" . sanitize_text_field( $item );
                        }
                    }
                }
                update_user_meta( $user_id,'education_prof', $education_prof );
            }
            
            $skills_prof = "";
            if ( isset($_POST['skills_prof']) ) {
                foreach ( $_POST['skills_prof'] as $key => $item) {
                    if ( !empty($item) ) {
                        if ( $skills_prof == "" ) {
                            $skills_prof .= sanitize_text_field( $item );
                        } else {
                            $skills_prof .= ";" . sanitize_text_field( $item );
                        }
                    }
                }
                update_user_meta( $user_id,'skills_prof', $skills_prof );
            }
            

            $languages_prof = "";
            if ( isset($_POST['languages_prof']) ) {
                foreach ( $_POST['languages_prof'] as $key => $item) {
                    if ( !empty($item) ) {
                        if ( $languages_prof == "" ) {
                            $languages_prof .= sanitize_text_field( $item );
                        } else {
                            $languages_prof .= ";" . sanitize_text_field( $item );
                        }
                    }
                }
                update_user_meta( $user_id,'languages_prof', $languages_prof );
            }
            
            
            $additional_prof = "";
            if ( isset($_POST['additional_prof']) ) {
                foreach ( $_POST['additional_prof'] as $key => $item) {
                    if ( !empty($item) ) {
                        if ( $additional_prof == "" ) {
                            $additional_prof .= sanitize_text_field( $item );
                        } else {
                            $additional_prof .= ";" . sanitize_text_field( $item );
                        }
                    }
                }
                update_user_meta( $user_id,'additional_prof', $additional_prof );
            }
            

            $experience_prof = "";
            if ( isset($_POST['experience_prof_0']) ) {
                foreach ( $_POST['experience_prof_0'] as $key => $item) {
                    if ( !empty($item) ) {
                        if ( $experience_prof == "" ) {
                            $experience_prof .= sanitize_text_field( $_POST['experience_prof_0'][$key] );
                            $experience_prof .= "|" . sanitize_text_field( $_POST['experience_prof_1'][$key] );
                        } else {
                            $experience_prof .= ";" . sanitize_text_field( $_POST['experience_prof_0'][$key] );
                            $experience_prof .= "|" . sanitize_text_field( $_POST['experience_prof_1'][$key] );
                        }
                    }
                }
                update_user_meta( $user_id,'experience_prof', $experience_prof );
            }
            
        }
        //echo "<script>document.location.href='" . $post_link . "';</script>";
        header( 'Location: ' . $post_link );
    }    
}

/* редактор */
function true_double_editor() {
	global $post;
	echo '<h2>Описание</h2>'; 
	wp_editor( get_post_meta($post->ID, '_true_editor_data', true), 'trueeditor' );
}
 
add_action( 'edit_form_advanced', 'true_double_editor' );
add_action( 'edit_page_form', 'true_double_editor' );
 
function true_save_double_editor($post_id) {
    if (isset($_POST['trueeditor'])) {
        update_post_meta($post_id, '_true_editor_data', $_POST['trueeditor']);
    }
}
 
add_action('save_post', 'true_save_double_editor');

/* Пользовательская запись (добавление, обновление) */
add_action( 'admin_post_add-custom-entry', 'add_custom_entry');

function add_custom_entry() {
    $user = wp_get_current_user();
    //wp_vardump( $_POST );exit;
    //wp_vardump( $user ); 
    $post_data = array(
        'post_title'    => $_POST['true_title'],
        'post_content'  => $_POST['true_content'],
        'post_status'   => 'publish', // pending
        'post_type'     => $_POST['post-type'], // array( $_POST['post-type'] )
    );

    $edit_id = $_POST['post-id'];
    // $page_link = $_POST['_wp_http_referer'];
    $page_link = $_POST['page-link'];

    if ( $edit_id == '' ) {
        $post_data['post_author'] = $user->ID;
    } else {
        $post_data['ID'] = $edit_id;
        $the_post = get_post( $edit_id );
        $post_data['post_author'] = $the_post->post_author;
    }
    //wp_vardump( $post_data );exit;
    $post_id = wp_insert_post( wp_slash($post_data) );

    if( ! is_wp_error( $post_id ) ){
        $my_post['ID'] = $post_id;
        $my_post['post_status'] = 'publish'; // 
        wp_update_post( $my_post );

        if ( ! function_exists( 'wp_handle_upload' ) )
		require_once( ABSPATH . 'wp-admin/includes/file.php' );

        $file = & $_FILES['my_file_upload'];

        $overrides = [ 'test_form' => false ];

        $movefile = wp_handle_upload( $file, $overrides );

        if ( $movefile && empty($movefile['error']) ) {
            //echo "Файл был успешно загружен.\n";
            //print_r( $movefile );
        } else {
            //echo "Возможны атаки при загрузке файла!\n";
        }

        if ( 
            isset( $_POST['my_image_upload_nonce'], $post_id )
            && wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
            && current_user_can( 'edit_post', $post_id )
        ) {
            $attachment_id = media_handle_upload( 'my_image_upload', $post_id );
            if ( is_wp_error( $attachment_id ) ) {
                //wp_die( "Ошибка загрузки медиафайла." );
            } else {
                set_post_thumbnail( $post_id, $attachment_id );
            }
        }

        echo "<script>document.location.href='" . $page_link . "';</script>";
        //header( 'Location: ' . $page_link );
    }
    else {
        wp_die( $post_id->get_error_message() );
    }
}

/* Пользовательская запись (удаление) */
add_action( 'admin_post_del-custom-entry', 'del_custom_entry');

function del_custom_entry() {
    $page_link = $_POST['page-link'];

    wp_delete_post( $_POST['post-id'] );

    echo "<script>document.location.href='" . $page_link . "';</script>";
}

/* Добавление вакансии */
register_post_meta( 'vacancy', 'vacancy_project', array() );

add_action( 'admin_post_add-vacancy-entry', 'add_vacancy_entry');

function add_vacancy_entry() {
    $user = wp_get_current_user();
    //wp_vardump( $_POST );
    //wp_vardump( $user ); exit;
    $post_data = array(
        'post_title'    => $_POST['true_title'],
        'post_content'  => $_POST['true_content'],
        'post_status'   => 'publish', // pending
        'post_type'     => $_POST['post-type'], // array( $_POST['post-type'] )
    );

    $edit_id = $_POST['post-id'];
    $page_link = $_POST['_wp_http_referer'];

    if ( $edit_id == '' ) {
        $post_data['post_author'] = $user->ID;
    } else {
        $post_data['ID'] = $edit_id;
        $the_post = get_post( $edit_id );
        $post_data['post_author'] = $the_post->post_author;
    }
    //  wp_vardump( $post_data );exit;
    $post_id = wp_insert_post( wp_slash($post_data) );

    if( ! is_wp_error( $post_id ) ){
        update_post_meta( $post_id,'vacancy_project', sanitize_text_field( $_POST['project-select'] ) );

        echo "<script>document.location.href='" . $page_link . "';</script>";
    }
    else {
        wp_die( $post_id->get_error_message() );
    }
}

/* Запрос-Ответ техподдержки */
add_action( 'admin_post_add-support-entry', 'add_support_entry');

function add_support_entry() {
    $user = wp_get_current_user();
    //wp_vardump( $_POST );
    //wp_vardump( $user ); exit;
    $post_data = array(
        'post_title'    => $_POST['help_title'],
        'post_content'  => $_POST['help_text'],
        'post_status'   => 'publish', 
        'post_type'     => $_POST['post-type'], 
    );

    $edit_id = $_POST['post-id'];
    $page_link = '/support';

    if ( $edit_id == '' ) {
        $post_data['post_author'] = $user->ID;
        //wp_vardump( $post_data );
        //wp_vardump( $user );exit;
        $post_id = wp_insert_post( wp_slash($post_data) );
    } else {
        $post_data['ID'] = $edit_id;
        $the_post = get_post( $edit_id );
        $post_data['post_author'] = $the_post->post_author;
        $help_user = get_user_by( 'ID', $the_post->post_author );

        $post_id = wp_update_post( wp_slash($post_data) );
    }
    //wp_vardump( $help_user->user_email );exit;

    if( ! is_wp_error( $post_id ) ){
        update_post_meta( $post_id,'help_status', sanitize_text_field( $_POST['help_status'] ) );
        update_post_meta( $post_id,'help_answer', sanitize_text_field( $_POST['help_answer'] ) );

        // Запрос в техподдержку
        if ( $_POST['help_status'] == 'new' ) {
            $to = 'alex-lkt@mail.ru'; // $user->user_email
            $email = 'alex-lkt@mail.ru';
            $subject = 'Запрос в Техподдержку';
            $message = "Тема запроса: " . $_POST['help_title'] . "\r\n"
                        . "Вопрос: " . $_POST['help_text'];
            
            $sent_message = wp_mail( $to, $subject, $message, "Content-type:text/plain; charset = utf-8\r\nFrom:".$email );
        }
        // Ответ админа
        if ( $_POST['help_status'] == 'executed' ) {
            $to = $help_user->user_email; // $user->user_email
            $email = 'alex-lkt@mail.ru';
            $subject = 'Ответ от Техподдержки';
            $message = "Тема запроса: " . $_POST['help_title'] . "\r\n"
                        . "Вопрос: " . $_POST['help_text'] . "\r\n"
                        . "Ответ: " . $_POST['help_answer'];
            
            $sent_message = wp_mail( $to, $subject, $message, "Content-type:text/plain; charset = utf-8\r\nFrom:".$email );
        }

        if ( $sent_message ) {
            echo 'Всё ок! ' . $help_user->user_email;
        } else {
            echo 'Что-то пошло не так!';
        }

        echo "<script>document.location.href='" . $page_link . "';</script>";
    }
    else {
        wp_die( $post_id->get_error_message() );
    }
}

/* Подключение скриптов для оплаты */
add_action( 'wp_enqueue_scripts', 'true_pay_scripts' );
 
function true_pay_scripts() {
 	wp_enqueue_script( 
		'true_loadmore', 
		get_stylesheet_directory_uri() . '/js/pay.js', 
		array( 'jquery' ),
		time() // не кэшируем файл, убираем эту строчку после завершение разработки
	);
 
	wp_enqueue_script( 'true_pay' );
}

/* оплата платежной системой */
add_action( 'wp_ajax_pay', 'true_pay' );
 
function true_pay() {

}

/* Пагинация: ленивая загрузка записей */
add_action( 'wp_ajax_loadmore', 'true_loadmore' );
add_action( 'wp_ajax_nopriv_loadmore', 'true_loadmore' );
 
function true_loadmore() {
 
	$paged = ! empty( $_POST[ 'paged' ] ) ? $_POST[ 'paged' ] : 1;
	$paged++;
    $max_pages = ! empty( $_POST[ 'maxPages' ] ) ? $_POST[ 'maxPages' ] : 1;
    $post_type = ! empty( $_POST[ 'postType' ] ) ? $_POST[ 'postType' ] : 'news';
    
	if ( $post_type != 'project' ) {
        $args = array(
            'posts_per_page' => 4,
            'paged'          => $paged,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'author'         => $current_user->ID,
            'post_type'      => $post_type,
            'post_status'    => 'publish, pending',
            'suppress_filters' => true, 
            'prev_next'      => false,
        );
    
        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            ob_start();
            while ( $query->have_posts() ) {
                $query->the_post();
                
                get_template_part( 'include/content-' . $post_type . '-item', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
            }
            wp_reset_postdata();

            $posts = ob_get_contents();
            ob_get_clean();

            ob_start();
            echo paginate_links( [
                'base'    => user_trailingslashit( wp_normalize_path( get_permalink() .'/%#%/' ) ),
                'current' => $paged,
                'total'   => $max_pages,
                'end_size' => 1,
                'prev_next' => false,
            ] );

            $pagination = ob_get_contents();
            ob_get_clean();

            echo json_encode( array(
                'posts' => $posts,
                'pagination' => $pagination,
            ) );
        };

    } elseif ( $post_type == 'project' ) {
        $number = 4;
        //$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $offset = ($paged - 1) * $number;
        $users_s = get_users( array('role' => 'subscriber' ) );  
        $total_users = count($users_s);
        
        $users_subscriber = get_users( array(
            'role'   => 'subscriber',
            'offset' => $offset, // 
            'number' => $number,
        ) );
        
        ob_start();
        $total_pages = round($total_users / $number) + 1;
        //wp_vardump( count($users_subscriber) );
        foreach( $users_subscriber as $i => $user ) {
            //get_template_part( 'include/content-' . $post_type . '-item', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
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
                <!-- <div class="news-item__footer">
                    <div class="news-item__date"><?php echo the_time('j F Y'); ?></div>
                </div> -->
                <!-- <div class="profile-box__btn-box">
                    <a href="/editresume?r=<?php echo $user->ID ?>" class="profile-box__edit">Редактировать</a>
                </div> -->
            </div>

            <?php
        }
        $posts = ob_get_contents();
        ob_get_clean();

        ob_start();
        echo paginate_links( [
            'base'    => user_trailingslashit( wp_normalize_path( get_permalink() .'/%#%/' ) ),
            'current' => $paged,
            'total'   => $max_pages,
            'end_size' => 1,
            'prev_next' => false,
        ] );

        $pagination = ob_get_contents();
        ob_get_clean();

        echo json_encode( array(
            'posts' => $posts,
            'pagination' => $pagination,
        ) );

    }

    //wp_vardump($_POST);exit;
	die;
}

/* Пагинация: стандартная загрузка записей */
add_action( 'wp_ajax_loadPagination', 'true_loadPagination' );
add_action( 'wp_ajax_nopriv_loadPagination', 'true_loadPagination' );
 
function true_loadPagination() {
 
	$paged = ! empty( $_POST[ 'pagedP' ] ) ? $_POST[ 'pagedP' ] : 1;
    $max_pages = ! empty( $_POST[ 'maxPages' ] ) ? $_POST[ 'maxPages' ] : 1;
    $post_type = $_POST[ 'postType' ];
    $post_author = $_POST[ 'author' ];
    
	$args = array(
        'posts_per_page' => 4,
        'paged'          => $paged, // 
        'orderby'        => 'date',
        'order'          => 'DESC',
        'author'         => $post_author,
        'post_type'      => $post_type,
        'post_status'    => 'publish, pending',
        'suppress_filters' => true, 
    );
 
	$query = new WP_Query( $args );
    //wp_vardump($args);
    //wp_vardump($query);
                
    if ( $query->have_posts() ) {
        ob_start();
        while ( $query->have_posts() ) {
            $query->the_post();
 
		    get_template_part( 'include/content-news-item', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
        }
        wp_reset_postdata(); 
        $posts = ob_get_contents();
        ob_get_clean();

        ob_start();
        $paginate_arr = kama_paginate_links_data( [
            'url_base'    => '#',
            'current' => $paged, 
            'total'   => $max_pages,
        ] );
        
        foreach ( $paginate_arr as $link ) {
            if ( $link->is_current ):
                echo "<span class='content-pagination_link active'>" . $link->page_num . "</span>";
            else:
                echo "<a href='" . $link->url . "' class='content-pagination_link' data-max-pages='" . $max_pages . "' data-paged='" . $link->page_num . "' data-post-type='news' data-post-author='" . $post_author . "' >" . $link->page_num . "</a>";
            endif;
        }

        //echo "test-test";
        
        $pagination = ob_get_contents();
        ob_get_clean();
        //wp_vardump($pagination);exit;
        echo json_encode( array(
            'posts' => $posts,
            'pagination' => $pagination,
        ) );
    };
 
	die;
}

/* Сброс пароля */
add_shortcode( 'custom_passreset', 'render_pass_reset_form' ); // шорткод [custom_passreset]
 
function render_pass_reset_form() {
 
 	// если пользователь авторизован, просто выводим сообщение и выходим из функции
	if ( is_user_logged_in() ) {
		return sprintf( "Вы уже авторизованы на сайте. <a href='%s'>Выйти</a>.", wp_logout_url() );
	}
 
	$return = ''; // переменная, в которую всё будем записывать
 
	// обработка ошибок, если вам нужны такие же стили уведомлений, как в видео, CSS-код прикладываю чуть ниже
	if ( isset( $_REQUEST['errno'] ) ) {
		$errors = explode( ',', $_REQUEST['errno'] );
 
		foreach ( $errors as $error ) {
			switch ( $error ) {
				case 'empty_username':
					$return .= '<p class="errno">Вы не забыли указать свой email?</p>';
                    $_SESSION['pass_error'] = 'Вы не забыли указать свой email?';
					break;
				case 'password_reset_empty':
					$return .= '<p class="errno">Укажите пароль!</p>';
                    $_SESSION['pass_error'] = 'Укажите пароль!';
					break;
				case 'password_reset_mismatch':
					$return .= '<p class="errno">Пароли не совпадают!</p>';
					break;
				case 'invalid_email':
				case 'invalidcombo':
					$return .= '<p class="errno">На сайте не найдено пользователя с указанным email.</p>';
                     $_SESSION['pass_error'] = 'На сайте не найдено пользователя с указанным email';
					break;
			}
		}
	}
 
	// тем, кто пришёл сюда по ссылке из email, показываем форму установки нового пароля
	if ( isset( $_REQUEST['login'] ) && isset( $_REQUEST['key'] ) ) {
 
		$return .= '<div class="new-pass__container">
            <h3>Укажите новый пароль</h3>
			<form name="resetpassform" id="resetpassform" action="' . site_url( 'wp-login.php?action=resetpass' ) . '" method="post" autocomplete="off">
				<input type="hidden" id="user_login" name="login" value="' . esc_attr( $_REQUEST['login'] ) . '" autocomplete="off" />
				<input type="hidden" name="key" value="' . esc_attr( $_REQUEST['key'] ) . '" />
                <p class="new-pass__pass-inner">
					<label for="pass1">Новый пароль</label>
					<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" />
				</p>
				<p class="new-pass__pass-inner">
					<label for="pass2">Повторите пароль</label>
					<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" />
				</p>
 
				<p class="description" style="margin-top:25px;">' . wp_get_password_hint() . '</p>
 
				<div class="homepage-form__btn">
                    <input type="submit" name="submit" id="resetpass-button" class="btn homepage-form__btn-btn" value="Сбросить" />
                </div>
			</form>
            </div>';
 
		// возвращаем форму и выходим из функции
		return $return;
	}
 
	// всем остальным - обычная форма сброса пароля (1-й шаг, где указываем email)
	$return .= '
		<h3>Забыли пароль?</h3>
		<p class="new-pass__text">Укажите свой email, под которым вы зарегистрированы на сайте и на него будет отправлена информация о восстановлении пароля.</p>
		<form id="lostpasswordform" action="' . wp_lostpassword_url() . '" method="post">
			<div class="new-pass__form-row">
				<label for="user_login">Email</label>
				<input type="text" name="user_login" id="user_login">
			</div>
 			<div class="homepage-form__btn">
				<input type="submit" name="submit" class="btn homepage-form__btn-btn" value="Отправить" />
			</div>
		</form>';
 
	// возвращаем форму и выходим из функции
	return $return;
}

/*
 * перенаправляем стандартную форму
 */
add_action( 'login_form_lostpassword', 'pass_reset_redir' );
 
function pass_reset_redir() {
	// если используете другой ярлык страницы сброса пароля, укажите здесь
	$forgot_pass_page_slug = '/#auth';
	// если используете другой ярлык страницы входа, укажите здесь
	$login_page_slug = '/#auth';
	// если кто-то перешел на страницу сброса пароля
	// (!) именно перешел, а не отправил формой,
	// тогда перенаправляем на нашу кастомную страницу сброса пароля
	if ( 'GET' == $_SERVER['REQUEST_METHOD'] && !is_user_logged_in() ) {
		wp_redirect( site_url( $forgot_pass_page_slug ) );
		exit;
	} else if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
    		// если же напротив, была отправлена форма
    		// юзаем retrieve_password()
    		// которая отправляет на почту ссылку сброса пароля
    		// пользователю, который указан в $_POST['user_login']
		$errors = retrieve_password();
		if ( is_wp_error( $errors ) ) {
            		// если возникли ошибки, возвращаем пользователя назад на форму
            		$to = site_url( $forgot_pass_page_slug );
            		$to = add_query_arg( 'errno', join( ',', $errors->get_error_codes() ), $to );
        	} else {
            		// если ошибок не было, перенаправляем на логин с сообщением об успехе
                    $_SESSION['new_pass_ok'] = "На указанный адрес отправлено письмо <br>для восстановения пароля!";
            		$to = site_url( $login_page_slug );
            		$to = add_query_arg( 'errno', 'confirm', $to );
        	}
 
		// собственно сам редирект
        	wp_redirect( $to );
        	exit;
	}
}
 
/*
 * Манипуляции уже после перехода по ссылке из письма
 */
add_action( 'login_form_rp', 'misha_to_custom_password_reset' );
add_action( 'login_form_resetpass', 'misha_to_custom_password_reset' );
 
function misha_to_custom_password_reset(){
 
	$key = $_REQUEST['key'];
	$login = $_REQUEST['login'];
	
	$forgot_pass_page_slug = '/new-pass';
	
	$login_page_slug = '/#auth';
 
	// проверку соответствия ключа и логина проводим в обоих случаях
	if ( ( 'GET' == $_SERVER['REQUEST_METHOD'] || 'POST' == $_SERVER['REQUEST_METHOD'] )
		&& isset( $key ) && isset( $login ) ) {
 
		$user = check_password_reset_key( $key, $login );
 
		if ( ! $user || is_wp_error( $user ) ) {
			if ( $user && $user->get_error_code() === 'expired_key' ) {
				wp_redirect( site_url( $login_page_slug . '?errno=expiredkey' ) );
			} else {
				wp_redirect( site_url( $login_page_slug . '?errno=invalidkey' ) );
			}
			exit;
		}
 
	}
 
	if ( 'GET' == $_SERVER['REQUEST_METHOD'] ) {
 
		$to = site_url( $forgot_pass_page_slug );
		$to = add_query_arg( 'login', esc_attr( $login ), $to );
		$to = add_query_arg( 'key', esc_attr( $key ), $to );
 
		wp_redirect( $to );
		exit;
 
	} elseif ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
 
		if ( isset( $_POST['pass1'] ) ) {
 
 			if ( $_POST['pass1'] != $_POST['pass2'] ) {
				// если пароли не совпадают
				$to = site_url( $forgot_pass_page_slug );
 
				$to = add_query_arg( 'key', esc_attr( $key ), $to );
				$to = add_query_arg( 'login', esc_attr( $login ), $to );
				$to = add_query_arg( 'errno', 'password_reset_mismatch', $to );
 
				wp_redirect( $to );
				exit;
			}
 
			if ( empty( $_POST['pass1'] ) ) {
				// если поле с паролем пустое
 				$to = site_url( $forgot_pass_page_slug );
 
				$to = add_query_arg( 'key', esc_attr( $key ), $to );
				$to = add_query_arg( 'login', esc_attr( $login ), $to );
				$to = add_query_arg( 'errno', 'password_reset_empty', $to );
 
				wp_redirect( $to );
				exit;
			}
 
			// тут кстати вы можете задать и свои проверки, например, чтобы длина пароля была 8 символов
			// с паролями всё окей, можно сбрасывать
			reset_password( $user, $_POST['pass1'] );
			wp_redirect( site_url( $login_page_slug . '?errno=changed' ) );
 
		} else {
			// если что-то пошло не так
			echo "Что-то пошло не так.";
		}
 
		exit;
 
	}
}

/* Данные в письмах-уведомлениях */
add_filter('wp_mail_from', 'custom_mail');
add_filter('wp_mail_from_name', 'custom_name');

function custom_mail($email) { return 'no-reply@tvelium.ru'; }
function custom_name($email){ return 'Tvelium'; }

/**
 * Настройка SMTP
 *
 * @param PHPMailer $phpmailer объект
 */
function tvlm_send_smtp_email( PHPMailer $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = SMTP_HOST;
    $phpmailer->SMTPAuth   = SMTP_AUTH;
    $phpmailer->Port       = SMTP_PORT;
    $phpmailer->Username   = SMTP_USER;
    $phpmailer->Password   = SMTP_PASS;
    $phpmailer->SMTPSecure = SMTP_SECURE;
    $phpmailer->From       = SMTP_FROM;
    $phpmailer->FromName   = SMTP_NAME;
}

//add_action( 'phpmailer_init', 'tvlm_send_smtp_email' );

/* PHPmailer filter From */
// add_filter( 'wp_mail_from_name', function($from_name){
// 	return 'Tvelium.ru'; 
// } );

// Filters

// Functions
/**
 * @param array $args {
 *     @type int    $total    Max paginate page.
 *     @type int    $current  Current page.
 *     @type string $url_base URL pattern. Use {page_num} placeholder.
 * }
 *
 * @return array
 */
function kama_paginate_links_data( $args ){
	global $wp_query;

	$args = wp_parse_args( $args, [
		'total' => $wp_query->max_num_pages ?? 1,
		'current' => null,
		'url_base' => '', //
	] );

	if( null === $args['current'] ){
		$args['current'] = max( 1, get_query_var( 'paged', 1 ) );
	}

	if( ! $args['url_base'] ){
		$args['url_base'] = str_replace( PHP_INT_MAX, '{page_num}', get_pagenum_link( PHP_INT_MAX ) );
	}

	$pages = range( 1, max( 1, (int) $args['total'] ) );

	foreach( $pages as & $page ){
		$page = (object) [
			'is_current' => $page == $args['current'] ,
			'page_num'   => $page,
			'url'        => str_replace( '{page_num}', $page, $args['url_base'] ),
		];
	}
	unset( $page );

	return $pages;
}

/* Генерация случайных символов */
function generate_string($strength = 15) {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $input_length = strlen($permitted_chars);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}


function wp_vardump($var) {
    echo '<pre style="width:100%;">';
    print_r($var);
    echo '</pre>';
}

?>