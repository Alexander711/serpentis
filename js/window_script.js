$(function () {
    $('#menu_priv_transport').click(function () {
        $('#title_priv_transport').show();
        $('#title_pub_transport').hide();
        $('#title_taxi').hide();
        $('#title_rent_car').hide();

        $('#gelb_img_priv_transport').show();
        $('#white_img_priv_transport').hide();
        $('#gelb_img_pub_transport').hide();
        $('#white_img_pub_transport').show();
        $('#gelb_img_taxi').hide();
        $('#white_img_taxi').show();
        $('#gelb_img_rent_car').hide();
        $('#white_img_rent_car').show();

        $('#content_priv_transport').show();
        $('#content_pub_transport').hide();
        $('#content_taxi').hide();
        $('#content_rent_car').hide();

        $('.serpentis_taxi_form').hide();
        $('.serpentis_rent_car_form').hide();
    });

    $('#menu_pub_transport').click(function () {
        $('#title_priv_transport').hide();
        $('#title_pub_transport').show();
        $('#title_taxi').hide();
        $('#title_rent_car').hide();

        $('#gelb_img_priv_transport').hide();
        $('#white_img_priv_transport').show();
        $('#gelb_img_pub_transport').show();
        $('#white_img_pub_transport').hide();
        $('#gelb_img_taxi').hide();
        $('#white_img_taxi').show();
        $('#gelb_img_rent_car').hide();
        $('#white_img_rent_car').show();

        $('#content_priv_transport').hide();
        $('#content_pub_transport').show();
        $('#content_taxi').hide();
        $('#content_rent_car').hide();

        $('.serpentis_taxi_form').hide();
        $('.serpentis_rent_car_form').hide();
    });

    $('#menu_taxi').click(function () {
        $('#title_priv_transport').hide();
        $('#title_pub_transport').hide();
        $('#title_taxi').show();
        $('#title_rent_car').hide();

        $('#gelb_img_priv_transport').hide();
        $('#white_img_priv_transport').show();
        $('#gelb_img_pub_transport').hide();
        $('#white_img_pub_transport').show();
        $('#gelb_img_taxi').show();
        $('#white_img_taxi').hide();
        $('#gelb_img_rent_car').hide();
        $('#white_img_rent_car').show();

        $('#content_priv_transport').hide();
        $('#content_pub_transport').hide();
        $('#content_taxi').show();
        $('#content_rent_car').hide();

        $('.serpentis_taxi_form').show();
        $('.serpentis_rent_car_form').hide();
    });

    $('#menu_rent_car').click(function () {
        $('#title_priv_transport').hide();
        $('#title_pub_transport').hide();
        $('#title_taxi').hide();
        $('#title_rent_car').show();

        $('#gelb_img_priv_transport').hide();
        $('#white_img_priv_transport').show();
        $('#gelb_img_pub_transport').hide();
        $('#white_img_pub_transport').show();
        $('#gelb_img_taxi').hide();
        $('#white_img_taxi').show();
        $('#gelb_img_rent_car').show();
        $('#white_img_rent_car').hide();

        $('#content_priv_transport').hide();
        $('#content_pub_transport').hide();
        $('#content_taxi').hide();
        $('#content_rent_car').show();

        $('.serpentis_taxi_form').hide();
        $('.serpentis_rent_car_form').show();
    });

    $("#serpentis_taxi_form").submit(function (e) {
        e.preventDefault();

        var validate = validate_data_taxi_form();

        if (validate == 'ok') {
            $.post("/widget_window/order_taxi", $('#serpentis_taxi_form').serialize(), function (event) {
                $('#serpentis_taxi_form').trigger("reset");
                if (event == 'ok' || event == 'error_time') {
                    $('#serpentis_number_phone_taxi').attr("disabled", "disabled");
                    $(".serpentis_send_phone", '#serpentis_taxi_form').attr("disabled", "disabled");
                    $('#serpentis_number_phone_taxi').attr("placeholder", 'Ждите звонка!').css('border', "1px dotted #ccc");
                } else if (event == 'empty_data_input') {
                    $('#serpentis_number_phone_taxi').attr("placeholder", 'Заполните поле!').css('border', "1px solid red");
                } else if (event == 'incorrect_phone') {
                    $('#serpentis_number_phone_taxi').attr("placeholder", 'Неправильный номер!').css('border', "1px solid red");
                } else {
                    $('#serpentis_number_phone_taxi').attr("placeholder", 'Произошла ошибка! Повторите попытку позже').css('border', "1px solid red");
                }
            });
        } else if (validate == 'empty_phone') {
            $('#serpentis_taxi_form').trigger("reset");
            $('#serpentis_number_phone_taxi').attr("placeholder", 'Заполните поле!').css('border', "1px solid red");
        } else {
            $('#serpentis_taxi_form').trigger("reset");
            $('#serpentis_number_phone_taxi').attr("placeholder", 'Неправильный номер!').css('border', "1px solid red");
        }
    });

    $("#serpentis_rent_car_form").submit(function (e) {
        e.preventDefault();

        var validate = validate_data_rent_car_form();

        if (validate == 'ok') {
            $.post("/widget_window/rent_car", $('#serpentis_rent_car_form').serialize(), function (event) {
                $('#serpentis_rent_car_form').trigger("reset");
                if (event == 'ok' || event == 'error_time') {
                    $('#serpentis_number_phone_rent_car').attr("disabled", "disabled");
                    $(".serpentis_send_phone", '#serpentis_rent_car_form').attr("disabled", "disabled");
                    $('#serpentis_number_phone_rent_car').attr("placeholder", 'Ждите звонка!').css('border', "1px dotted #ccc");
                } else if (event == 'empty_data_input') {
                    $('#serpentis_number_phone_rent_car').attr("placeholder", 'Заполните поле!').css('border', "1px solid red");
                } else if (event == 'incorrect_phone') {
                    $('#serpentis_number_phone_rent_car').attr("placeholder", 'Неправильный номер!').css('border', "1px solid red");
                } else {
                    $('#serpentis_number_phone_rent_car').attr("placeholder", 'Произошла ошибка! Повторите попытку позже').css('border', "1px solid red");
                }
            });
        } else if (validate == 'empty_phone') {
            $('#serpentis_rent_car_form').trigger("reset");
            $('#serpentis_number_phone_rent_car').attr("placeholder", 'Заполните поле!').css('border', "1px solid red");
        } else {
            $('#serpentis_rent_car_form').trigger("reset");
            $('#serpentis_number_phone_rent_car').attr("placeholder", 'Неправильный номер!').css('border', "1px solid red");
        }
    });
});

