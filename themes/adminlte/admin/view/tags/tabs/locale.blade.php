<div class="form-group">
    <label for="{!! $locale . '[title]' !!}" class="col-sm-2 control-label">
        {!! Form::label($locale.'[title]', __('admin_labels.title'), array('class' => "control-label")) !!}
    </label>

    <div class="col-xs-6">
        {!! Form::text($locale.'[title]', isset($model->translate($locale)->title) ? $model->translate($locale)->title : '', array('placeholder' => __('admin_labels.title'), 'class' => 'form-control input-sm name_'.$locale)) !!}
        {!! $errors->first($locale.'.title', '<span class="error">:message</span>') !!}
    </div>
</div>

<div class="form-group">
    <label for="{!! $locale . '[description]' !!}" class="col-sm-2 control-label">
        {!! Form::label($locale.'[description]', __('admin_labels.description'), array('class' => "control-label")) !!}
    </label>

    <div class="col-xs-6">
        {!! Form::textarea( $locale.'[description]', isset($model->translate($locale)->description) ? $model->translate($locale)->description : '', array('placeholder' => __('admin_labels.description'), 'class' => 'form-control ckeditor', 'rows' => '5')) !!}
        {!! $errors->first($locale.'.description', '<span class="error">:message</span>') !!}
    </div>
</div>