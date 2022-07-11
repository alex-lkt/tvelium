<?php
//wp_vardump( $current_user->title_prof );
?>
<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Резюме</h2>
        <div class="main-inner__content--wrapper">
            <div class="content-wrapper__resume">
                <form action="<?php echo esc_url(admin_url( 'admin-post.php' )) ?>" name="" method="POST" enctype="multipart/form-data">
                    <div class="resume__profile">
                        <div class="resume-profile__text">
                            <div class="resume-profile__name-box">
                                <label for="first_name" class="profile__name-box--name">Фамилия</label>
                                <h4 class="resume__username">
                                    <input type="text" name="first_name" id="first_name" value="<?php echo $current_user->first_name ?>">
                                </h4> 
                            </div>
                            <div class="resume-profile__name-box">
                                <label for="last_name" class="profile__name-box--name">Имя</label>
                                <h4 class="resume__username">
                                    <input type="text" name="last_name" id="last_name" value="<?php echo $current_user->last_name ?>">
                                </h4> 
                            </div>
                            <div class="resume-profile__name-box">
                                <label for="surname_prof" class="profile__name-box--name">Отчество</label>
                                <h4 class="resume__username">
                                    <input type="text" name="surname_prof" id="surname_prof" value="<?php echo $current_user->surname_prof ?>">
                                </h4> 
                            </div>
 
                            <div class="profile-box__title">
                                <label for="title_prof" class="profile__name-box--name">Профессия для резюме</label>
                                <input type="text" name="title_prof" id="title_prof" value="<?php echo $current_user->title_prof ?>">
                            </div>
                            <div class="profile-box__content">
                                <div class="content-left__phone">
                                    <input type="text" name="phone_prof" id="phone_prof" class="profile-box__content-data1" value="<?php echo $current_user->phone_prof ?>">
                                </div>
                                <div class="content-left__location">
                                    <input type="text" name="city_prof" id="city_prof" class="profile-box__content-data1" value="<?php echo $current_user->city_prof ?>">
                                </div>
                                <div class="content-left__email">
                                    <input type="text" name="user_email" id="user_email" class="profile-box__content-data1" value="<?php echo $current_user->user_email ?>">
                                </div>
                                <div class="content-left__birth">
                                    <input type="text" name="bird_prof" id="bird_prof" class="profile-box__content-data1" value="<?php echo $current_user->bird_prof ?>">
                                </div>
                            </div>
                        </div>
                        <div class="content-left__img">
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png" alt="ФИО">
                        </div>
                    </div>
                    
                    <div class="profile-box__inner">
                        <div class="profile-box">
                            <div class="profile-box__title">образование</div>
                            <div class="profile-box__content">
                                <?php 
                                    if ( !empty( $current_user->education_prof ) ):
                                    $education_prof = explode( ';', $current_user->education_prof );
                                    
                                        foreach( $education_prof as $i => $item ):
                                ?>
                                <div class="profile-box__text">
                                    <input type="text" name="education_prof[]" class="profile-box__content-data2" value="<?php echo trim( $item ) ?>">
                                </div>
                                <?php
                                        endforeach;
                                    endif;
                                ?>
                                <div class="profile-box__text" data-index="education_prof[]">
                                    <button class="profile-input__btn-plus">+</button>
                                    <button class="profile-input__btn-minus">-</button>
                                </div>
                            </div>
                        </div>

                        <div class="profile-box">
                            <div class="profile-box__title">навыки</div>
                            <div class="profile-box__content">
                                <?php 
                                    if ( !empty( $current_user->skills_prof ) ):
                                        $skills_prof = explode( ';', $current_user->skills_prof );
                                    
                                        foreach( $skills_prof as $i => $item ):
                                ?>
                                <div class="profile-box__text">
                                    <input type="text" name="skills_prof[]" class="profile-box__content-data2" value="<?php echo trim( $item ) ?>">
                                </div>
                                <?php
                                        endforeach;
                                    endif;
                                ?>
                                <div class="profile-box__text" data-index="skills_prof[]">
                                    <button class="profile-input__btn-plus">+</button>
                                    <button class="profile-input__btn-minus">-</button>
                                </div>
                            </div>
                        </div>

                        <div class="profile-box">
                            <div class="profile-box__title">иностранные языки</div>
                            <div class="profile-box__content">
                                <?php 
                                    if ( !empty( $current_user->languages_prof ) ):
                                        $languages_prof = explode( ';', $current_user->languages_prof );
                                    
                                        foreach( $languages_prof as $i => $item ):
                                ?>
                                <div class="profile-box__text">
                                    <input type="text" name="languages_prof[]" class="profile-box__content-data2" value="<?php echo trim( $item ) ?>">
                                </div>
                                <?php
                                        endforeach;
                                    endif;
                                ?>
                                <div class="profile-box__text" data-index="languages_prof[]">
                                    <button class="profile-input__btn-plus">+</button>
                                    <button class="profile-input__btn-minus">-</button>
                                </div>
                            </div>
                        </div>

                        <div class="profile-box">
                            <div class="profile-box__title">дополнительная информация</div>
                            <div class="profile-box__content">
                                <?php 
                                    if ( !empty( $current_user->additional_prof ) ):
                                        $additional_prof = explode( ';', $current_user->additional_prof );
                                    
                                        foreach( $additional_prof as $i => $item ):
                                ?>
                                <div class="profile-box__text">
                                    <input type="text" name="additional_prof[]" class="profile-box__content-data2" value="<?php echo trim( $item ) ?>">
                                </div>
                                <?php
                                        endforeach;
                                    endif;
                                ?>
                                <div class="profile-box__text" data-index="additional_prof[]">
                                    <button class="profile-input__btn-plus">+</button>
                                    <button class="profile-input__btn-minus">-</button>
                                </div>
                            </div>
                        </div>

                        <div class="profile-box profile-experience">
                            <div class="profile-box__title">опыт работы</div>
                            <?php 
                                if ( !empty( $current_user->experience_prof ) ):
                                    $experience_prof_string = explode( ';', $current_user->experience_prof );
                                    foreach( $experience_prof_string as $i => $item_string ):
                                        $experience_prof_item = explode( '|', $item_string );     
                            ?>
                                        <div class="profile-box__content profile-box__content-box1">
                                            <div class="profile-box__text profile-box__text-flex">
                                                <input type="text" name="experience_prof_0[<?php echo $i ?>]" class="profile-box__content-data3" value="<?php echo $experience_prof_item[0] ?>">
                                                <input type="text" name="experience_prof_1[<?php echo $i ?>]" class="profile-box__content-data3" value="<?php echo $experience_prof_item[1] ?>">
                                            </div>
                                        </div>
                            <?php
                                    endforeach;
                                endif;
                            ?>
                            <div class="profile-box__content profile-box__content-box1">
                                <div class="profile-box__text profile-box__text-flex" data-index="experience_prof[]" data-number="<?php echo ++$i ?>">
                                    <button class="profile-input__btn-plus3">+</button>
                                    <button class="profile-input__btn-minus3">-</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="post-id" value="<?php echo $current_user->ID ?>">
                    <input type="hidden" name="post-type" value="resume">
                    <input type="hidden" name="post-link" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
                    <input type="hidden" name="action" value="edit-resume-entry">
                    
                    <div class="profile-box__btn-box resume-btn-box">
                        <input type="submit" class="btn-content btn-save" value="Сохранить">
                    </div>
                </form>
            </div>
        </div>

       
    </div>
</div>