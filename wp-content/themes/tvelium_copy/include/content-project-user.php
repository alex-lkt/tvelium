<?php
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$post_id = '';
$content = '';
$post_title = '';
if ( isset($_GET['r']) ) {
    $post_id = strip_tags( $_GET['r'] );

    $post = get_post( $post_id, OBJECT, 'edit' );
    $content = $post->post_content;
    $post_title = $post->post_title;
    //wp_vardump( $post );
}
$current_user = wp_get_current_user();
//wp_vardump($_GET);
$status = 'publish';
?>

<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Проекты</h2>
        <div class="main-inner__content--wrapper">
            <div class="project-new__content">
                <div class="news-edit__redactor">
                    <h1 class="news-edit__title">Название проекта</h1>
                    
                    <form action="<?php echo esc_url(admin_url( 'admin-post.php' )) ?>" name="" method="POST" enctype="multipart/form-data">
                        <input type="text" name="true_title" class="news-edit__title-input" value="<?php echo $post_title ?>">
                        <?php
                        $settings = array(
                            'textarea_name'	=>	'true_content',
                            'editor_class'	=>	'my_redactor commons', // несколько классов через пробел
                            'dfw'		=>	true,
                            'quicktags'	=>	false
                        );
                        wp_editor( $content, 'truewpeditor', $settings );
                        ?>
                        <div class="news-edit__img-box">
                            <div class="news-edit__img-img"></div>
                            <input type="file" name="my_image_upload" class="true-img__input">
                            <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
                        </div>
                        
                        <input type="hidden" name="post-id" value="<?php echo $post_id ?>">
                        <input type="hidden" name="category-id" value="5">
                        <input type="hidden" name="action" value="add-news-copyriter">
                </div>
            </div>

            <div class="project-new__btn">
                <div class="project-new__btn-box-top">
                    <button class="btn-content btn-save">Сохранить</button>
                    <button class="btn-content btn-edit">Редактировать</button>
                    <button class="btn-content btn-moderate">Отправить</button>
                </div>
                </form>

                <div class="project-new__btn-box-bottom">
                    <button class="btn-content btn-del">Удалить</button>
                </div>
            </div>
        </div>

        
        <div class="main-inner__content--wrapper box-noborder">
            <h2 class="main-inner__content--title">Мои проекты</h2>
            <div class="content-project__inner">
            <?php
                $my_posts = get_posts( array(
                    'numberposts' => 8,
                    'category'    => 5,
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    'include'     => array(),
                    'exclude'     => array(),
                    'meta_key'    => '',
                    'meta_value'  => '',
                    'post_type'   => 'post',
                    'post_status' => $status,
                    'suppress_filters' => true, 
                ) );


                
                foreach( $my_posts as $post ){
                    setup_postdata( $post );
                    //wp_vardump($post);
                   ?>
                    <div class="content-project__item">
                        <a href="<?php the_permalink(); ?>">
                            <div class="project-item__img-box">
                                <img src="<?php echo get_template_directory_uri() ?>/assets/images/project-img.png" alt="<?php the_title(); ?>">
                            </div>
                            <h3 class="project-item__title"><?php the_title(); ?></h3>
                            <div class="project-item__date"><?php echo the_time('j F Y'); ?></div>
                        </a>
                    </div>
                   <?php
                }
                
                wp_reset_postdata(); 
                ?>
            </div>
            
            <div class="content__pagination">
                <?php 
                
                the_posts_pagination() 
                ?>
                <a href="#" class="content-pagination_link active">1</a>
                <a href="#" class="content-pagination_link">2</a>
                <a href="#" class="content-pagination_link">3</a>
                <span class="content__pagination-points">...</span>
                <a href="#" class="content-pagination_link">7</a>
            </div>
        </div>
    </div>
</div>