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
        <h2 class="main-inner__content--title">Редактор проектов</h2>

        <div class="main-inner__content--wrapper edit-redactor__box">
            <div class="news-edit__redactor">
                <h1 class="news-edit__title">Название проекта</h1>
                
                <form action="<?php echo esc_url(admin_url( 'admin-post.php' )) ?>" name="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="true_title" class="news-edit__title-input" value="<?php echo $post_title ?>">

                    <textarea name="true_content" id="news-edit__textarea" cols="30" rows="10"><?php echo $content ?></textarea>

                    <div class="news-edit__img-box">
                        <p>Прикрепить доп. информацию</p><br>
                        <?php
                        $attachments = get_attached_media( '', $post->ID );
                        //wp_vardump($attachments);
                        foreach($attachments as $data_file):
                        ?>  <div class="news-edit__file-box">
                                <a href="<?php echo $data_file->guid ?>" class="news-edit__file"><?php echo $data_file->post_name ?></a>
                            </div>
                        <?php
                        endforeach;
                        ?>
                        <input type="file" name="my_file_upload" class="true-img__input">
                        <?php wp_nonce_field('my_file_upload', 'fileup_nonce'); ?>
                    </div>
                    
                    <input type="hidden" name="post-id" value="<?php echo $post_id ?>">
                    <input type="hidden" name="post-type" value="project">
                    <input type="hidden" name="page-link" value="/project">
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
                    <form action="<?php echo esc_url(admin_url( 'admin-post.php' )) ?>" name="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="post-id" value="<?php echo $post_id ?>">
                        <input type="hidden" name="post-type" value="project">
                        <input type="hidden" name="page-link" value="/project">
                        <input type="hidden" name="action" value="del-custom-entry">
                        <button class="btn-content btn-del">Удалить</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="btn-link__prew-next" style="margin-bottom:50px;">
            <a href="/kabinet" class="link-prew">Вернуться к списку проектов</a>
        </div>
    </div>
</div>
