
<div class="row">
    <div class="col-md-12">
        <div class="card-body">

            <ul class="nav nav-tabs " id="custom-content-below-tab" role="tablist">

                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tab_general" role="tab" aria-controls="tab_general" aria-selected="true">@lang('labels.tab_general')</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tab_addresses" role="tab" aria-controls="tab_categories" aria-selected="false">Адресы пользователя</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#tab_orders" role="tab" aria-controls="tab_categories" aria-selected="false">Заказы пользователя</a>
                </li>

            </ul>

            <div class="tab-content pt-4 pb-4 pl-2 pr-2">

                <div class="tab-pane fade active show " id="tab_general">
                    @include('admin.view.user.tabs.general')
                </div>

                <div class="tab-pane" id="tab_addresses">
                    @include('admin.view.user.tabs.addresses')
                </div>

                <div class="tab-pane" id="tab_orders">
                    @include('admin.view.user.tabs.orders')
                </div>

            </div>
        </div>
    </div>
</div>

