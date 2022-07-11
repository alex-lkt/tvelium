<?php

add_action( 'wp_enqueue_scripts', 'theme_styles' );
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

add_theme_support( 'post-thumbnails', array('post', 'catalog', 'product') );

function theme_styles() {
    wp_enqueue_style( 'styles', get_stylesheet_uri() );
    wp_enqueue_style( 'default', get_template_directory_uri() . '/assets/css/style.min.css' );
}

function theme_scripts() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//code.jquery.com/jquery-3.6.0.min.js' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'maim', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], null, true );
}

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
		'hierarchical'        => true,
		'supports'            => [ 'title', 'editor', 'custom-fields' ], // 'title', 'thumbnail', 'excerpt', 'comments'
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
    $login = $_POST['userlogin'];
    $password = $_POST['userpass'];
    $res = wp_authenticate($login, $password);

    if( !is_wp_error($res) ) {
        wp_set_auth_cookie( $res->ID );
        wp_die( get_userdata( $res->ID )->user_login, 200 );
    }

    die;
}

add_action( 'wp_ajax_nopriv_truepostreg', 'true_post_reg' );

function true_post_reg() {
    $surname = $_POST['surname'];
    $userphone = $_POST['userphone'];
    $refcode = $_POST['refcode'];

    $user_db = get_users( array(
        'meta_query' => [ [
            'key' => 'refcode_prof',
            'value' => $refcode,
        ] ],
    ) );

    if ( !empty($user_db[0]) ) { // !empty($user_db[0])
        $userdata = [
            'user_login' => $_POST['useremail'],
            'user_email' => $_POST['useremail'],
            'user_pass'  => $_POST['userpassword'],

            'first_name' => $_POST['firstname'],
            'last_name' => $_POST['lastname'],
        ];

        $new_user_id = wp_insert_user( $userdata );

        if( ! is_wp_error( $new_user_id ) ){
            update_user_meta( $new_user_id,'refcode_prof', sanitize_text_field( $_POST['useremail'] . '_ref' . $new_user_id ) );
            update_user_meta( $new_user_id,'phone_prof', sanitize_text_field( $userphone ) );
            update_user_meta( $new_user_id,'surname_prof', sanitize_text_field( $surname ) );
            update_user_meta( $new_user_id,'show_admin_bar_front', 'false' );

            update_user_meta( $user_db[0]->data->ID, 'refuser_prof', $new_user_id );
            update_user_meta( $user_db[0]->data->ID, 'refcode_prof', '' );

            wp_die( $new_user_id, 200 );
        }
        else {
            wp_die( $new_user_id->get_error_message() );
        }
    } else {
        wp_die( 'Такого реферального кода не существует!' );
    }

    
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
</table>
<?php
}

add_action( 'personal_options_update', 'save_extra_profile_links' );
add_action( 'edit_user_profile_update', 'save_extra_profile_links' );
 
function save_extra_profile_links( $user_id )
{
    update_user_meta( $user_id,'refcode_prof', sanitize_text_field( $_POST['refcode_prof'] ) );
    update_user_meta( $user_id,'refuser_prof', sanitize_text_field( $_POST['refuser_prof'] ) );
    update_user_meta( $user_id,'phone_prof', sanitize_text_field( $_POST['phone_prof'] ) );
    update_user_meta( $user_id,'surname_prof', sanitize_text_field( $_POST['surname_prof'] ) );
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

        header( 'Location: /addcopyriter' );
        //wp_die( $new_user_id, 200 );
    }
    else {
        wp_die( $new_user_id->get_error_message() );
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

/* Запись новости */
add_action( 'admin_post_add-news-copyriter', 'add_news_copyriter');

function add_news_copyriter() {
    $user = wp_get_current_user();
    // wp_vardump( $_POST );
    // wp_vardump( $user );
    $post_data = array(
        'post_title'    => $_POST['true_title'],
        'post_content'  => $_POST['true_content'],
        'post_status'   => 'pending',
        //'post_author'   => $user->ID,
        'post_category' => array( $_POST['category-id'] )
    );

    $edit_id = $_POST['post-id'];

    if ( $edit_id == '' ) {
        $post_data['post_author'] = $user->ID;
    } else {
        $post_data['ID'] = $edit_id;
        $the_post = get_post( $edit_id );
        $post_data['post_author'] = $the_post->post_author;
    }
    //wp_vardump( $_POST ); exit;
    $post_id = wp_insert_post( wp_slash($post_data) );

    if( ! is_wp_error( $post_id ) ){
        $my_post['ID'] = $post_id;
        $my_post['post_name'] = $post_id;

        if ( 
            isset( $_POST['my_image_upload_nonce'], $post_id )
            && wp_verify_nonce( $_POST['my_image_upload_nonce'], 'my_image_upload' )
            && current_user_can( 'edit_post', $post_id )
        ) {
            $attachment_id = media_handle_upload( 'my_image_upload', $post_id );
            if ( is_wp_error( $attachment_id ) ) {
                //wp_die( "Ошибка загрузки медиафайла. " . $post_id . ' ' . $_POST['my_image_upload_nonce']  );
                //wp_vardump( $post_id );
                //echo "Ошибка загрузки медиафайла.";
            } else {
                set_post_thumbnail( $post_id, $attachment_id );
            }
        } else {
            //wp_die( "Ошибка на права загрузки." );
        }

        wp_update_post( $my_post );

        header( 'Location: /kabinet' );
    }
    else {
        wp_die( $post_id->get_error_message() );
    }
}

function wp_vardump($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

?>