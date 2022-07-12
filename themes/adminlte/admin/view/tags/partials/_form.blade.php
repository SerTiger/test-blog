@include('admin.view.'. $module .'.partials._buttons', ['class' => 'buttons-top'])

<div class="row">
    <div class="col-md-12">
        <div class="card-body">
            <ul class="nav nav-tabs " id="custom-content-below-tab" role="tablist">
                @foreach (config('translatable.locales') as $key => $locale)
                    <li class="nav-item">
                        <a class="{{($key == 0)?'nav-link active':'nav-link'}}"
                           data-toggle="pill" href="#tab_{!! $locale !!}" role="tab" aria-controls="tab_{!! $locale !!}"
                           aria-selected="true">@lang('labels.tab_'.$locale)</a>
                    </li>
                @endforeach

                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tab_general" role="tab" aria-controls="tab_general" aria-selected="false">@lang('labels.tab_general')</a>
                </li>
            </ul>
            <div class="tab-content pt-4 pb-4 pl-2 pr-2">
                @foreach (config('translatable.locales') as $key => $locale)
                    <div class="tab-pane fade @if($key == 0)active show @endif" id="tab_{!! $locale !!}" role="tabpanel"
                         aria-labelledby="tab_{!! $locale !!}">
                        @include('admin.view.' . $module . '.tabs.locale', array('errors' => $errors , 'locale' => $locale))
                    </div>
                @endforeach
                <div class="tab-pane" id="tab_general">
                    @include('admin.view.' . $module . '.tabs.general')
                </div>
            </div>

        </div>
    </div>
</div>

@include('admin.view.' . $module . '.partials._buttons')
