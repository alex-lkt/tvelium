<div class="main-inner">
    <div class="main-inner__content">
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
                //'author'      => $current_user->ID,
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
