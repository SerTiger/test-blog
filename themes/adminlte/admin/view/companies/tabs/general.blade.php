<div class="form-group">
    <label for="slug" class="col-sm-2 control-label">
        {!! Form::label('name', __('admin_labels.name'),array('class' => "control-label")) !!}
    </label>

    <div class="col-sm-10">
        <div class="col-xs-1">
            {!! Form::text('name', $model->name, array('placeholder' => __('admin_labels.name'), 'class' => 'form-control input-sm')) !!}
        </div>
        {!! $errors->first('name', '<span class="error">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    <label for="slug" class="col-sm-2 control-label">
        {!! Form::label('owner', __('admin_labels.owner'),array('class' => "control-label")) !!}
    </label>

    <div class="col-sm-10">
        <div class="col-xs-1">
            {!! Form::text('owner_id', $model->owner_id, array('placeholder' => __('admin_labels.owner'), 'class' => 'form-control input-sm')) !!}
        </div>
        {!! $errors->first('owner_id', '<span class="error">:message</span>') !!}
    </div>
</div>

{{--<div class="form-group">
    <label for="image" class="col-sm-2 control-label">
        {!! Form::label('image', trans('admin_labels.image'), array('class' => "control-label")) !!}
    </label>
    <div class="col-xs-12 col-sm-7 col-md-10 col-lg-2">
        <img src="{{isset($model->image)?$model->image:asset('assets/vendor/MediaManager/noPreview.jpg')}}" id="preview" class="img-thumbnail mb-1 lg-1" data-default="{{asset('assets/vendor/MediaManager/noPreview.jpg')}}">

        <p>
            @if($model->id && $model->image !== NULL)
                <button type="button" id="removeImage" class="btn btn-warning btn-sm">{!! __('admin_labels.delete_image') !!}</button>
            @else
                <button type="button" id="removeImage" class="btn btn-warning btn-sm" hidden>{!! __('admin_labels.delete_image') !!}</button>
            @endif
        </p>
        <input class="hide" type="text" id="isRemoveImage" name="isRemoveImage" hidden value="0">

        <input class="input-file" id="input-file" type="file" name="image" accept="image/*" style="padding-bottom: 10px">
    </div>
</div>--}}

@section('js')

    <script>

        $(function () {

            $("#removeImage").on('click', function () {

                $("#isRemoveImage").attr('value', '1');
                $("#preview").attr('src',  $("#preview").attr('data-default'));
                $("#input-file").val('');
                $("#removeImage").attr('hidden', true);

            })

            $("#input-file").on('change', function () {

                $("#removeImage").attr('hidden', false);
            })

        })

    </script>

@endsection
