<div class="box-body">
    <template class="hidden" id="menu_row_template">
        <li class="dd-item dd3-item" data-id="$data_id" data-title="$data_title" data-type="$data_type" data-url="">
            <div class="dd-handle dd3-handle">Drag</div>
            <div class="dd3-content">
                $data_title - $data_type
                <a class="menu_edit" data-target="#menu_modal" data-toggle="modal" role="button"><i class="fa fa-pencil"></i></a>
                <a class="menu_trash" role="button"><i class="fa fa-trash"></i></a>
            </div>
        </li>
    </template>

    <div class="dd" id="nestable">
        <ol class="dd-list"></ol>
    </div>
</div>

<!-- Modal -->
<div aria-labelledby="menu_modal_label" class="modal fade" id="menu_modal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="menu_modal_label"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group menu_modal_url_row">
                    <label>@lang('validation.attributes.url')</label>
                    <input class="form-control" id="menu_modal_url" type="text" />
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
                <button class="btn btn-success" type="button">Save changes</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
    $('#nestable').nestable();

    $(document).on('click', '.menu_edit', function() {
        var dd_item = $(this).closest('.dd-item');

        $('#menu_modal_label').html(dd_item.attr('data-title'));
        dd_item.attr('data-type') == 'custom' ? $('.menu_modal_url_row').show() : $('.menu_modal_url_row').hide();
        $('#menu_modal_url').val(dd_item.attr('data-url'));
    });

    $(document).on('click', '.menu_trash', function() {
        $(this).closest('.dd-item').remove();
    });
    </script>
@endpush
