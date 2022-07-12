@section('css')
    {{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />--}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="//gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="{{ asset('themes/admin/css/adminltev3.css') }}" rel="stylesheet" />
    <link href="{{ asset('themes/admin/css/custom.css') }}" rel="stylesheet" />
@endsection

@section('js')
    <script src="//gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="//cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="//cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('themes/admin/js/main.js') }}"></script>
{{--    <script>--}}
{{--        $('.ajax_ckeckbox').on('change',function(event){--}}
{{--            console.log(1);--}}
{{--            const field = $(this).data('field');--}}
{{--            const id = $(this).data('id');--}}
{{--            const _token = $(this).data('token');--}}
{{--            const value = ($(this).is(':checked')) ? 1 : 0;--}}
{{--            const url = $(this).data('url');--}}

{{--            $.ajax({--}}
{{--                type: "POST",--}}
{{--                url: url,--}}
{{--                data: {_token: _token, id: id, field: field, value: value},--}}
{{--                success: function(result){console.log('succsess')},--}}
{{--                error: function(result){ console.log('error')},--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection
