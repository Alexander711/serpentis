$(function () {
    var is_active = ;
    var max_z_index = 0;

    $('*').each(function () {
        var z_index = Number($(this).css('z-index'));
        if (z_index > max_z_index) {
            max_z_index = z_index;
        }
    })

    if(is_active == 1) {
        $('head').append('<link href=\"http://serpentis/css/style_window_widget.css\" type=\"text/css\" rel=\"stylesheet\" />');

        var iframe = '<div id=\"serpentis_widget_window_and_overlay\"> \
                        <div id=\"serpentis_widget_window_body\"> \
                           <div class=\"serpentis_close_widget_window\" onclick=\"serpentis_view_widget_window();\"></div> \
                           <iframe src=\"http://serpentis/widget_window/index" scrolling=\"no\" frameborder=\"no\"> \
                               Ваш браузер не поддерживает iframe! \
                           </iframe> \
                        </div> \
                        <div id=\"serpentis_popup_overlay\" class=\"serpentis_popup_overlay\" onclick=\"serpentis_view_widget_window();\"></div> \
                      </div>\
                      <div id=\"serpentis_attention_window\" onclick=\"serpentis_view_widget_window();\">\
                        <img id=\"serpentis_marker\" src=\"http://serpentis/uploads/img_attention_window\">\
                        <img src=\"http://serpentis/uploads/img_attention_window\">\
                      </div>';

        $('body').append(iframe);

        $('.serpentis_close_widget_window').css('z-index', max_z_index + 2);
        $('#serpentis_widget_window_body').css('z-index', max_z_index + 2);
        $('.serpentis_popup_overlay').css('z-index', max_z_index + 1);
    }
})

function serpentis_view_widget_window()
{
    $('#serpentis_widget_window_and_overlay').toggle();
    $('#serpentis_attention_window').toggle();
}