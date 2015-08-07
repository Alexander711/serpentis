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
        
        <a href="<?= base_url('/admin/generate_widget/widgets'); ?>" class="link_back">
            Назад
        </a>
    </form>
</div>