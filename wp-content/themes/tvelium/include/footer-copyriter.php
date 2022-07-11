<div class="footer-mobile">

    

    <ul class="footer-mobile__list">
        <li>
            <a href="/kabinet" class="footer-mobile__link <?echo $_SERVER['REQUEST_URI'] == '/kabinet/' ? 'active' : ''?>">
                <span class="menu-li__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/icon-lk.svg" alt="">
                </span>
                <span class="menu-li__title">Личный<br>кабинет</span>    
            </a>
        </li>
        <li>
            <a href="/news" class="footer-mobile__link <?echo $_SERVER['REQUEST_URI'] == '/news/' ? 'active' : ''?>">
                <span class="menu-li__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/icon-koschelek.svg" alt="">
                </span>
                <span class="menu-li__title">Новости</span>    
            </a>
        </li>
        <li>
            <a href="/support" class="footer-mobile__link <?echo $_SERVER['REQUEST_URI'] == '/support/' ? 'active' : ''?>">
                <span class="menu-li__img">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/icon-vacance.svg" alt="">
                </span>
                <span class="menu-li__title">Техподдержка</span>    
            </a>
        </li>
    </ul>
</div>