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
    });

    $('#default_img').change(function () {
        $(".img_widget_from_db").hide();

        $("#img_marker_from_db").val('');
        $("#img_map_from_db").val('');
    });

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
});
