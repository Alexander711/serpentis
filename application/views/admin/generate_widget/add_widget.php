<div class="component">
    <div class="errors_add_widget"></div>

    <form action="<?= base_url('/admin/generate_widget/add_widget') ?>" method="post" id="add_widget_form">
        <p id="site_data" class="section_new_widget">
            Данные сайта
        </p>
        <div id="site_data_form">
            <label class="label" for="site_url"><span class="required">*</span>Ссылка на сайт</label>
            <input class="field_form" type="text" id="site_url" name="site_url" value=""/>
        </div>
        <p id="way_priv_transport" class="section_new_widget">
            Добраться на авто
        </p>
        <div id="way_priv_transport_form" class="section_body_new_widget">
            <label class="label" for="html_priv_transport"><span class="required">*</span>HTML код</label>
            <textarea class="textarea" id="html_priv_transport" name="html_priv_transport" rows="10" cols="70"></textarea>
            <input type="checkbox" class="checkbox" name="turn_on_priv_transport" id="turn_on_priv_transport" value="1"> <label for="turn_on_priv_transport">Включить данный раздел</label>
        </div>
        <p id="way_pub_transport" class="section_new_widget">
            Добраться на общественном транспорте
        </p>
        <div id="way_pub_transport_form" class="section_body_new_widget">
            <label class="label" for="html_pub_transport"><span class="required">*</span>HTML код</label>
            <textarea class="textarea" id="html_pub_transport" name="html_pub_transport" rows="10" cols="70"></textarea>
            <input type="checkbox" class="checkbox" name="turn_on_pub_transport" id="turn_on_pub_transport" value="1"> <label for="turn_on_pub_transport">Включить данный раздел</label>
        </div>
        <p id="taxi" class="section_new_widget">
            Заказать такси
        </p>
        <div id="taxi_form" class="section_body_new_widget">
            <label class="label" for="html_taxi"><span class="required">*</span>HTML код</label>
            <textarea class="textarea" id="html_taxi" name="html_taxi" rows="10" cols="70"></textarea>
            <input type="checkbox" class="checkbox" name="turn_on_taxi" id="turn_on_taxi" value="1"> <label for="turn_on_taxi">Включить данный раздел</label>
        </div>
        <p id="rent_car" class="section_new_widget">
            Аренда автомобиля
        </p>
        <div id="rent_car_form" class="section_body_new_widget">
            <label class="label" for="html_rent_car"><span class="required">*</span>HTML код</label>
            <textarea class="textarea" id="html_rent_car" name="html_rent_car" rows="10" cols="70"></textarea>
            <input type="checkbox" class="checkbox" name="turn_on_rent_car" id="turn_on_rent_car" value="1"> <label for="turn_on_rent_car">Включить данный раздел</label>
        </div>
        <p id="new_img" class="section_new_widget">
            Выбрать всплываюшую картинку
        </p>
        <div id="new_img_form" class="section_body_new_widget">
            <label class="label" for="new_img_marker"><span class="required">*</span>Картинка маркера</label>
            <input class="field_form" type="file" id="new_img_marker" name="new_img_marker" value=""/>
            <label class="label" for="new_img_map"><span class="required">*</span>Картинка карты</label>
            <input class="field_form" type="file" id="new_img_map" name="new_img_map" value=""/>
            <input type="checkbox" class="checkbox" name="default_img" id="default_img" value="1" checked> <label for="default_img">Использовать картинку по умолчанию</label>
        </div>
        <br>
        <input type="submit" class="btn" value="Отправить">
    </form>
</div>
<script type="text/javascript">

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
        });

        $("#add_widget_form").on('submit', function(e) {
            var error_mass = validate_add_widget_form();
            var error_mess = '';

            if (error_mass.length != 0) {
                e.preventDefault();

                for (i = 0; i < error_mass.length; i++) {
                    error_mess = error_mess + '<span>' + error_mass[i] + '</span><br/>'
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

            if (!$("#default_img").prop("checked")) {
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

</script>