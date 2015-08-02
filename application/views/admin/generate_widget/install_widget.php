<div class="component">
    <strong>Установка виджета для сайта: <?= $site_url ?></strong>
    <p>Для установки скрипта вставьте данные строчки между тегами HEAD на Вашем сайте.</p>
    <strong>
        <?php echo htmlspecialchars('<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>'); ?>
        <br>
        <?php echo htmlspecialchars('<script type="text/javascript" src="' . base_url() . 'widgets/widget_' . $id . '.js"></script>'); ?>
        <br>
        <?php echo htmlspecialchars('<script type="text/javascript">var conversioner_code="' . $code_widget . '";</script>'); ?>
    </strong>
    <br><br>
    <a href="<?= base_url('/admin/generate_widget/widgets'); ?>">
        Назад
    </a>
</div>