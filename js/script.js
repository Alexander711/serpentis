$(function () {
    $('#site_data').click(function () {
        $('#site_data_form').toggle("slow");
    });

    $('#way_priv_transport').click(function () {
        $('#way_priv_transport_form').toggle("slow");
    });

    $('#way_pub_transport').click(function () {
        $('#way_pub_transport_form').toggle("slow");
    });

    $('#taxi').click(function () {
        $('#taxi_form').toggle("slow");
    });

    $('#rent_car').click(function () {
        $('#rent_car_form').toggle("slow");
    });

    $('#new_img').click(function () {
        $('#new_img_form').toggle("slow");
    });

    $('input[type=file]').change(function () {
        $("#default_img").prop('checked', false);

        $(".img_widget_from_db").hide();
        $("#img_marker_from_db").val('');
        $("#img_map_from_db").val('');
        $("#type_img_from_db").val('');
    });

    $('#default_img').change(function () {
        $(".img_widget_from_db").hide();
        $("#img_marker_from_db").val('');
        $("#img_map_from_db").val('');
        $("#type_img_from_db").val('');
    });

    if ($('#add_widget_form #html_priv_transport').val() != '') {
        $('#way_priv_transport_form').toggle();
        $("#turn_on_priv_transport").prop('checked', true);
    }

    if ($('#add_widget_form #html_pub_transport').val() != '') {
        $('#way_pub_transport_form').toggle();
        $("#turn_on_pub_transport").prop('checked', true);
    }

    if ($('#add_widget_form #html_taxi').val() != '') {
        $('#taxi_form').toggle();
        $("#turn_on_taxi").prop('checked', true);
    }

    if ($('#add_widget_form #html_rent_car').val() != '') {
        $('#rent_car_form').toggle();
        $("#turn_on_rent_car").prop('checked', true);
    }

    if ($('#add_widget_form #img_map_from_db').val() != '' && $('#add_widget_form #img_marker_from_db').val() != '') {
        $('#new_img_form').toggle();
    }

    $("#add_widget_form").on('submit', function (e) {
        var error_mass = validate_add_widget_form();
        var error_mess = '';

        if (error_mass.length != 0) {
            e.preventDefault();

            for (i = 0; i < error_mass.length; i++) {
                error_mess = error_mess + '<span>' + error_mass[i] + '</span>'
                $('.errors_add_widget').html(error_mess);
                $('.errors_add_widget').show().delay(5000).fadeOut(1000);
            }
        } else {
            $('.errors_add_widget').hide();
        }
    });

    $(".delete_widget").click(function () {
        if (confirm("Вы уверены что хотите удалить?")) {
            var id = $(this).data('id');

            $.post("/admin/generate_widget/delete_widget", {'id': id}, function (event) {
                $('#widget_row_' + id).fadeOut(300);
            });
        }
    });

    $(".installation_check").click(function () {
        var id = $(this).data('id');

        $.post("/admin/generate_widget/installation_check", {'id': id}, function (event) {
            if (event == 'installed') {
                $('#installation_check_' + id).html('<img src="/images/icon_ok_green.png" title="Проверить установку виджета(Виджет установлен)">');
            } else if (event == 'not installed') {
                $('#installation_check_' + id).html('<img src="/images/gearblue.png" title="Проверить установку виджета(Виджет не установлен)">');
            }
        });
    });

    $(".active_status").click(function () {
        var id = $(this).data('id');
        var active_status = $(this).data('active_status');

        $.post("/admin/generate_widget/change_active_widget", {id: id, active_status: active_status}, function (event) {
            if (event == 'ok' && active_status == 1) {
                if (!$('#activated_' + id).hasClass('active_status_hide')) {
                    $('#activated_' + id).addClass('active_status_hide');
                }

                $('#not_activated_' + id).removeClass('active_status_hide');

            } else if (event == 'ok' && active_status == 0) {
                if (!$('#not_activated_' + id).hasClass('active_status_hide')) {
                    $('#not_activated_' + id).addClass('active_status_hide');
                }

                $('#activated_' + id).removeClass('active_status_hide');
            }
        });
    });

    $("#login_form").submit(function (e) {
        e.preventDefault();

        var error_mass = validate_login_form();
        var error_mess = '';

        if (error_mass.length == 0) {
            $('.errors_login_form').hide();

            $.post("/admin/authorization/login", $('#login_form').serialize(), function (event) {
                if (event == 'ok') {
                    window.location.replace("/admin/generate_widget/widgets");
                } else {
                    $('.errors_login_form').html(event);
                    $('.errors_login_form').show().delay(5000).fadeOut(1000);
                }
            });
        } else {
            for (i = 0; i < error_mass.length; i++) {
                error_mess = error_mess + '<span>' + error_mass[i] + '</span><br/>';
                $('.errors_login_form').html(error_mess);
                $('.errors_login_form').show().delay(5000).fadeOut(1000);
            }
        }
    });

    $("#edit_user_data_form").submit(function (e) {
        e.preventDefault();

        var error_mass = validate_edit_form();
        var error_mess = '';

        if (error_mass.length == 0) {
            $('.errors_edit_user').hide();

            $.post("/admin/authorization/edit_user_data", $('#edit_user_data_form').serialize(), function (event) {
                if (event.status_ajax == 'ok') {
                    $('#user_name_aut').html(event.name + ' ' + event.last_name + "!");
                    $('#user_email_aut').html('(' + event.email + ')');
                    alert('Данные изменены');
                } else {
                    $('.errors_edit_user').html(event.error_mass);
                    $('.errors_edit_user').show().delay(5000).fadeOut(1000);
                }
            }, 'json');
        } else {
            for (i = 0; i < error_mass.length; i++) {
                error_mess = error_mess + '<span>' + error_mass[i] + '</span><br/>';
                $('.errors_edit_user').html(error_mess);
                $('.errors_edit_user').show().delay(5000).fadeOut(1000);
            }
        }
    });
});

