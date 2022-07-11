jQuery(function($){

    const sendForm = document.querySelectorAll('#send-pay');
    
    // sendForm.forEach((item, key) => {
    //     item.querySelector('.content-left__deposit-btn').onclick = function(e) {
    //         e.preventDefault();
    //         let formBox = document.querySelector('#pay-screen__inner');
    //         const loader = document.querySelector('.loader');

    //         $.ajax({
    //             method: "POST",
    //             url: "/wp-action/pay-form.php",
    //             data: ({
    //                 sum: (item.querySelector('input[name="user-tarif"]').value.trim() == "max") ? userSumm = item.querySelector('input[name="user-summ"]').value.trim() : 3000,
    //                 client_login: item.querySelector('input[name="client_login"]').value.trim(), 
    //                 orderid: item.querySelector('input[name="orderid"]').value.trim(),
    //                 client_phone: item.querySelector('input[name="optional_phone"]').value.trim()
    //             }),
    //             beforeSend: function(xhr) {
    //                 loader.classList.add('.fade-in');
    //                 loader.classList.remove('.fade-out');
    //             },
    //             success: function( data ) {
    //                 document.querySelector('#pay__screen-1').style.display = "none";
    //                 document.querySelector('#pay__screen-2').style.display = "block";
    //                 loader.classList.remove('.fade-in');
    //                 loader.classList.add('.fade-out');
                    

    //                 formBox.innerHTML = data;
    //             }
    //         });
    //     };
    // });
    

});