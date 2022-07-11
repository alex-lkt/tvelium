<?php 
$post_id = '';
$content = '';
$post_title = '';
if ( isset($_GET['r']) ) {
    $post_id = strip_tags( $_GET['r'] );

    $post = get_post( $post_id, OBJECT, 'edit' );
    $content = $post->post_content;
    $post_title = $post->post_title;
}
?>

<div class="main-inner">
    <div class="main-inner__content">
        <div class="breadcrumbs-box">
            <span class="breadcrumbs-nolink">Главная</span>
            <span class="breadcrumbs-strip">/</span>
            <a href="#" class="breadcrumbs-link">Техподдержка</a>
        </div>

        <div class="main-inner__content--wrapper box-noborder-nocolumn">
            <div class="content-help__box-left">
                <h2 class="content-help__title">Техническая поддержка</h2>
                <form class="help-chat" action="<?php echo esc_url(admin_url( 'admin-post.php' )) ?>" name="" method="POST" enctype="multipart/form-data">
                    <input type="text" name="help_title" class="help-edit__title-input" id="help-title" value="<?php echo $post_title ?>" placeholder="Тема">
                    <textarea id="help-text" name="help_text" placeholder="Опишите проблему"></textarea>

                    <?php wp_referer_field() ?>
                    <input type="hidden" name="post-id" value="<?php echo $post_id ?>">
                    <input type="hidden" name="post-type" value="support">
                    <input type="hidden" name="help_status" value="new">
                    <input type="hidden" name="action" value="add-support-entry">

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
                        <td>ID</td>
                        <td>Тема</td>
                        <td>Дата</td>
                        <td>Статус</td>
                    </tr>
                <?php
                    //wp_vardump($current_user->ID);
                    $my_posts = get_posts( array(
                        'numberposts' => 50,
                        'orderby'     => 'date',
                        'order'       => 'DESC',
                        'include'     => array(),
                        'exclude'     => array(),
                        'author'      => $current_user->ID,
                        'post_type'   => 'support',
                        'post_status' => 'publish',
                        'suppress_filters' => true, 
                    ) );
                    
                    foreach( $my_posts as $post ){
                        setup_postdata( $post );
                        $help_status = get_post_meta( $post->ID, 'help_status' );
                        //wp_vardump($help_status);
                        if ( $help_status[0] == 'new' ) {
                            $status_class = 'help_status_new';
                            $status = 'Ожидает';
                        } else if ($help_status[0] == 'executed') {
                            $status_class = 'help_status_executed';
                            $status = 'Исполнено';
                        }
                    ?>
                    <tr class="help-table__text">
                        <td><?php echo $post->ID ?></td>
                        <td><a href="/readsupport?r=<?php echo $post->ID ?>" class="help-table__link"><?php the_title(); ?></a></td>
                        <td><?php echo the_time('j F Y'); ?></td>
                        <td><span class="help-status <?php echo $status_class ?>"><?php echo $status ?></span></td>
                    </tr>    
                    <?php
                    }
                    
                    wp_reset_postdata(); 
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>