function validate_add_widget_form() {
    var error_mass = new Array();

    var site_url = $('#add_widget_form #site_url').val();
    var img_marker_from_db = $('#add_widget_form #img_marker_from_db').val();
    var img_map_from_db = $('#add_widget_form #img_map_from_db').val();

    if (site_url == '') {
        error_mass.push('Заполните поле "Ссылка на сайт"');
    }

    if ($("#turn_on_priv_transport").prop("checked")) {
        var html_priv_transport = $('#add_widget_form #html_priv_transport').val();

        if (html_priv_transport == '') {
            error_mass.push('Введите HTML код для раздела "Добраться на авто"');
        }
    }

    if ($("#turn_on_pub_transport").prop("checked")) {
        var html_pub_transport = $('#add_widget_form #html_pub_transport').val();

        if (html_pub_transport == '') {
            error_mass.push('Введите HTML код для раздела "Добраться на общественном транспорте"');
        }
    }

    if ($("#turn_on_taxi").prop("checked")) {
        var html_taxi = $('#add_widget_form #html_taxi').val();

        if (html_taxi == '') {
            error_mass.push('Введите HTML код для раздела "Заказать такси"');
        }
    }

    if ($("#turn_on_rent_car").prop("checked")) {
        var html_rent_car = $('#add_widget_form #html_rent_car').val();

        if (html_rent_car == '') {
            error_mass.push('Введите HTML код для раздела "Аренда автомобиля"');
        }
    }

    if (!$("#default_img").prop("checked") && img_map_from_db == '' && img_marker_from_db == '') {
        var new_img_marker = $('#add_widget_form #new_img_marker').val();
        var new_img_map = $('#add_widget_form #new_img_map').val();

        if (new_img_marker == '') {
            error_mass.push('Выберите картинку маркера для виджета');
        }

        if (new_img_map == '') {
            error_mass.push('Выберите картинку карты для виджета');
        }
    }

    return error_mass;
}

function validate_login_form() {
    var error_mass = new Array();

    if ($('#login_form #email_user_login_form').val() == '') {
        error_mass[error_mass.length] = 'Заполните поле "Email"';
    }

    if ($('#login_form #pass_login_form').val() == '') {
        error_mass[error_mass.length] = 'Заполните поле "Пароль"';
    }

    if ($("#login_form #pass_login_form").val().length < 6 && $('#login_form #pass_login_form').val() != '') {
        error_mass[error_mass.length] = 'Длина не меньше 6 символов';
    }

    return error_mass;
}

function validate_edit_form() {
    var error_mass = new Array();

    var name = $('#edit_user_data_form #name_user').val();
    var last_name = $('#edit_user_data_form #last_name').val();
    var email_user = $('#edit_user_data_form #email_user').val();
    var pass = $("#edit_user_data_form #pass_user").val();
    var confirm_pass = $('#edit_user_data_form #confirm_pass_user').val();
    var phone = $('#edit_user_data_form #phone_user').val();

    if (name == '') {
        error_mass[error_mass.length] = 'Заполните поле "Имя"';
    }

    if (last_name == '') {
        error_mass[error_mass.length] = 'Заполните поле "Фамилия"';
    }

    if (email_user == '') {
        error_mass[error_mass.length] = 'Заполните поле "Email"';
    }

    if (pass.length < 6 && pass != '') {
        error_mass[error_mass.length] = 'Длина поля "Пароль" должна быть не меньше 6 символов';
    }

    if (pass != confirm_pass) {
        error_mass[error_mass.length] = 'Поля "Пароль" и "Подтвердить пароль" должны совпадать';
    }

    if (phone == '') {
        error_mass[error_mass.length] = 'Заполните поле "Телефон"';
    }

    if (phone.length < 11 && phone != '') {
        error_mass[error_mass.length] = 'Длина поля "Телефон" должна быть не меньше 11 символов';
    }

    return error_mass;
}
