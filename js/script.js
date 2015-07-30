$(function () {
    $("#send_message").click(function () {
        var name_user = $('#form_application_1 #name_user').val();
        var email_user = $('#form_application_1 #email_user').val();
        var message_user = $("#form_application_1 #message_user").val();

        var error_flag = 0;

        if (name_user == '') {
            $('#empty_name').show();
            $("#name_user").addClass("red_field");

            error_flag++;
        } else {
            $('#empty_name').hide();
            $("#name_user").removeClass("red_field");
        }

        if (email_user == '') {
            $('#empty_email').show();
            $("#email_user").addClass("red_field");
            
            error_flag++;
        } else {
            $('#empty_email').hide();
            $("#email_user").removeClass("red_field");
        }

        if (message_user == '') {
            $('#empty_message').show();
            $("#message_user").addClass("red_field");
            
            error_flag++;
        } else {
            $('#empty_message').hide();
            $("#message_user").removeClass("red_field");
        }

        var regex = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i;
        var is_email = regex.exec(email_user);

        if (email_user != '' && is_email == null) {
            $('#incorrect_email').show();
            $("#email_user").addClass("red_field");

            error_flag++;
        } else if(email_user != '' && is_email != null) {
            $('#incorrect_email').hide();
            $("#email_user").removeClass("red_field");
        }

        if (error_flag == 0) {
            show_pop_up_captcha();
        }
    });

    $('.close_pop_up_captcha,#popup_overlay_captcha').click(function () {
        hide_pop_up_captcha();
    });

    $("#send_captcha").click(function () {
        var captcha = $("input[name='captcha']", '#form_captcha').val();

        $.post("/app_one/valid_captcha", {"captcha": captcha}, function (event) {
            if (event != 'ok') {
                $('#incorrect_captcha').show();
            } else {
                hide_pop_up_captcha();

                var name_user = $('#form_application_1 #name_user').val();
                var email_user = $('#form_application_1 #email_user').val();
                var message_user = $("#form_application_1 #message_user").val();

                $.post("/app_one/send_mess_to_app_two", {"name_user": name_user, "email_user": email_user, "message_user": message_user}, function (event) {
                    if (event == 'ok') {
                        alert('Ваше сообщение отправлено');
                    } else if (event == 'error_form') {
                        alert('Заполните правильно форму');
                    } else {
                        alert('Произошла ошибка при отправке');
                    }
                }, 'json');
            }
        }, "json");
    });
});

function show_pop_up_captcha() {
    $('#popup_overlay_captcha').show();
    $('#pop_up_captcha').show();
    $("input[name='captcha']", '#form_captcha').val('');
    $('#incorrect_captcha').hide();
}

function hide_pop_up_captcha() {
    $('#popup_overlay_captcha').hide();
    $('#pop_up_captcha').hide();
    $("input[name='captcha']", '#form_captcha').val('');
    $('#incorrect_captcha').hide();
}