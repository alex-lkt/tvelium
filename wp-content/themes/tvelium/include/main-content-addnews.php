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

?>

<div class="main-inner">
    <div class="main-inner__content box-noborder">
        <h2 class="main-inner__content--title">Редактор новостей</h2>

        <div class="main-inner__content--wrapper edit-redactor__box">
            <div class="news-edit__redactor">
                <h1 class="news-edit__title">Название новости</h1>
                
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
                        <p>Миниатюра</p>
                        <div class="news-edit__img-img">
                            <?php
                            if( has_post_thumbnail() ) {
                                the_post_thumbnail( 'thumbnail' ); 
                            }
                            ?>
                        </div>
                        <input type="file" name="my_image_upload" class="true-img__input">
                        <?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
                    </div>
                    
                    <input type="hidden" name="post-id" value="<?php echo $post_id ?>">
                    <input type="hidden" name="post-type" value="news">
                    <input type="hidden" name="page-link" value="/kabinet">
                    <input type="hidden" name="action" value="add-custom-entry">
            </div>

            <div class="project-new__btn">
                <div class="project-new__btn-box-top">
                    <!-- <button class="btn-content btn-save">Сохранить</button> -->
                    <input type="submit" class="btn-content btn-save" value="Сохранить">
                    <button class="btn-content btn-moderate">Отправить модератору</button>
                </div>
                </form>

                <div class="project-new__btn-box-bottom">
                    <form action="#" class="news-edit__delete">
                        <div class="news-edit__delete-title">Удалить новость</div>
                        <textarea name="news-edit-del" id="news-edit-del" placeholder="Причина удаления новости"></textarea>
                        <button class="btn-content btn-del">Удалить</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="btn-link__prew-next" style="margin-bottom:50px;">
            <a href="/kabinet" class="link-prew">Вернуться к списку новостей</a>
        </div>
    </div>
</div>
