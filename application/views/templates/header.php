<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <title><?php echo $title ?></title>
        <link href="<?= base_url("favicon.ico"); ?>" rel="shortcut icon">
        <link rel="stylesheet" type="text/css" href="<?= base_url("css/style.css"); ?>">
        <link href='http://fonts.googleapis.com/css?family=Tinos&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
        <?php if (isset($other_css)): ?>
            <?php foreach ($other_css as $filename): ?>
                <link rel="stylesheet" type="text/css" href="<?= base_url($filename); ?>">
            <?php endforeach; ?>
        <?php endif; ?>
        <script type="text/javascript" src="<?= base_url('js/jquery-1.11.3.min.js'); ?>"></script>
        <?php if (isset($other_js)): ?>
            <?php foreach ($other_js as $filename): ?>
                <script type="text/javascript" src="<?= base_url($filename); ?>"></script>
            <?php endforeach; ?>
        <?php endif; ?>
    </head>
    <body <?php if ($this->uri->segment(3) == 'login') { ?>class="login_page_body"<?php } ?>>
        <div class="container">
            <?php if ($this->uri->segment(3) != 'login') { ?>
                <header>
                    <?php if ($this->session->userdata('id_user')) { ?>
                        <div class="account_info_body">
                            <div class="account_info">
                                Здравствуйте, 
                                <a href="<?= base_url("admin/authorization/edit_user_data"); ?>" id='edit_user_data'>
                                    <span id="user_name_aut"><?php echo $this->session->userdata('name') . ' ' . $this->session->userdata('last_name') . '!'; ?></span>
                                </a>
                                <span id="user_email_aut"><?php echo '(' . $this->session->userdata('email') . ')' ?></span>
                                <a href="<?= base_url("admin/authorization/logout"); ?>">Выйти</a>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="title_and_menu">
                        <h1>«Конверсионер» &mdash; инструмент удержания клиентов.
                            <span>Установите «конвертик» на ваш веб-сайт и удерживайте до 75% больше клиентов.</span>
                        </h1>	
                        <nav class="main_menu">
                            <?php if ($this->uri->segment(3) == 'sms_history_list') { ?>
                                <span class="selected_menu">Собранные контакты</span>
                            <?php } else { ?>
                                <a href="<?= base_url("/admin/generate_widget/sms_history_list"); ?>">Собранные контакты</a>
                            <?php } ?>
                            <?php if (($this->uri->segment(3) == 'widgets') or ( $this->uri->segment(3) == 'add_widget')) { ?>
                                <span class="selected_menu">Мои «конвертики»</span>
                            <?php } else { ?>
                                <a href="<?= base_url("/admin/generate_widget/widgets"); ?>">Мои «конвертики»</a>
                            <?php } ?>
                        </nav>
                    </div>
                </header>
            <?php } ?>