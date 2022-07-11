<?php
$users_subscriber = get_users( array(
    'role'   => 'subscriber',
) );


?>

<div class="main-inner">
    <div class="main-inner__content box-noborder">
        <h2 class="main-inner__content--title">Личный кабинет</h2>

        <div class="main-inner__content--wrapper admin-box">
            <a href="#" class="btn-admin-50 btn-add">
                <div class="btn-admin__box">
                    <span class="btn-admin__text">Внесено всего:</span>
                    <span class="btn-admin__summ-add">1 000 000</span>
                    <span class="summ__box-ico">
                        <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 0V14H0V16H2V20H4V16H10V14H4V11H11.5C14.526 11 17 8.526 17 5.5C17 2.474 14.526 0 11.5 0H2ZM4 2H11.5C13.444 2 15 3.556 15 5.5C15 7.444 13.444 9 11.5 9H4V2Z" fill="#005300"/>
                        </svg>
                    </span>
                </div>
                <span class="ico-add"></span>
            </a>
            <a href="#" class="btn-admin-50 btn-out mr-0">
                <div class="btn-admin__box">
                    <span class="btn-admin__text">Выведено всего:</span>
                    <span class="btn-admin__summ-out">100 000</span>
                    <span class="summ__box-ico">
                        <svg width="17" height="20" viewBox="0 0 17 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 0V14H0V16H2V20H4V16H10V14H4V11H11.5C14.526 11 17 8.526 17 5.5C17 2.474 14.526 0 11.5 0H2ZM4 2H11.5C13.444 2 15 3.556 15 5.5C15 7.444 13.444 9 11.5 9H4V2Z" fill="#005300"/>
                        </svg>
                    </span>
                </div>
                <span class="ico-out"></span>
            </a>

            <a href="#" class="btn-admin-100">
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s30-1">Пользователи</span>
                    <span class="btn-admin__summ"><?php echo count( $users_subscriber ) ?></span>
                    <span class="btn-admin__text-other">человек(а)</span>
                </div>
                <span class="ico-btn-other"></span>
            </a>

            <a href="#" class="btn-admin-50">
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s30-2">Резюме</span>
                </div>
                <div class="btn-admin__box-2">
                    <!-- <span class="ico-btn-num"></span> -->
                    <span class="ico-btn-other"></span>
                </div>
            </a>

            <a href="#" class="btn-admin-50 mr-0">
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s30-2">Проекты</span>
                </div>
                <div class="btn-admin__box-2">
                    <span class="ico-btn-num">1</span>
                    <span class="ico-btn-other"></span>
                </div>
            </a>

            <a href="#" class="btn-admin-100">
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s26">Вакансии</span>
                </div>
                <span class="ico-btn-other"></span>
            </a>

            <a href="/news?p=moderate" class="btn-admin-50">
                <?php
                 $my_posts = get_posts( array(
                    'numberposts' => 8,
                    'category'    => 4,
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    'include'     => array(),
                    'exclude'     => array(),
                    'meta_key'    => '',
                    'meta_value'  => '',
                    'post_type'   => 'post',
                    'post_status' => 'pending',
                    'suppress_filters' => true, 
                ) );
                //wp_vardump( count($my_posts) );
                ?>
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s26">Новости на модерацию</span>
                </div>
                <div class="btn-admin__box-2">
                    <span class="ico-btn-num"><?php echo count($my_posts) ?></span>
                    <span class="ico-btn-other"></span>
                </div>
            </a>
            <a href="#" class="btn-admin-50 mr-0">
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s26">Новости на удаление</span>
                </div>
                <div class="btn-admin__box-2">
                    <span class="ico-btn-num">1</span>
                    <span class="ico-btn-other"></span>
                </div>
            </a>

            <a href="/addcopyriter" class="btn-admin-100">
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s26">Добавить / удалить копирайтера</span>
                </div>
                <span class="ico-btn-other"></span>
            </a>

            <a href="#" class="btn-admin-100">
                <div class="btn-admin__box">
                    <span class="btn-admin__text-s30-1">Техническая поддержка</span>
                </div>
                <div class="btn-admin__box-2">
                    <span class="ico-btn-num">3</span>
                    <span class="ico-btn-other"></span>
                </div>
            </a>
        </div>

    </div>
</div>