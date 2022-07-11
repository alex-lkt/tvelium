$(function () {
    
    // homepage form tabs
    let contentBtn = document.querySelectorAll('.tabs-btn__item');
    let contentBox = document.querySelectorAll('.form__content');
    
    if (contentBtn) {
        contentBtn.forEach((item, key) => {
            item.addEventListener('click', function() {
                for(let i = 0; i < contentBtn.length; i++) {
                    contentBtn[i].classList.remove('btn-active');
                    contentBox[i].classList.remove('content-active');
                };
                contentBtn[key].classList.add('btn-active');
                contentBox[key].classList.add('content-active');
            });
        });
    }
    
    // header fixed
    $(function() {
        let header = $('.header-wrapper');
        let hederHeight = header.height(); 
  
        $(window).scroll(function() {
            if($(this).scrollTop() > 1) {
                header.addClass('header_fixed');
                // margin admin panel 
                if (user_adm) {
                    header.css({'marginTop': '32px'});
                }
                $('body').css({
                    'paddingTop': hederHeight +'px'
                });
            } else {
                if (user_adm) {
                    header.css({'marginTop': '0'});
                }
                header.removeClass('header_fixed');
                    $('body').css({
                    'paddingTop': 0 
                });
            }
        });
    });

})