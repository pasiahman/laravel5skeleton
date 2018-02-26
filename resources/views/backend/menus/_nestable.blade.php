<div class="box-body">
    <template class="hidden" id="menu_row_template">
        @component('backend/menus/_nestable_template', [
            'data_id' => '$data_id',
            'data_title' => '$data_title',
            'data_type' => '$data_type',
            'data_url' => '$data_url',
        ])

        @endcomponent
    </template>

    <div class="dd" id="nestable">
        <input name="termmetas[nestable]" type="hidden" value="{{ json_encode($term->getTermmetaNestable()) }}" />
        <ol class="dd-list">
            @php
            $nestable = $term->getTermmetaNestable();
            @endphp

            {!! $term->generateAsHtml($nestable) !!}
        </ol>
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
    $('#menu_form').submit(function () {
        var menu_nestable = $('#nestable').nestable('serialize');
        $('input[name="termmetas[nestable]"]').val(JSON.stringify(menu_nestable));
    });

    $('#nestable').nestable();

    $(document).on('click', '.menu_edit', function() {
        var dd_item = $(this).closest('.dd-item');

        $('#menu_modal_label').html(dd_item.attr('data-title'));
        dd_item.attr('data-type') == 'custom' ? $('.menu_modal_url_row').show() : $('.menu_modal_url_row').hide();
        $('#menu_modal_url').val(dd_item.attr('data-url'));
    });

    $(document).on('click', '.menu_trash', function() { $(this).closest('.dd-item').remove(); });
    </script>
@endpush
