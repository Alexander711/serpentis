<div class="component">
    <div class="errors_add_widget" <?php if (isset($errors)) { ?>style="display: block;"<?php } ?>>
        <?php if (isset($errors)) { ?>
            <?php foreach ($errors as $error) { ?>
                <span><?= $error ?></span>
            <?php } ?>
        <?php } ?>
    </div>

    <?php
    if (isset($data_widget['id_site'])) {
        $action_url = base_url('/admin/generate_widget/add_widget/' . $data_widget['id_site']);
    } else {
        $action_url = base_url('/admin/generate_widget/add_widget');
    }
    ?>

    <form action="<?= $action_url ?>" method="post" id="add_widget_form" enctype="multipart/form-data">
        <p id="site_data" class="section_new_widget">
            Данные сайта
        </p>
        <div id="site_data_form">
            <label class="label" for="site_url"><span class="required">*</span>Ссылка на сайт</label>
            <input class="field_form" type="text" id="site_url" name="site_url" value="<?php if (isset($data_widget['site_url'])) { ?><?= $data_widget['site_url'] ?><?php } ?>"/>
        </div>
        <p id="way_priv_transport" class="section_new_widget">
            Добраться на авто
        </p>
        <div id="way_priv_transport_form" class="section_body_new_widget">
            <input type="hidden" name="id_priv_transport" value="<?php if (isset($data_widget['id_priv_transport'])) { ?><?= $data_widget['id_priv_transport'] ?><?php } ?>">
            <label class="label" for="html_priv_transport"><span class="required">*</span>HTML код</label>
            <textarea class="textarea" id="html_priv_transport" name="html_priv_transport" rows="10" cols="70"><?php if (isset($data_widget['html_priv_transport'])) { ?><?= $data_widget['html_priv_transport'] ?><?php } ?></textarea>
            <input type="checkbox" class="checkbox" name="turn_on_priv_transport" id="turn_on_priv_transport" value="1" <?php if (isset($data_widget['turn_on_priv_transport'])) { ?>checked<?php } ?>><label for="turn_on_priv_transport">Включить данный раздел</label>
        </div>
        <p id="way_pub_transport" class="section_new_widget">
            Добраться на общественном транспорте
        </p>
        <div id="way_pub_transport_form" class="section_body_new_widget">
            <input type="hidden" name="id_pub_transport" value="<?php if (isset($data_widget['id_pub_transport'])) { ?><?= $data_widget['id_pub_transport'] ?><?php } ?>">
            <label class="label" for="html_pub_transport"><span class="required">*</span>HTML код</label>
            <textarea class="textarea" id="html_pub_transport" name="html_pub_transport" rows="10" cols="70"><?php if (isset($data_widget['html_pub_transport'])) { ?><?= $data_widget['html_pub_transport'] ?><?php } ?></textarea>
            <input type="checkbox" class="checkbox" name="turn_on_pub_transport" id="turn_on_pub_transport" value="1" <?php if (isset($data_widget['turn_on_pub_transport'])) { ?>checked<?php } ?>> <label for="turn_on_pub_transport">Включить данный раздел</label>
        </div>
        <p id="taxi" class="section_new_widget">
            Заказать такси
        </p>
        <div id="taxi_form" class="section_body_new_widget">
            <input type="hidden" name="id_taxi" value="<?php if (isset($data_widget['id_taxi'])) { ?><?= $data_widget['id_taxi'] ?><?php } ?>">
            <label class="label" for="html_taxi"><span class="required">*</span>HTML код</label>
            <textarea class="textarea" id="html_taxi" name="html_taxi" rows="10" cols="70"><?php if (isset($data_widget['html_taxi'])) { ?><?= $data_widget['html_taxi'] ?><?php } ?></textarea>
            <input type="checkbox" class="checkbox" name="turn_on_taxi" id="turn_on_taxi" value="1" <?php if (isset($data_widget['turn_on_taxi'])) { ?>checked<?php } ?>> <label for="turn_on_taxi">Включить данный раздел</label>
        </div>
        <p id="rent_car" class="section_new_widget">
            Аренда автомобиля
        </p>
        <div id="rent_car_form" class="section_body_new_widget">
            <input type="hidden" name="id_rent_car" value="<?php if (isset($data_widget['id_rent_car'])) { ?><?= $data_widget['id_rent_car'] ?><?php } ?>">
            <label class="label" for="html_rent_car"><span class="required">*</span>HTML код</label>
            <textarea class="textarea" id="html_rent_car" name="html_rent_car" rows="10" cols="70"><?php if (isset($data_widget['html_rent_car'])) { ?><?= $data_widget['html_rent_car'] ?><?php } ?></textarea>
            <input type="checkbox" class="checkbox" name="turn_on_rent_car" id="turn_on_rent_car" value="1" <?php if (isset($data_widget['turn_on_rent_car'])) { ?>checked<?php } ?>> <label for="turn_on_rent_car">Включить данный раздел</label>
        </div>
        <p id="new_img" class="section_new_widget">
            Выбрать всплываюшую картинку
        </p>
        <div id="new_img_form" class="section_body_new_widget">
            <input type="hidden" name="type_img_from_db" id="type_img_from_db" value="<?php if (isset($data_widget['type_img_from_db'])) { ?><?= $data_widget['type_img_from_db'] ?><?php } ?>">
            <input type="hidden" name="img_marker_from_db" id="img_marker_from_db" value="<?php if (isset($data_widget['img_marker_from_db'])) { ?><?= $data_widget['img_marker_from_db'] ?><?php } ?>" >
            <input type="hidden" name="img_map_from_db" id="img_map_from_db" value="<?php if (isset($data_widget['img_map_from_db'])) { ?><?= $data_widget['img_map_from_db'] ?><?php } ?>" >
            <label class="label" for="new_img_marker"><span class="required">*</span>Картинка маркера</label>
            <input type="file" id="new_img_marker" name="new_img_marker" value=""/>
            <label class="label" for="new_img_map"><span class="required">*</span>Картинка карты</label>
            <input type="file" id="new_img_map" name="new_img_map" value=""/>
            
            <?php if (isset($data_widget['type_img_from_db']) && $data_widget['type_img_from_db'] == 'new') { ?>
                <p class="img_widget_from_db">Используется загруженная картинка!</p>
                <input type="checkbox" class="checkbox" name="default_img" id="default_img" value="1"> <label for="default_img">Использовать картинку по умолчанию</label>
            <?php } elseif (isset($data_widget['type_img_from_db']) && $data_widget['type_img_from_db'] == 'default') { ?>
                <p class="img_widget_from_db">Используется картинрка по умолчанию!</p>
                <input type="checkbox" class="checkbox" name="default_img" id="default_img" value="1"> <label for="default_img">Использовать картинку по умолчанию</label>
            <?php } else { ?>
                <input type="checkbox" class="checkbox" name="default_img" id="default_img" value="1" checked> <label for="default_img">Использовать картинку по умолчанию</label>
            <?php } ?>
        </div>
        <br>
        <input type="submit" class="btn" value="Отправить"> 

        <a href="<?= base_url('/admin/generate_widget/widgets'); ?>">
            Назад
        </a>
    </form>
</div>