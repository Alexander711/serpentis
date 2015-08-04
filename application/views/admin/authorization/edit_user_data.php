<div class="component">
    <div class="errors_edit_user"></div>

    <form action="" method="post" id="edit_user_data_form">
        <label class="label" for="name_user"><span class="required">*</span>Имя</label>
        <input class="field_form" name="name" id="name_user" value="<?php if(isset($data_user['name'])){echo $data_user['name'];} ?>"/>
        <label class="label" for="last_name"><span class="required">*</span>Фамилия</label>
        <input class="field_form" name="last_name" id="last_name" value="<?php if(isset($data_user['last_name'])){echo $data_user['last_name'];} ?>"/>
        <label class="label" for="email_user"><span class="required">*</span>Email</label>
        <input class="field_form" name="email_user" id="email_user" value="<?php if(isset($data_user['email'])){echo $data_user['email'];} ?>"/>
        <label class="label" for="pass_user">Пароль</label>
        <input class="field_form" name="pass" id="pass_user" type="password" value=""/>
        <label class="label" for="confirm_pass_user">Подтвердить пароль</label>
        <input class="field_form" name="confirm_pass" id="confirm_pass_user" type="password" value=""/>
        <label class="label" for="phone_user"><span class="required">*</span>Телефон</label>
        <input class="field_form" name="phone" id="phone_user" value="<?php if(isset($data_user['phone'])){echo $data_user['phone'];} ?>"/>
        <br/><br/>
        <input type="submit" class="btn" value="Отправить">
    </form>
</div>

<script>
    
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
    
</script>