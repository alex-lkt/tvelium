<?php
if ( isset($_GET['r']) ) {
    $user_t = get_users( array(
        'login'   => trim( $_GET['r'] ),
    ) );
    $current_user = $user_t[0];
}
//wp_vardump( $current_user );
?>
<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Резюме</h2>
        <div class="main-inner__content--wrapper content-resume">
            <div class="content-wrapper__resume">
                <div class="resume__profile">
                    <div class="resume-profile__text">
                        <h2 class="resume__username"><?php echo $current_user->first_name ?><br><?php echo $current_user->last_name . " " . $current_user->surname_prof ?></h2> 
                        <div class="profile-box__title"><?php echo $current_user->title_prof ?></div>
                        <div class="profile-box__content">
                            <div class="content-left__phone"><a href="tel:<?php echo $current_user->phone_prof ?>"><?php echo $current_user->phone_prof ?></a></div>
                            <div class="content-left__location"><span><?php echo $current_user->city_prof ?></span></div>
                            <div class="content-left__email"><a href="mailto:<?php echo $current_user->user_email ?>"><?php echo $current_user->user_email ?></a></div>
                            <div class="content-left__birth"><span><?php echo $current_user->bird_prof ?></span></div>
                        </div>
                    </div>
                    <div class="content-left__img">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png" alt="ФИО">
                    </div>
                </div>

                <div class="resume__profile-mobile">
                    <div class="profile-mobile__header">
                        <h2 class="resume__username"><?php echo $current_user->first_name ?><br><?php echo $current_user->last_name?><br><?=$current_user->surname_prof ?></h2> 
                        <div class="content-left__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png" alt="ФИО">
                        </div>
                    </div>
                    <div class="profile-box__title first-title"><?php echo $current_user->title_prof ?></div>
                    <div class="profile-box__content">
                        <div class="content-left__phone"><a href="tel:<?php echo $current_user->phone_prof ?>"><?php echo $current_user->phone_prof ?></a></div>
                        <div class="content-left__location"><span><?php echo $current_user->city_prof ?></span></div>
                        <div class="content-left__email"><a href="mailto:<?php echo $current_user->user_email ?>"><?php echo $current_user->user_email ?></a></div>
                        <div class="content-left__birth"><span><?php echo $current_user->bird_prof ?></span></div>
                    </div>
                </div>
                
                <div class="profile-box__inner">
                    <div class="profile-box">
                        <div class="profile-box__title">образование</div>
                        <div class="profile-box__content">
                            <?php 
                                if ( !empty( $current_user->education_prof ) ):
                                 $education_prof = explode( ';', $current_user->education_prof );
                                
                                    foreach( $education_prof as $item ):
                            ?>
                            <div class="profile-box__text"><?php echo trim( $item ) ?></div>
                            <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>

                    <div class="profile-box">
                        <div class="profile-box__title">навыки</div>
                        <div class="profile-box__content">
                        <?php 
                            if ( !empty( $current_user->skills_prof ) ):
                                $skills_prof = explode( ';', $current_user->skills_prof );
                            
                                foreach( $skills_prof as $item ):
                        ?>
                        <div class="profile-box__text"><?php echo trim( $item ) ?></div>
                        <?php
                                endforeach;
                            endif;
                        ?>
                        </div>
                    </div>

                    <div class="profile-box">
                        <div class="profile-box__title">иностранные языки</div>
                        <div class="profile-box__content">
                        <?php 
                            if ( !empty( $current_user->languages_prof ) ):
                                $languages_prof = explode( ';', $current_user->languages_prof );
                            
                                foreach( $languages_prof as $item ):
                        ?>
                        <div class="profile-box__text"><?php echo trim( $item ) ?></div>
                        <?php
                                endforeach;
                            endif;
                        ?>
                        </div>
                    </div>

                    <div class="profile-box">
                        <div class="profile-box__title">дополнительная информация</div>
                        <div class="profile-box__content">
                        <?php 
                            if ( !empty( $current_user->additional_prof ) ):
                                $additional_prof = explode( ';', $current_user->additional_prof );
                            
                                foreach( $additional_prof as $item ):
                        ?>
                        <div class="profile-box__text"><?php echo trim( $item ) ?></div>
                        <?php
                                endforeach;
                            endif;
                        ?>
                        </div>
                    </div>

                    <div class="profile-box profile-experience">
                        <div class="profile-box__title">опыт работы</div>
                        <?php 
                            if ( !empty( $current_user->experience_prof ) ):
                                $experience_prof_string = explode( ';', $current_user->experience_prof );
                                foreach( $experience_prof_string as $item_string ):
                                    $experience_prof_item = explode( '|', $item_string );     
                        ?>
                                    <div class="profile-box__content">
                                        <div class="profile-box__text"><?php echo $experience_prof_item[0] ?></div>
                                        <div class="profile-box__text"><?php echo $experience_prof_item[1] ?></div>
                                    </div>
                        <?php
                                endforeach;
                            endif;
                        ?>
                    </div>
                </div>
                
                <div class="profile-box__btn-box">
                    <a href="/editresume?r=<?php echo $current_user->ID ?>" class="profile-box__edit">Редактировать</a>
                </div>
            </div>
        </div>

        <?php //include "content-news-list.php"; ?>

    </div>
</div>