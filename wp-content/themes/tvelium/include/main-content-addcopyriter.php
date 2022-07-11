<div class="main-inner">
    <div class="main-inner__content">
        <h2 class="main-inner__content--title">Личный кабинет</h2>

        <h3 class="main-inner__content--title-2">Список копирайтеров</h3>

        <div class="main-inner__content--wrapper box-noborder-nocolumn">
            <div class="help-table__box box-copyriter">
                <?php 
                $users = get_users( array(
                    'role'   => 'author',
                ) );
                ?>
                <table class="content-help__table">
                    <tr class="help-table__header">
                        <td>№</td>
                        <td>ФИО пользователя</td>
                        <td>E-mail</td>
                        <td class="help-table__checkbox">Активен</td>
                    </tr>
                <?php
                $i = 0;
                foreach( $users as $user ):
                ?>
                    <tr class="help-table__text">
                        <form action="" name="user_<?php echo $user->data->ID ?>" data-userid="<?php echo $user->data->ID ?>">
                            <td><?php echo ++$i; ?></td>
                            <td>
                                <a href="#" class="help-table__link"><?php echo $user->last_name . ' ' . $user->first_name . ' ' . $user->surname_prof ?></a>
                            </td>
                            <td><?php echo $user->data->user_email ?></td>
                            <td class="help-table__checkbox">
                                <input type="checkbox" name="copiriter-del" id="copiriter-del">
                            </td>
                        </form>
                    </tr>
                <?php
                endforeach;
                ?>
                </table>
            </div>
        </div>

        <div class="main-inner__content--wrapper form-box-new-copyriter box-noborder">
            <h3 class="main-inner__content--title-2">Добавить копирайтера</h3>

            <form action="<?php echo esc_url(admin_url( 'admin-post.php' )) ?>" method="post" class="copiriter__box">
                <div class="input-box">
                    <input type="text" name="lastname" class="copiriter-box__input" id="lastname" placeholder="Фамилия">
                    <input type="text" name="username" class="copiriter-box__input" id="username" placeholder="Имя">
                    <input type="text" name="surname" class="copiriter-box__input" id="surname" placeholder="Отчество">
                    <input type="text" name="user-login" class="copiriter-box__input" id="user-login" placeholder="Логин">
                    <input type="password" name="user-pass" class="copiriter-box__input" id="user-pass" placeholder="Пароль">
                    <input type="text" name="user-email" class="copiriter-box__input" id="user-email" placeholder="Email">
                    <input type="hidden" name="action" value="add-copyriter">
                </div>

                <div class="content-news__link-btn">
                    <button class="btn news-btn__full--news">Добавить</button>
                </div>
            </form>
        </div>

        <div class="main-inner__content--wrapper box-noborder box-content__footer-link" style="align-items: flex-end;">
            <div class="btn-link__prew-next">
                <a href="#" class="link-prew">Назад</a>
            </div>
        </div>
    </div>
</div>