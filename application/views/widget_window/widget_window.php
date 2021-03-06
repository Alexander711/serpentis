<!doctype html>
<html lang="en-us">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <link href='http://fonts.googleapis.com/css?family=Tinos&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="<?= base_url("css/style_window_widget.css"); ?>">
        <script type="text/javascript" src="<?= base_url('js/jquery-1.11.3.min.js'); ?>"></script>
        <script type="text/javascript" src="<?= base_url('js/window_script.js'); ?>"></script>
    </head>
    <body class="serpentis_widget_window_body">
        <div id="serpentis_widget_window">
            <div class="serpentis_title_window">
                <?php if (isset($html_priv_transport)) { ?>
                    <h2 id="title_priv_transport">
                        Как доехать на<br> личном автомобиле
                    </h2>
                <?php } ?>
                <?php if (isset($html_pub_transport)) { ?>
                    <h2 id="title_pub_transport" <?php if ($who_first != 'pub_transport') { ?>class="hide_titel_section"<?php } ?>>
                        Как доехать на<br> общественном транспорте
                    </h2>
                <?php } ?>
                <?php if (isset($html_taxi)) { ?>
                    <h2 id="title_taxi" <?php if ($who_first != 'taxi') { ?>class="hide_titel_section"<?php } ?>>
                        Сколько стоит<br> доехать на такси
                    </h2>
                <?php } ?>
                <?php if (isset($html_rent_car)) { ?>
                    <h2 id="title_rent_car"<?php if ($who_first != 'rent_car') { ?>class="hide_titel_section"<?php } ?>>
                        Сколько стоит<br> аренда авто
                    </h2>
                <?php } ?>
            </div>
            <div class="serpentis_menu_window">
                <?php if (isset($html_priv_transport)) { ?>
                    <a href="javascript:void(0);" id="menu_priv_transport">
                        <img id="gelb_img_priv_transport" <?php if ($who_first != 'priv_transport') { ?>class="hide_menu_section"<?php } ?> src="<?= base_url('images/gelb_car.svg'); ?>">
                        <img id="white_img_priv_transport" <?php if ($who_first == 'priv_transport') { ?>class="hide_menu_section"<?php } ?> src="<?= base_url('images/white_car.svg'); ?>">
                    </a>
                <?php } ?>

                <?php if (isset($html_pub_transport)) { ?>
                    <a href="javascript:void(0);" id="menu_pub_transport">
                        <img id="gelb_img_pub_transport" <?php if ($who_first != 'pub_transport') { ?>class="hide_menu_section"<?php } ?> src="<?= base_url('images/gelb_bus.svg'); ?>">
                        <img id="white_img_pub_transport" <?php if ($who_first == 'pub_transport') { ?>class="hide_menu_section"<?php } ?> src="<?= base_url('images/white_bus.svg'); ?>">
                    </a>
                <?php } ?>

                <?php if (isset($html_taxi)) { ?>
                    <a href="javascript:void(0);" id="menu_taxi">
                        <img id="gelb_img_taxi" <?php if ($who_first != 'taxi') { ?>class="hide_menu_section"<?php } ?> src="<?= base_url('images/gelb_car.svg'); ?>">
                        <img id="white_img_taxi" <?php if ($who_first == 'taxi') { ?>class="hide_menu_section"<?php } ?> src="<?= base_url('images/white_car.svg'); ?>">
                    </a>
                <?php } ?>

                <?php if (isset($html_rent_car)) { ?>
                    <a href="javascript:void(0);" id="menu_rent_car">
                        <img id="gelb_img_rent_car" <?php if ($who_first != 'rent_car') { ?>class="hide_menu_section"<?php } ?> src="<?= base_url('images/gelb_car.svg'); ?>">
                        <img id="white_img_rent_car" <?php if ($who_first == 'rent_car') { ?>class="hide_menu_section"<?php } ?> src="<?= base_url('images/white_car.svg'); ?>">
                    </a>
                <?php } ?>
            </div>
            <?php if (isset($html_priv_transport)) { ?>
                <div class="serpentis_content_priv_transport" id="content_priv_transport">
                    <?= $html_priv_transport ?>
                </div>
            <?php } ?>
            <?php if (isset($html_pub_transport)) { ?>
                <div class="serpentis_content_pub_transport <?php if ($who_first != 'pub_transport') { ?>hide_content_section<?php } ?>" id="content_pub_transport">
                    <?= $html_pub_transport ?>
                </div>
            <?php } ?>
            <?php if (isset($html_taxi)) { ?>
                <div class="serpentis_content_taxi <?php if ($who_first != 'taxi') { ?>hide_content_section<?php } ?>" id="content_taxi">
                    <?= $html_taxi ?>
                </div>
            <?php } ?>
            <?php if (isset($html_rent_car)) { ?>
                <div class="serpentis_content_rent_car <?php if ($who_first != 'rent_car') { ?>hide_content_section<?php } ?>" id="content_rent_car">
                    <?= $html_rent_car ?>
                </div>
            <?php } ?>
            <?php if (isset($html_taxi)) { ?>
                <div class="serpentis_taxi_form <?php if ($who_first != 'taxi') { ?>hide_form_taxi<?php } ?>">
                    <form id="serpentis_taxi_form" name="serpentis_taxi_form" method="post" autocomplete="off">
                        <input type="text" id="serpentis_number_phone_taxi" placeholder="Введите номер своего телефона" name="serpentis_number_phone_taxi">
                        <input type="hidden" name="serpentis_code" value="<?= $code_widget ?>">
                        <input type="hidden" name="email" value="">
                        <input type="hidden" name="phone" value="">
                        <button class="serpentis_send_phone">
                            Заказать такси
                        </button>
                    </form>
                </div>
            <?php } ?>

            <?php if (isset($html_rent_car)) { ?>
                <div class="serpentis_rent_car_form <?php if ($who_first != 'rent_car') { ?>hide_form_rent_car<?php } ?>">
                    <form id="serpentis_rent_car_form" name="serpentis_rent_car_form" method="post" autocomplete="off">
                        <input type="text" id="serpentis_number_phone_rent_car" placeholder="Введите номер своего телефона" name="serpentis_number_phone_rent_car">
                        <input type="hidden" name="serpentis_code" value="<?= $code_widget ?>">
                        <input type="hidden" name="email" value="">
                        <input type="hidden" name="phone" value="">
                        <button class="serpentis_send_phone">
                            Арендовать авто
                        </button>
                    </form>
                </div>
            <?php } ?>
            <div class="serpentis_copyright">
                Установите на ваш сайт виджет «<a href="http://serpentis.ru/widget" target="_blank">Как доехать?</a>»
            </div>
        </div>
    </body>
</html>