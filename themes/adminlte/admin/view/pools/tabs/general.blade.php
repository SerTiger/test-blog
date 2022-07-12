<div class="form-group">
    <label for="status" class="col-sm-2 control-label">
        {!! Form::label('category_id', __('admin_labels.category'), array('class' => "control-label")) !!}
    </label>

    <div class="col-sm-10">
        <div class="col-xs-2">
            {!! Form::select('category_id', $categories, $model->category_id, array('class' => 'form-control col-xs-1')) !!}
        </div>
        {!! $errors->first('category_id', '<span class="error">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    <label for="status" class="col-sm-2 control-label">
        {!! Form::label('owner_id', __('admin_labels.owner'), array('class' => "control-label")) !!}
    </label>

    <div class="col-sm-10">
        <div class="col-xs-2">
            {!! Form::select('owner_id', $users, $model->owner_id, array('class' => 'form-control col-xs-1')) !!}
        </div>
        {!! $errors->first('owner_id', '<span class="error">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    <label for="slug" class="col-sm-2 control-label">
        {!! Form::label('slug', __('admin_labels.slug'), array('class' => "control-label")) !!}
    </label>

    <div class="col-sm-10">
        <div class="col-xs-6">
            {!! Form::text('slug', $model->slug, array('placeholder' => __('admin_labels.slug'), 'class' => 'form-control input-sm slug_value')) !!}
        </div>
        {!! $errors->first('slug', '<span class="error">:message</span>') !!}
        <br>
        <p>
            <button type="button" class="btn btn-success btn-sm generate_slug">{!! __('admin_labels.buttons.generate') !!}</button><span class="generate_info" style=" color:red; padding-top: 4px; padding-left: 3px" hidden>{{trans('admin_labels.at_first_enter_the_data_in_the_title_field')}}</span>
        </p>
    </div>
</div>

<div class="form-group">
    <label for="status" class="col-sm-2 control-label">
        {!! Form::label('status', __('admin_labels.status'), array('class' => "control-label")) !!}
    </label>

    <div class="col-sm-10">
        <div class="col-xs-2">
            {!! Form::select('status', array("1" => __('admin_labels.visible'), "0" => __('admin_labels.no_visible')), $model->status, array('class' => 'form-control col-xs-1')) !!}
        </div>
        {!! $errors->first('status', '<span class="error">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    <label for="position" class="col-sm-2 control-label">
        {!! Form::label('position', __('admin_labels.position'),array('class' => "control-label")) !!}
    </label>

    <div class="col-sm-10">
        <div class="col-xs-1">
            {!! Form::number('position', $model->position, array('placeholder' => __('admin_labels.position'), 'class' => 'form-control input-sm')) !!}
        </div>
        {!! $errors->first('position', '<span class="error">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    <label for="image" class="col-sm-2 control-label">
        {!! Form::label('image', trans('admin_labels.image'), array('class' => "control-label")) !!}
    </label>
    <div class="col-xs-12 col-sm-7 col-md-10 col-lg-2" id="image-wrap">
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
</div>

<div class="form-group">
    <label for="publication_date" class="col-sm-2 control-label">
        {!! Form::label('publication_date', __('admin_labels.publication_date'), array('class' => "control-label")) !!}
    </label>
    <div class="col-sm-10">
        <div class="col-xs-6">
            <input id="datetime" type="datetime-local" @if($model->publication_date) value="{{date('Y-m-d\TH:i', strtotime($model->publication_date))}}" @endif name="publication_date" class ="form-control input-sm">
        </div>
        {!! $errors->first('publication_date', '<span class="error">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    <label for="url" class="col-sm-2 control-label">
        {!! Form::label('url', __('admin_labels.url'),array('class' => "control-label")) !!}
    </label>

    <div class="col-sm-10">
        <div class="col-xs-1">
            {!! Form::text('url', $model->url, array('placeholder' => __('admin_labels.url'), 'class' => 'form-control input-sm')) !!}
        </div>
        {!! $errors->first('url', '<span class="error">:message</span>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
    <label for="categories">{{__('admin_labels.tags')}}
        <span class="btn btn-info btn-xs select-all">{{__('admin_labels.select_all')}}</span>
        <span class="btn btn-info btn-xs deselect-all">{{__('admin_labels.deselect_all')}}</span></label>
    <select name="tags[]" id="tags" class="form-control select2" multiple="multiple">
        @foreach($tags as $id => $tags)

            <option value="{{ $id }}" {!! (in_array($id, old('tags', [])) || isset($model) && $model->tags->contains($id)) ? 'selected' : ''  !!}>
                {!! $tags !!}
            </option>
        @endforeach
    </select>
    @if($errors->has('tags'))
        <p class="help-block">
            {{ $errors->first('tags') }}
        </p>
    @endif
</div>


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
