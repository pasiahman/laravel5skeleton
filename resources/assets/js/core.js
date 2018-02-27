$(document).on('click', '.table_row_checkbox', function () {
    var checked = true;
    $('.table_row_checkbox').each(function () {
        var self = $(this);
        if (self.is(':checked')) { self.closest('tr').addClass('info'); }
        else { self.closest('tr').removeClass('info'); checked = false; }
        $('.table_row_checkbox_all').prop('checked', checked);
    });
});

$(document).on('click', '.table_row_checkbox_all', function () {
    var self = $(this);
    if (self.is(':checked')) { self.closest('table').find('tbody tr').addClass('info').find('.table_row_checkbox').prop('checked', true); }
    else { self.closest('table').find('tbody tr').removeClass('info').find('.table_row_checkbox').prop('checked', false); }
});

$(document).on('click', '.template_close', function () { $(this).closest('li').remove(); });
