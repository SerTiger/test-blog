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

<div class="form-group {{ $errors->has('categories') ? 'has-error' : '' }}">
    <label for="categories">{{__('admin_labels.categories')}}
        <span class="btn btn-info btn-xs select-all">{{__('admin_labels.select_all')}}</span>
        <span class="btn btn-info btn-xs deselect-all">{{__('admin_labels.deselect_all')}}</span></label>
    <select name="categories[]" id="categories" class="form-control select2" multiple="multiple">
        @foreach($categories as $id => $categories)

            <option value="{{ $id }}" {!! (in_array($id, old('categories', [])) || isset($model) && $model->categories->contains($id)) ? 'selected' : ''  !!}>
                {!! $categories !!}
            </option>
        @endforeach
    </select>
    @if($errors->has('categories'))
        <p class="help-block">
            {{ $errors->first('categories') }}
        </p>
    @endif
</div>
