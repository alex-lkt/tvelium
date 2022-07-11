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
        let user_adm = null;
  
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

    /* mobile submenu */
    const subMenuBtn = document.querySelector('#submenu-btn');
    const subMenu = document.querySelector('.footer-mobile__submenu');

    if (subMenuBtn) {
        subMenuBtn.addEventListener('click', function(e) {
            e.preventDefault();

            subMenu.classList.toggle('active');
        });
    }
    

    // form add and delete input
    const btnPlus2 = document.querySelectorAll('.profile-input__btn-plus');
    const btnMinus2 = document.querySelectorAll('.profile-input__btn-minus');
    // плюс поле
    if ( btnPlus2 ) {
        btnPlus2.forEach((item) => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const myNode = this.parentNode;
                const nameIndex = myNode.dataset.index;
                //console.log(myNode);
                //console.log(nameIndex);
                var new_field = document.createElement("input");
                new_field.setAttribute("type", "text");
                new_field.setAttribute("name", nameIndex);
                new_field.setAttribute("class", "profile-box__content-data2");
                //console.log(new_field);
                myNode.prepend(new_field);
            });
        });
    }
    // минус поле
    if ( btnMinus2 ) {
        btnMinus2.forEach((item) => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                let minusInput = item.previousSibling.previousSibling.previousSibling.previousSibling;
                minusInput.remove();
            });
        });
    }
        
    const btnPlus3 = document.querySelectorAll('.profile-input__btn-plus3');
    const btnMinus3 = document.querySelectorAll('.profile-input__btn-minus3');

    if ( btnPlus3 ) {
        btnPlus3.forEach((item) => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const myNode = this.parentNode;
                const nameIndex = myNode.dataset.index;
                const nameNumber = Number(myNode.dataset.number) + 1;
                //console.log(nameNumber);
                //console.log(nameNumber);
                var new_field1 = document.createElement("input");
                new_field1.setAttribute("type", "text");
                new_field1.setAttribute("name", 'experience_prof_1[]'); // 'experience_prof_1[' + nameNumber + ']'
                new_field1.setAttribute("class", "profile-box__content-data3");

                var new_field2 = document.createElement("input");
                new_field2.setAttribute("type", "text");
                new_field2.setAttribute("name", 'experience_prof_0[]');
                new_field2.setAttribute("class", "profile-box__content-data3");
                //console.log(new_field);
                myNode.prepend(new_field1);
                myNode.prepend(new_field2);
            });
        });
    }
    // минус поле
    if ( btnMinus3 ) {
        btnMinus3.forEach((item) => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                let minusInput1 = item.previousSibling.previousSibling.previousSibling.previousSibling;
                let minusInput2 = item.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling;
                //console.log(minusInput1);
                //console.log(minusInput2);
                minusInput1.remove();
                minusInput2.remove();
            });
        });
    }

    // modal
    // document.querySelectorAll('.modal-show').forEach(function(element) {
    //     element.onclick = showModal;
    // });
    document.querySelectorAll('.modal-close').forEach(function(element) {
        element.onclick = closeModal;
    });
    document.querySelectorAll('.modal-wrap').forEach(function(element) {
        //element.onclick = closeModal;
    });

    function showModal(chips) {
        let modalBox = document.querySelector('#error-in');
        let modalContent = modalBox.querySelector('.modal-content');
        //console.log(modalBox, modalContent, chips);return;
        modalContent.appendChild(chips);
        modalBox.classList.remove('hide');
        document.onkeydown = function(event) {
            if (event.keyCode == 27) {
                closeModal();
            }
        }
    }
    function closeModal() {
        //console.log( this );
        document.querySelectorAll('.modal-wrap').forEach(function(element) {
            element.classList.add('hide');
            element.querySelector('.modal-content').innerHTML = '';
        });
        document.onkeydown = null;
    }

    // chips message
    function chips(message, timeremove = 3000) {
        let chips = document.createElement('div');
        chips.classList.add('chips-message');
        chips.innerHTML = message;
        //console.log(chips);return;
        showModal(chips);
        setTimeout(function() {
            closeModal()
        }, timeremove);
    }

    // Авторизация
    $('#get_auth').submit( function() {

        var form = $(this);
        //alert(form);
        $.ajax({
            type: 'POST',
            url: mainajax.ajax_url,
            data: form.serialize(),
            beforeSend: function(xhr) {
                form.find('button').text('Отправляем запрос...');
            },
            success: function( data ) {
                form.find('button').text('Войти');
                console.log(data);
                if (data == '0') {
                    chips("Не правильно введены логин или пароль!...");
                    return false;
                } else {
                    form.find('button').text('Привет, ' + data);
                    document.location.href = '/kabinet';
                }
            }
        });

        return false;
    } );

    // Регистрация. Проверка формы регистрации
    $('#get_reg').submit( function(e) {
        e.preventDefault();

        var form = $(this);

        // Проверка телефона и ПК при отправке формы
        var firstname = form[0].querySelector('input[name="firstname"]').value.trim();
        var lastname = form[0].querySelector('input[name="lastname"]').value.trim();
        var phone = form[0].querySelector('input[name="userphone"]').value.trim();
        var email = form[0].querySelector('input[name="useremail"]').value.trim();
        var refcode = form[0].querySelector('input[name="refcode"]').value.trim();
        var checked = $("#form__checkbox input:checked").length > 0;
        var userpassword = form[0].querySelector('input[name="userpassword"]').value.trim();
        var repeat_password = form[0].querySelector('input[name="repeat_password"]').value.trim();

        if (firstname  === '') {
            chips("Заполните поле с Фамилией");
            return false;
        }
        if (lastname  === '') {
            chips("Заполните поле с именем");
            return false;
        }

        if (phone  === '') {
            chips("Заполните поле с номером телефона");
            return false;
        } else if (phone.length < 8) {
            chips("Слишком короткий номер телефона");
            return false;
        } else if (!((phone.lastIndexOf("+7", 0) === 0) || (phone.lastIndexOf("8", 0) === 0))) {
            chips("Введите корректный номер в формате<br>+79998887766 или 89998887766");
            return false;
        }
        
        if(email  === '' || !validateEmail(email)) { 
            chips("Введите корректный E-mail");
            return false;
        }
        
        if (userpassword  === '') {
            chips("Заполните поле с паролем<br>(не менее 8 символов)");
            return false;
        } else if (userpassword.length < 8) {
            chips("Пароль должен быть не менее 8 символов");
            return false;
        } 

        if (userpassword !== repeat_password) {
            chips("Пароли не совпадают");
            return false;
        }

        if (refcode  === '') {
            chips("Введите реферальный код");
            return false;
        }

         if (!checked){
            chips('Подтвердите согласие согласие<br>на обработку персональных данных', 2000);
            return false;
        }

        $.ajax({
            type: 'POST',
            url: mainajax.ajax_url,
            data: form.serialize(),
            beforeSend: function(xhr) {
                form.find('button').text('Отправляем запрос...');
            },
            success: function( data ) {
                //console.log('0-->', serialize.data);

                if ( data == "Такого реферального кода не существует!" ) {
                    //console.log('1-->', data);
                    form.find('button').text('Зарегистривароться');
                    chips( data, 5000);
                } else if ( data == "Извините, это имя пользователя уже существует!" ) { // Проверка что не текст
                    //console.log('2-->', data);
                    form.find('button').text('Зарегистривароться');
                    chips("Такой пользователь уже существует!", 5000);
                } else if( data.length >= 2 && data.length <= 5 ) {
                    //console.log('3-->', data);

                    $.ajax({
                        type: 'POST',
                        url: mainajax.ajax_url,
                        data: ({action: 'trueuser', user_id: data}),
                        success: function( msg ) {
                            if (msg = data) {
                                $('.homepage-form__r').hide();
                                $('.form-content__reg').removeClass('content-active');
                                $('.form-content__in').addClass('content-active');
                                chips("Вы зарегистрированы!");
                            } else {
                                form.find('button').text('Зарегистривароться');
                                chips("Ошибка регистрации, попробуйте еще раз!", 3000);
                            }
                        }
                    });

                } else {
                    //console.log('4-->', data);
                    form.find('button').text('Зарегистривароться');
                    chips("Произошла ошибка, попробуйте еще раз!", 3000);
                }
                //document.location.href = '/'; // kabinet
            }
        });
    });

    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
    }

    /* Показ окна рефералов */
    const refBtn = document.querySelectorAll('.content-left__ref-data');
    
    refBtn[1].onclick = function() {
        //console.log(refBtn);
        this.classList.toggle('height-full');
    };

    // Разблокировка кнопки оплаты min тарифа
    // const tarifMinText = document.querySelector('.box-block-text');
    // const tarifMinBtnOpen = document.querySelector('.box-block-text-open');
    
    // if (tarifMinBtnOpen) {
    //     const tarifBtn = tarifMinText.parentNode;
    //     tarifBtn.addEventListener('click', function(e) {
    //         e.preventDefault();
            
    //         tarifMinText.style.display = 'block';
    //         setTimeout(function() {
    //             tarifMinText.style.display = 'none';
    //         }, 2000);
    //     });
    // }

    


})