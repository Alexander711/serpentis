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
                <div class="serpentis_content_window" id="content_priv_transport">
                    <?= $html_priv_transport ?>
                </div>
            <?php } ?>
            <?php if (isset($html_pub_transport)) { ?>
                <div class="serpentis_content_window <?php if ($who_first != 'pub_transport') { ?>hide_section<?php } ?>" id="content_pub_transport">
                    <?= $html_pub_transport ?>
                </div>
            <?php } ?>
            <?php if (isset($html_taxi)) { ?>
                <div class="serpentis_content_window <?php if ($who_first != 'taxi') { ?>hide_section<?php } ?>" id="content_taxi">
                    <?= $html_taxi ?>
                </div>
            <?php } ?>
            <?php if (isset($html_rent_car)) { ?>
                <div class="serpentis_content_window <?php if ($who_first != 'rent_car') { ?>hide_section<?php } ?>" id="content_rent_car">
                    <?= $html_rent_car ?>
                </div>
            <?php } ?>
        </div>

        <script type="text/javascript">
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
                });
            });
        </script>
    </body>
</html>