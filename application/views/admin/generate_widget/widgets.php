<div class="component">
    <h2>+ <a href="<?= base_url('/admin/generate_widget/add_widget') ?>">Добавить "Конвертик"</a></h2>
    <div class="table_body">
        <div class="add_widget_success"></div>
        <table>
            <thead>
                <tr>
                    <th>Веб-сайт</th>
                    <th>Состояние</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="widgets_list">
                <?php if (!empty($all_widgets)) { ?>
                    <?php foreach ($all_widgets as $row): ?>
                        <tr id="widget_row_<?= $row['id'] ?>">
                            <td><?= $row['site_url']; ?></td>
                            <td>
                                <a href="javascript:void(0);" id="not_activated_<?= $row['id'] ?>" class='active_status <?php if ($row['is_active'] == 0) { ?> active_status_hide <?php } ?>' data-active_status='0' data-id="<?= $row['id'] ?>">
                                    Отключить
                                </a>
                                <a href="javascript:void(0);" id="activated_<?= $row['id'] ?>" class='active_status <?php if ($row['is_active'] != 0) { ?> active_status_hide <?php } ?>' data-active_status='1' data-id="<?= $row['id'] ?>">
                                    Включить
                                </a>
                            </td>
                            <td>
                                <a class="installation_check" id="installation_check_<?= $row['id'] ?>" data-id="<?= $row['id'] ?>" href="javascript:void(0);">
                                    <?php if ($row['is_installed'] != 0) { ?>
                                        <img src="<?= base_url('images/icon_ok_green.png'); ?>" title='Проверить установку виджета(Виджет установлен)'>
                                    <?php } else { ?>
                                        <img src="<?= base_url('images/gearblue.png'); ?>" title='Проверить установку виджета(Виджет не установлен)'>
                                    <?php } ?>
                                </a>
                                <a href="<?= base_url('/admin/generate_widget/install_widget/'.$row['id']); ?>">
                                    <img src="<?= base_url('images/install_widget.png'); ?>" title="Редактировать">
                                </a>
                                <a href="<?= base_url('/admin/generate_widget/add_widget/'.$row['id']); ?>">
                                    <img src="<?= base_url('images/edit.png'); ?>" title="Редактировать">
                                </a>
                                <a class="delete_widget" data-id="<?= $row['id'] ?>" href="javascript:void(0);">
                                    <img src="<?= base_url('images/delete.png'); ?>" title="Удалить">
                                </a>
                            </td>
                        <?php endforeach ?>
                    <?php } else { ?>
                    <tr class="empty_list">
                        <td colspan="5" style="text-align: center;">
                            "Конвертиков" нет
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>