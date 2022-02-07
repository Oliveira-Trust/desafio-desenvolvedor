<!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-change-config">
    {{trans('config.btn_config_modal')}}
</button>

<!-- Modal -->
<div class="modal fade" id="modal-change-config" tabindex="-1" aria-labelledby="modal-change-config-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-change-config-label">{{trans('config.modal_title')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form id="form-change-config-fee" class="row">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{trans('config.form_label.fee_limit_level_one')}}</label>
                    <input type="text" class="form-control required" name="fee_limit_level_one" value="{{$config->fee_limit_level_one ?? ''}}">
                    <span class="text-sm">{{trans('config.span.info_label_number')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{trans('config.form_label.fee_level_one')}}</label>
                    <input type="text" class="form-control required" name="fee_level_one" value="{{$config->fee_level_one ?? ''}}">
                    <span class="text-sm">{{trans('config.span.info_label_number')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{trans('config.form_label.fee_level_two')}}</label>
                    <input type="text" class="form-control required" name="fee_level_two" value="{{$config->fee_level_two ?? ''}}">
                    <span class="text-sm">{{trans('config.span.info_label_number')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{trans('config.form_label.fee_limit_level_two')}}</label>
                    <input type="text" disabled class="form-control" value="{{$config->fee_limit_level_two ?? ''}}">
                    <span class="text-sm">{{trans('config.span.info_label_number')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{trans('config.form_label.min_value_convertion')}}</label>
                    <input type="text" class="form-control required" name="min_value_convertion" value="{{$config->min_value_convertion ?? ''}}">
                    <span class="text-sm">{{trans('config.span.info_label_number')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{trans('config.form_label.max_value_convertion')}}</label>
                    <input type="text" class="form-control required" name="max_value_convertion" value="{{$config->max_value_convertion ?? ''}}">
                    <span class="text-sm">{{trans('config.span.info_label_number')}}</span>
                </div>
                <div class="mb-3">
                    <label class="form-label">{{trans('config.form_label.active_currency')}}</label>
                    <input type="text" class="form-control disabled" disabled value="{{$config->active_currency ?? ''}}">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{trans('config.btn_cancel')}}</button>
            <button type="button" onclick="changeConfig()" class="btn btn-primary">{{trans('config.btn_save')}}</button>
        </div>
        </div>
    </div>
</div>

@push('js')
<script>
    function changeConfig() {
        let inputsOk = true
        $.each($('#form-change-config-fee .required'), (i, v) => {
            if(!$(v).val()) {
                alert('{{trans('config.frontend_info_inputs_required')}}')
                inputsOk = false
            }
        })

        if(!inputsOk) {
            return
        }

        $.ajaxSetup({
            headers: {
                'Authorization': 'Bearer {{ session('token_api')}}',
            }
        })

        $.post('{{route('api.config-fee')}}', {
            fee_limit_level_one: $('input[name=fee_limit_level_one]').val(),
            fee_level_one: $('input[name=fee_level_one]').val(),
            fee_level_two: $('input[name=fee_level_two]').val(),
            min_value_convertion: $('input[name=min_value_convertion]').val(),
            max_value_convertion: $('input[name=max_value_convertion]').val(),
        }).done((data) => {
            alert(data.message)
            if(data.status) {
                $('#modal-change-config').modal('hide')
            }
        }).fail((data) => {
            alert(data.responseJSON.message)
        })


    }
</script>
@endpush