function validate_data_taxi_form() {
    if ($('#serpentis_number_phone_taxi').val() == '') {
        return 'empty_phone';
    }
    if ($("input[name='email']", '#serpentis_taxi_form').val() != '') {
        return 'not_phone';
    }

    if ($("input[name='phone']", '#serpentis_taxi_form').val() != '') {
        return 'not_phone';
    }

    var regex = /^((\d|\+\d)[\- ]?)(\(?\d{3}\)?[\- ]?)[\d]{3}[\- ]?[\d]{2}[\- ]?[\d]{2}$/i;
    var is_phone = regex.exec($('#serpentis_number_phone_taxi').val());

    if (is_phone == null) {
        return 'not_phone';
    }

    return 'ok';
}

function validate_data_rent_car_form() {
    if ($('#serpentis_number_phone_rent_car').val() == '') {
        return 'empty_phone';
    }

    if ($("input[name='email']", '#serpentis_rent_car_form').val() != '') {
        return 'not_phone';
    }

    if ($("input[name='phone']", '#serpentis_rent_car_form').val() != '') {
        return 'not_phone';
    }

    var regex = /^((\d|\+\d)[\- ]?)(\(?\d{3}\)?[\- ]?)[\d]{3}[\- ]?[\d]{2}[\- ]?[\d]{2}$/i;
    var is_phone = regex.exec($('#serpentis_number_phone_rent_car').val());

    if (is_phone == null) {
        return 'not_phone';
    }

    return 'ok';
}