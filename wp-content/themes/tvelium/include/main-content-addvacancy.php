<?php 
// require_once ABSPATH . 'wp-admin/includes/image.php';
// require_once ABSPATH . 'wp-admin/includes/file.php';
// require_once ABSPATH . 'wp-admin/includes/media.php';

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
        <h2 class="main-inner__content--title">Редактор вакансий</h2>

        <div class="main-inner__content--wrapper edit-redactor__box">
            <div class="news-edit__redactor">
                <h1 class="news-edit__title">Название вакансии</h1>
                
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
                    
                    <?php wp_referer_field() ?>

                    <?php
                    $my_posts = get_posts( array(
                        'numberposts' => 8,
                        'orderby'     => 'date',
                        'order'       => 'DESC',
                        'include'     => array(),
                        'exclude'     => array(),
                        'post_type'   => 'project',
                        'post_status' => 'publish',
                        'suppress_filters' => true, 
                    ) );
                    ?>

                    <div class="project-new__select">
                        <select name="project-select" id="project-select">
                            <?php 
                            foreach( $my_posts as $post ){
                                setup_postdata( $post );
                                $project_select = get_post_meta( $post_id, 'vacancy_project', true );
                                if ( $project_select == $post->ID ) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }

                            ?>
                                <option value="<?php echo $post->ID; ?>" <?php echo $selected ?>><?php the_title(); ?></option>
                            <?php
                            }
                            wp_reset_postdata(); 
                            ?>
                        </select>
                    </div>

                    <input type="hidden" name="post-id" value="<?php echo $post_id ?>">
                    <input type="hidden" name="post-type" value="vacancy">
                    <input type="hidden" name="action" value="add-vacancy-entry">
            </div>

            <div class="project-new__btn">
                <div class="project-new__btn-box-top">
                    <input type="submit" class="btn-content btn-save" value="Сохранить">
                </div>
                </form>

                <div class="project-new__btn-box-bottom">
                    <form action="#" class="news-edit__delete">
                        <button class="btn-content btn-del">Удалить</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="btn-link__prew-next" style="margin-bottom:50px;">
            <a href="/kabinet" class="link-prew">Вернуться к списку вакансий</a>
        </div>
    </div>
</div>
