@include('admin.view.'. $module .'.partials._buttons', ['class' => 'buttons-top'])

<div class="row">
    <div class="col-md-12">
        <div class="card-body">
            <ul class="nav nav-tabs " id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" href="#tab_general" role="tab" aria-controls="tab_general" aria-selected="true">@lang('labels.tab_general')</a>
                </li>
            </ul>
            <div class="tab-content pt-4 pb-4 pl-2 pr-2">
                <div class="tab-pane fade active show" id="tab_general">
                    @include('admin.view.' . $module . '.tabs.general')
                </div>
            </div>

        </div>
    </div>
</div>

@include('admin.view.' . $module . '.partials._buttons')
