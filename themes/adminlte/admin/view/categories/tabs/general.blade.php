<div class="form-group">
    <label for="slug" class="col-sm-2 control-label">
        {!! Form::label('slug', __('admin_labels.slug'),array('class' => "control-label")) !!}
    </label>

    <div class="col-sm-10">
        <div class="col-xs-1">
            {!! Form::text('slug', $model->slug, array('placeholder' => __('admin_labels.slug'), 'class' => 'form-control input-sm')) !!}
        </div>
        {!! $errors->first('slug', '<span class="error">:message</span>') !!}

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
            {!! Form::text('position', $model->position, array('placeholder' => __('admin_labels.position'), 'class' => 'form-control input-sm')) !!}
        </div>
        {!! $errors->first('position', '<span class="error">:message</span>') !!}
    </div>
</div>
