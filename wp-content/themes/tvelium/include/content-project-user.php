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
$status = 'publish, pending';
?>

<div class="main-inner content-project-edit">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Проекты</h2>
        <div class="main-inner__content--wrapper content-project">
            <div class="project-new__content">
                <div class="news-edit__redactor">
                    <h1 class="news-edit__title">Название проекта</h1>
                    
                    <form action="<?php echo esc_url(admin_url( 'admin-post.php' )) ?>" name="" method="POST" enctype="multipart/form-data">
                        <input type="text" name="true_title" class="news-edit__title-input" value="<?php echo $post_title ?>">

                        <textarea name="true_content" id="news-edit__textarea" cols="30" rows="10"><?php echo $content ?></textarea>

                        <div class="news-edit__img-box">
                        <p>Прикрепить доп. информацию</p>
                        <?php
                        //$attachments = get_attached_media( '', $post->ID );
                        
                        if (!empty($attachments)):
                            foreach($attachments as $data_file):
                        ?>  
                            <div class="news-edit__file-box">
                                <a href="<?php echo $data_file->guid ?>" class="news-edit__file"><?php echo $data_file->post_name ?></a>
                            </div>
                        <?php
                            endforeach;
                        endif;    
                        ?>
                        <input type="file" name="my_file_upload" class="true-img__input">
                        <?php wp_nonce_field('my_file_upload', 'fileup_nonce'); ?>
                    </div>
                        
                        <input type="hidden" name="post-id" value="<?php echo $post_id ?>">
                        <input type="hidden" name="post-type" value="project">
                        <input type="hidden" name="page-link" value="/project">
                        <input type="hidden" name="action" value="add-custom-entry">
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
                $args = array(
                    'posts_per_page' => 4,
                    'paged'          => get_query_var( 'page' ),
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'post_type'      => 'project',
                    'post_status'    => 'publish, pending',
                    'author'         => $current_user->ID,
                    'suppress_filters' => true, 
                    'prev_next'      => false,
                );
                
                $query = new WP_Query( $args );
                
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                    //wp_vardump($post);
                   ?>
                    <div class="content-project__item">
                        <a href="<?php the_permalink(); ?>">
                            <div class="project-item__img-box">
                                <?php if( has_post_thumbnail() ): ?>
                                    <a href="<?php echo '/' . $post->post_type . '/' . $post->post_name ?>" title="<?php the_title_attribute(); ?>" >
                                        <?php the_post_thumbnail( 'full' ); ?>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo '/' . $post->post_type . '/' . $post->post_name ?>" title="<?php the_title(); ?>" >
                                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/project-img.png" alt="<?php the_title(); ?>">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="news-item__text-box">
                                <a href="<?php echo '/' . $post->post_type . '/' . $post->post_name ?>" title="<?php the_title(); ?>" >
                                    <h3 class="project-item__title"><?php the_title(); ?></h3>
                                </a>
                                <div class="news-item__footer">
                                    <div class="project-item__date"><?php echo the_time('j F Y'); ?></div>
                                    <a href="/editproject?r=<?php echo $post->ID ?>" class="news-item__edit">Редактировать</a>
                                </div>  
                            </div>
                        </a>
                    </div>
                    <?php
                    }
                }
                wp_reset_postdata(); 
                ?>
                <?php
                    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                    $max_pages = $query->max_num_pages;

                    if( $paged < $max_pages ):
                ?>
                        <div id="loadmore" style="text-align:center;">
                            <a href="#" data-max-pages="<?php echo $max_pages ?>" data-paged="<?php echo $paged ?>" data-post-type="project" class="page-numbers">Загрузить ещё</a>
                        </div>
                <?php
                    endif
                ?>
            </div>
            
        </div>
    </div>
</div>