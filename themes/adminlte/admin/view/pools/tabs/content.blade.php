<div><h1>{{__('admin_labels.content')}}</h1></div>
<div class="box-body table-responsive no-padding">
    <table class="table table-hover duplication"  style="table-layout:fixed;">
        <tbody>
        <tr>
            <th style="width: 15%;">{!! trans('admin_labels.image') !!}</th>
            <th style="width: 80%;">{!! trans('labels.content') !!}</th>
            <th style="width: 5%;">{!! trans('labels.delete') !!}</th>
        </tr>

        @if(isset($model) && !old())
            @if ($model->content)
                @foreach($model->content as $item)
                    <tr class=" duplication-row product-row">
                        <td>
                            <div class="form-group row" style="display: block">
                                <div class="form-group" id="image-setting">
                                    <label for="image" class="col-sm-2 control-label">
                                        {!! Form::label('image', trans('admin_labels.image'), array('class' => "control-label")) !!}
                                    </label>
                                    <div class="col-md-10" id="image-wrap">
                                        <img src="{{isset($item->image)?$item->image:asset('assets/vendor/MediaManager/noPreview.jpg')}}" id="preview" class="img-thumbnail mb-1 lg-1" data-default="{{asset('assets/vendor/MediaManager/noPreview.jpg')}}">

                                        <p>
                                            @if($item->id && $item->image !== NULL)
                                                <button type="button" id="removeImage" class="btn btn-warning btn-sm removeImage">{!! __('admin_labels.delete_image') !!}</button>
                                            @else
                                                <button type="button" id="removeImage" class="btn btn-warning btn-sm removeImage" hidden>{!! __('admin_labels.delete_image') !!}</button>
                                            @endif
                                        </p>
                                        <input class="isRemoveImage" type="text" id="isRemoveImage" name="contents[old][{{$item->id}}][isRemoveImage]" value="0" hidden>
                                        <label class="input-file__label" for="file-input[{{$item->id}}]">
                                            {{__('admin_labels.upload_file')}}
                                        </label>
                                        <input style="display: none" class="input-file" id="file-input[{{$item->id}}]" type="file" name="contents[old][{{$item->id}}][image]" accept="image/*">
                                    </div>
                                </div>
                                <div style="padding-top: 5px">
                                    <label>{{__('admin_labels.status')}}</label>
                                    <div class="form-group required">

                                        {!! Form::select("contents[old][$item->id][status]", array("1" => __('labels.status_on'), "0" => __('labels.status_off')), $item->status, array('class' => 'form-control input-sm')) !!}

                                        <label>{{__('admin_labels.position')}}</label>

                                        <input class="form-control" type="number"  min="0"  name="contents[old][{{$item->id}}][position]" value="{{$item->position}}">

                                        <label>{{__('admin_labels.is_quote')}}</label>

                                        {!! Form::select("contents[old][$item->id][is_quote]", array("1" => __('admin_labels.yes'), "0" => __('admin_labels.no')), $item->is_quote, array('class' => 'form-control input-sm')) !!}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group required" data-required="required">
                                <div class="">
                                    <div class="tabbable tabs-left">
                                        <div class="form-group" style="margin-top: 20px">
                                            <label for="url" class="col-sm-2 control-label">
                                                {!! Form::label('title_stile', __('admin_labels.title_stile'),array('class' => "control-label")) !!}
                                            </label>

                                            <div class="col-sm-12" style="padding: 0;">
                                                <div class="col-xs-1">
                                                    {!! Form::select("contents[old][$item->id][title_stile]", [], $item->title_stile, array('class' => 'form-control input-sm')) !!}
                                                </div>
                                                {!! $errors->first('contents[old]['.$item->id.'][title_stile]', '<span class="error">:message</span>') !!}
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            @foreach (config('translatable.locales') as $key => $locale)
                                                <li class="nav-item">
                                                    <a class="{{($key == 0)?'nav-link active':'nav-link'}}"
                                                                        href="#tab_content_{!! $locale !!}_old_{{$item->id}}"
                                                                        data-toggle="tab">
                                                        {{__('admin_labels.tab_'.$locale)}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="tab-content">
                                            @foreach (config('translatable.locales') as $key => $locale)
                                                <div class="tab-pane fade in @if ($key == 0) active show @endif"
                                                     id="tab_content_{!! $locale !!}_old_{{$item->id}}">
                                                    <div class="col-sm-12" style="padding: 0">
                                                        <label for="image" class="col-sm-2 control-label" style="padding-top:20px">
                                                            {!! Form::label('title', trans('admin_labels.title'), array('class' => "control-label")) !!}
                                                        </label>
                                                        {!! Form::text('contents[old]['.$item->id.'][' . $locale. '][title]', $item->translate($locale)->title, array('placeholder' => trans('admin_labels.title'), 'class' => 'form-control','rows' => '5')) !!}
                                                        {!! $errors->first('contents[old]['.$item->id.'][' . $locale. '][title]', '<span class="error">:message</span>') !!}
                                                    </div>
                                                    <div class="col-sm-12" style="padding: 0">
                                                        <label for="image" class="col-sm-2 control-label" style="padding-top:20px">
                                                            {!! Form::label('text', trans('admin_labels.text'), array('class' => "control-label")) !!}
                                                        </label>
                                                        {!! Form::textarea('contents[old]['.$item->id.'][' . $locale. '][content]', $item->translate($locale)->content, array('placeholder' => trans('admin_labels.text'), 'class' => 'form-control cloned-editor ckeditor','rows' => '5', 'id'=>"cloned-editor[$item->id][$locale]")) !!}
                                                        {!! $errors->first('contents[old]['.$item->id.'][' . $locale. '][content]', '<span class="error">:message</span>') !!}
                                                    </div>

                                                </div>
                                            @endforeach

                                            <div class="form-group" style="margin-top: 20px">
                                                <label for="url" class="col-sm-2 control-label">
                                                    {!! Form::label('video', __('admin_labels.video'),array('class' => "control-label")) !!}
                                                </label>

                                                <div class="col-sm-12" style="padding: 0;">
                                                    <div class="col-xs-1">
                                                        {!! Form::text('contents[old]['.$item->id.'][video]', $item->video, array('placeholder' => __('admin_labels.video'), 'class' => 'form-control','rows' => '5')) !!}
                                                    </div>
                                                    {!! $errors->first('contents[old]['.$item->id.'][video]', '<span class="error">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="width: 10%;" class="coll-actions text-center">
                            <a class="btn btn-flat btn-danger btn-xs action destroy"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
        @endif

        @if(old())
            @if(old('contents.old'))
                @foreach(old('contents.old') as $item_key => $item)
                    <tr class=" duplication-row product-row">
                        <td>
                            <div class="form-group row" style="display: block" id="image-setting">
                                <div class="col-md-10" id="image-wrap">
                                    <img src="{{asset('assets/vendor/MediaManager/noPreview.jpg')}}" id="preview" class="img-thumbnail mb-1 lg-1" data-default="{{asset('assets/vendor/MediaManager/noPreview.jpg')}}">

                                    <p>
                                        @if($item && isset($item['image']) && $item['image'] !== NULL)
                                            <button type="button" id="removeImage" class="btn btn-warning btn-sm removeImage">{!! __('admin_labels.delete_image') !!}</button>
                                        @else
                                            <button type="button" id="removeImage" class="btn btn-warning btn-sm removeImage" hidden>{!! __('admin_labels.delete_image') !!}</button>
                                        @endif
                                    </p>
                                    <input class="isRemoveImage" type="text" id="isRemoveImage" name="contents[old][{{$item_key}}][isRemoveImage]" value="0" hidden>
                                    <label class="input-file__label" for="file-input[{{$item_key}}]">
                                        {{__('admin_labels.upload_file')}}
                                    </label>
                                    <input style="display: none" class="input-file" id="file-input[{{$item_key}}]" type="file" name="contents[old][{{$item_key}}][image]" accept="image/*">
                                </div>
                                <div class="form-group" style="margin-top: 20px" id="image-placing" @if(!isset($item['image'])) hidden @endif>
                                    <label for="url" class="col-sm-2 control-label">
                                        {!! Form::label('image_placing', __('admin_labels.image_placing'),array('class' => "control-label")) !!}
                                    </label>

                                    <div class="col-sm-12" style="padding: 0;">
                                        <div class="col-xs-1">
                                            {!! Form::select("contents[old][$item_key][image_placing]", [], $item['image_placing'], array('class' => 'form-control input-sm')) !!}
                                        </div>
                                        {!! $errors->first('contents[old]['.$item_key.'][image_placing]', '<span class="error">:message</span>') !!}
                                    </div>
                                </div>
                                <div style="padding-top: 5px">
                                    <label>{{__('admin_labels.status')}}</label>
                                    <div class="form-group required">

                                        {!! Form::select("contents[old][$item_key][status]", array("1" => __('labels.status_on'), "0" => __('labels.status_off')), $item['status'], array('class' => 'form-control input-sm')) !!}

                                        <label>{{__('admin_labels.position')}}</label>

                                        <input class="form-control" type="number"  min="0"  name="contents[old][{{$item_key}}][position]" value="{{$item['position']}}">

                                        <label>{{__('admin_labels.is_quote')}}</label>

                                        {!! Form::select("contents[old][$item_key][is_quote]", array("1" => __('admin_labels.yes'), "0" => __('admin_labels.no')), $item['is_quote'], array('class' => 'form-control input-sm')) !!}

                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group required" data-required="required">
                                <div class="">
                                    <div class="tabbable tabs-left">
                                        <div class="form-group" style="margin-top: 20px">
                                            <label for="url" class="col-sm-2 control-label">
                                                {!! Form::label('title_stile', __('admin_labels.title_stile'),array('class' => "control-label")) !!}
                                            </label>

                                            <div class="col-sm-12" style="padding: 0;">
                                                <div class="col-xs-1">
                                                    {!! Form::select("contents[old][$item_key][title_stile]", [], $item['title_stile'], array('class' => 'form-control input-sm')) !!}
                                                </div>
                                                {!! $errors->first('contents[old]['.$item_key.'][title_stile]', '<span class="error">:message</span>') !!}
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs">
                                            @foreach (config('translatable.locales') as $key => $locale)
                                                <li class="nav-item">
                                                    <a class="{{($key == 0)?'nav-link active':'nav-link'}}"
                                                       href="#tab_content_{!! $locale !!}_old_{{$item_key}}"
                                                       data-toggle="tab">
                                                        {{__('admin_labels.tab_'.$locale)}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="tab-content">
                                            @foreach (config('translatable.locales') as $key => $locale)
                                                <div class="tab-pane fade in @if ($key == 0) active show @endif"
                                                     id="tab_content_{!! $locale !!}_old_{{$item_key}}">
                                                    <div class="col-sm-12" style="padding: 0">
                                                        <label for="image" class="col-sm-2 control-label" style="padding-top:20px">
                                                            {!! Form::label('title', trans('admin_labels.title'), array('class' => "control-label")) !!}
                                                        </label>
                                                        {!! Form::text('contents[old]['.$item_key.'][' . $locale. '][title]', $item[$locale]['title'], array('placeholder' => trans('admin_labels.title'), 'class' => 'form-control','rows' => '5')) !!}
                                                        {!! $errors->first('contents[old]['.$item_key.'][' . $locale. '][title]', '<span class="error">:message</span>') !!}
                                                    </div>
                                                    <div class="col-sm-12" style="padding: 0">
                                                        <label for="image" class="col-sm-2 control-label" style="padding-top:20px">
                                                            {!! Form::label('text', trans('admin_labels.text'), array('class' => "control-label")) !!}
                                                        </label>
                                                        {!! Form::textarea('contents[old]['.$item_key.'][' . $locale. '][content]', $item[$locale]['content'], array('placeholder' => trans('admin_labels.text'), 'class' => 'form-control cloned-editor ckeditor','rows' => '5', 'id'=>"cloned-editor[$item_key][$locale]")) !!}
                                                        {!! $errors->first('contents[old]['.$item_key.'][' . $locale. '][content]', '<span class="error">:message</span>') !!}
                                                    </div>

                                                </div>
                                            @endforeach

                                            <div class="form-group" style="margin-top: 20px">
                                                <label for="url" class="col-sm-2 control-label">
                                                    {!! Form::label('video', __('admin_labels.video'),array('class' => "control-label")) !!}
                                                </label>

                                                <div class="col-sm-12" style="padding: 0;">
                                                    <div class="col-xs-1">
                                                        {!! Form::text('contents[old]['.$item_key.'][video]', $item['video'], array('placeholder' => __('admin_labels.video'), 'class' => 'form-control','rows' => '5')) !!}
                                                    </div>
                                                    {!! $errors->first('contents[old]['.$item_key.'][video]', '<span class="error">:message</span>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="width: 10%;" class="coll-actions text-center">
                            <a class="btn btn-flat btn-danger btn-xs action destroy"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            @if(old('contents.new'))
                @foreach(old('contents.new') as $item_key => $item)
                    @if($item_key != 'replaseme')
                        <tr class="duplication-row">

                            <td>
                                <div class="form-group row" style="display: block" id="image-setting">
                                    <div class="col-md-10" id="image-wrap">
                                        <img src="{{asset('assets/vendor/MediaManager/noPreview.jpg')}}" id="preview" class="img-thumbnail mb-1 lg-1" data-default="{{asset('assets/vendor/MediaManager/noPreview.jpg')}}">
                                        <p>
                                            @if($item && isset($item['image']) && $item['image'] !== NULL)
                                                <button type="button" id="removeImage" class="btn btn-warning btn-sm removeImage">{!! __('admin_labels.delete_image') !!}</button>
                                            @else
                                                <button type="button" id="removeImage" class="btn btn-warning btn-sm removeImage" hidden>{!! __('admin_labels.delete_image') !!}</button>
                                            @endif
                                        </p>
                                        <input class="isRemoveImage" type="text" id="isRemoveImage" name="contents[new][{{$item_key}}][isRemoveImage]" value="0" hidden>
                                        <label class="input-file__label" for="file-input[{{$item_key}}]">
                                            {{__('admin_labels.upload_file')}}
                                        </label>
                                        <input style="display: none" class="input-file" id="file-input[{{$item_key}}]" type="file" name="contents[new][{{$item_key}}][image]" accept="image/*">
                                    </div>
                                    <div class="form-group" style="margin-top: 20px" id="image-placing" @if(!isset($item['image'])) hidden @endif>
                                        <label for="url" class="col-sm-2 control-label">
                                            {!! Form::label('image_placing', __('admin_labels.image_placing'),array('class' => "control-label")) !!}
                                        </label>

                                        <div class="col-sm-12" style="padding: 0;">
                                            <div class="col-xs-1">
                                                {!! Form::select("contents[new][$item_key][image_placing]", [], $item['image_placing'], array('class' => 'form-control input-sm')) !!}
                                            </div>
                                            {!! $errors->first('contents[new]['.$item_key.'][image_placing]', '<span class="error">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div style="padding-top: 20px">
                                        <label>{{__('admin_labels.status')}}</label>
                                        <div class="form-group required">
                                            {!! Form::select("contents[new][$item_key][status]", array("1" => __('labels.status_on'), "0" => __('labels.status_off')), $item['status'], array('class' => 'form-control input-sm')) !!}

                                            <label>{{__('admin_labels.position')}}</label>
                                            <input class="form-control" type="number"  min="0"  name="contents[new][{{$item_key}}][position]" value="{{$item['position']}}">

                                            <label>{{__('admin_labels.is_quote')}}</label>
                                            {!! Form::select("contents[new][$item_key][is_quote]", array("1" => __('admin_labels.yes'), "0" => __('admin_labels.no')), $item['is_quote'], array('class' => 'form-control input-sm')) !!}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group required" data-required="required">
                                    <div class="">
                                        <div class="tabbable tabs-left">
                                            <div class="form-group" style="margin-top: 20px">
                                                <label for="url" class="col-sm-2 control-label">
                                                    {!! Form::label('title_stile', __('admin_labels.title_stile'),array('class' => "control-label")) !!}
                                                </label>

                                                <div class="col-sm-12" style="padding: 0;">
                                                    <div class="col-xs-1">
                                                        {!! Form::select("contents[new][$item_key][title_stile]", [], $item['title_stile'], array('class' => 'form-control input-sm')) !!}
                                                    </div>
                                                    {!! $errors->first('contents[new]['.$item_key.'][title_stile]', '<span class="error">:message</span>') !!}
                                                </div>
                                            </div>
                                            <ul class="nav nav-tabs">
                                                @foreach (config('translatable.locales') as $key => $locale)
                                                    <li class="nav-item"><a class="{{($key == 0)?'nav-link active':'nav-link'}}"
                                                                            href="#tab_content_{!! $locale !!}_new_{{$item_key}}"
                                                                            data-toggle="tab">
                                                            {{__('admin_labels.tab_'.$locale)}}</a></li>
                                                @endforeach
                                            </ul>

                                            <div class="tab-content">
                                                @foreach (config('translatable.locales') as $key => $locale)
                                                    <div class="tab-pane fade in @if ($key == 0) active show @endif"
                                                         id="tab_content_{!! $locale !!}_new_{{$item_key}}">
                                                        <div class="col-sm-12" style="padding: 0">
                                                            <label for="image" class="col-sm-2 control-label" style="padding-top:20px">
                                                                {!! Form::label('title', trans('admin_labels.title'), array('class' => "control-label")) !!}
                                                            </label>
                                                            {!! Form::text('contents[new]['.$item_key.'][' . $locale. '][title]', $item[$locale]['title'], array('placeholder' => trans('admin_labels.title'), 'class' => 'form-control','rows' => '5')) !!}
                                                            {!! $errors->first('contents[new]['.$item_key.'][' . $locale. '][title]', '<span class="error">:message</span>') !!}
                                                        </div>
                                                        <div class="col-sm-12" style="padding: 0">
                                                            <label for="image" class="col-sm-2 control-label" style="padding-top:20px">
                                                                {!! Form::label('text', trans('admin_labels.text'), array('class' => "control-label")) !!}
                                                            </label>
                                                            {!! Form::textarea('contents[new]['.$item_key.'][' . $locale. '][content]', $item[$locale]['content'], array('placeholder' => trans('admin_labels.text'), 'class' => 'form-control cloned-editor ckeditor','rows' => '5', 'id'=>"cloned-editor[$item_key][$locale]")) !!}
                                                            {!! $errors->first('contents[new]['.$item_key.'][' . $locale. '][content]', '<span class="error">:message</span>') !!}
                                                        </div>

                                                    </div>
                                                @endforeach

                                                <div class="form-group" style="margin-top: 20px">
                                                    <label for="url" class="col-sm-2 control-label">
                                                        {!! Form::label('video', __('admin_labels.video'),array('class' => "control-label")) !!}
                                                    </label>

                                                    <div class="col-sm-12" style="padding: 0;">
                                                        <div class="col-xs-1">
                                                            {!! Form::text('contents[new]['.$item_key.'][video]', $item['video'], array('placeholder' => __('admin_labels.video'), 'class' => 'form-control','rows' => '5')) !!}
                                                        </div>
                                                        {!! $errors->first('contents[new]['.$item_key.'][video]', '<span class="error">:message</span>') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="coll-actions text-center">
                                <a class="btn btn-flat btn-danger btn-xs action destroy"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @endif
        @endif
        <tr class="duplication-button">
            <td colspan="6" class="text-center">
                <a title="@lang('labels.add_one_more')" class="btn btn-flat btn-primary btn-sm action create">
                    <i class="fas fa-plus"></i>
                </a>
            </td>
        </tr>

        <tr class="duplication-row duplicate">
            <td>
                <div class="form-group row" style="display: block" id="image-setting">
                    <div class="col-md-10" id="image-wrap">
                        <img src="{{asset('assets/vendor/MediaManager/noPreview.jpg')}}" id="preview" class="img-thumbnail mb-1 lg-1" data-default="{{asset('assets/vendor/MediaManager/noPreview.jpg')}}">

                        <p>
                            <button type="button" id="removeImage" class="btn btn-warning btn-sm removeImage" hidden>{!! __('admin_labels.delete_image') !!}</button>
                        </p>

                        <input class="isRemoveImage" type="text" id="isRemoveImage" name="contents[new][replaseme][isRemoveImage]" value="0" hidden>
                        <label class="input-file__label" for="file-input[replaseme]">
                            {{__('admin_labels.upload_file')}}
                        </label>
                        <input style="display: none" class="input-file" id="file-input[replaseme]" type="file" name="contents[new][replaseme][image]" accept="image/*">
                    </div>
                    <div class="form-group image-placing" style="margin-top: 20px" id="image-placing" hidden>
                        <label for="url" class="col-sm-2 control-label">
                            {!! Form::label('image_placing', __('admin_labels.image_placing'),array('class' => "control-label")) !!}
                        </label>

                        <div class="col-sm-12" style="padding: 0;">
                            <div class="col-xs-1">
                                {!! Form::select("contents[new][replaseme][image_placing]", [], null, array('class' => 'form-control input-sm', 'id' => 'place-select')) !!}
                            </div>
                            {!! $errors->first('contents[new][replaseme][image_placing]', '<span class="error">:message</span>') !!}
                        </div>
                    </div>
                    <div style="padding-top: 5px">
                        <label>{{__('admin_labels.status')}}</label>
                        <div class="form-group required">
                            <select class="form-control input-sm" data-required="required" aria-hidden="true" data-name="contents[new][replaseme][status]">
                                <option selected="selected" value="1">@lang('labels.status_on')</option>
                                <option value="0">@lang('labels.status_off')</option>
                            </select>
                            <label>{{__('admin_labels.position')}}</label>
                            <input class="form-control" type="number"  min="0"  name="contents[new][replaseme][position]">

                            <label>{{__('admin_labels.is_quote')}}</label>
                            <select class="form-control input-sm" data-required="required" aria-hidden="true" data-name="contents[new][replaseme][is_quote]">
                                <option value="1">@lang('admin_labels.yes')</option>
                                <option selected="selected" value="0">@lang('admin_labels.no')</option>
                            </select>
                        </div>
                    </div>
                </div>
            </td>
            <td>
                <div class="form-group required" data-required="required">
                    <div class="">
                        <div class="tabbable tabs-left">
                            <div class="form-group" style="margin-top: 20px">
                                <label for="url" class="col-sm-2 control-label">
                                    {!! Form::label('title_stile', __('admin_labels.title_stile'),array('class' => "control-label")) !!}
                                </label>

                                <div class="col-sm-12" style="padding: 0;">
                                    <div class="col-xs-1">
                                        {!! Form::select("contents[new][replaseme][title_stile]", [], null, array('class' => 'form-control input-sm')) !!}
                                    </div>
                                    {!! $errors->first('contents[new][replaseme][title_stile]', '<span class="error">:message</span>') !!}
                                </div>
                            </div>
                            <ul class="nav nav-tabs">
                                @foreach (config('translatable.locales') as $key => $locale)
                                    <li class="nav-item"><a class="{{($key == 0)?'nav-link active':'nav-link'}}"
                                                            href="#tab_content_{!! $locale !!}_new_replaseme"
                                                            data-toggle="tab">
                                            {{__('admin_labels.tab_'.$locale)}}</a></li>
                                @endforeach
                            </ul>

                            <div class="tab-content">
                                @foreach (config('translatable.locales') as $key => $locale)
                                    <div class="tab-pane fade in @if ($key == 0) active show @endif"
                                         id="tab_content_{!! $locale !!}_new_replaseme">
                                        <div class="col-sm-12" style="padding: 0">
                                            <label for="image" class="col-sm-2 control-label" style="padding-top:20px">
                                                {!! Form::label('title', trans('admin_labels.title'), array('class' => "control-label")) !!}
                                            </label>
                                            {!! Form::text('contents[new][replaseme][' . $locale. '][title]', null, array('placeholder' => trans('admin_labels.title'), 'class' => 'form-control','rows' => '5')) !!}
                                            {!! $errors->first('contents[new][replaseme][' . $locale. '][title]', '<span class="error">:message</span>') !!}
                                        </div>
                                        <div class="col-sm-12" style="padding: 0">
                                            <label for="image" class="col-sm-2 control-label" style="padding-top:20px">
                                                {!! Form::label('text', trans('admin_labels.text'), array('class' => "control-label")) !!}
                                            </label>
                                            {!! Form::textarea('contents[new][replaseme][' . $locale. '][content]', null, array('placeholder' => trans('admin_labels.text'), 'class' => 'form-control cloned-editor','rows' => '5', 'id'=>"cloned-editor[replaseme][$locale]")) !!}
                                            {!! $errors->first('contents[new][replaseme][' . $locale. '][content]', '<span class="error">:message</span>') !!}
                                        </div>

                                    </div>
                                @endforeach

                                    <div class="form-group" style="margin-top: 20px">
                                        <label for="url" class="col-sm-2 control-label">
                                            {!! Form::label('video', __('admin_labels.video'),array('class' => "control-label")) !!}
                                        </label>

                                        <div class="col-sm-12" style="padding: 0;">
                                            <div class="col-xs-1">
                                                {!! Form::text('contents[new][replaseme][video]', '', array('placeholder' => __('admin_labels.video'), 'class' => 'form-control','rows' => '5')) !!}
                                            </div>
                                            {!! $errors->first('contents[new][replaseme][video]', '<span class="error">:message</span>') !!}
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="coll-actions text-center">
                <a class="btn btn-flat btn-danger btn-xs action destroy"><i class="fas fa-times"></i></a>
            </td>
        </tr>

        </tbody>
    </table>
</div>
