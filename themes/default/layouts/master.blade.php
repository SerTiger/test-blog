<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Meta::render() !!}
    {{--        <meta property="og:image" content="/themes/default/img/social.png">--}}
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
    <link rel="icon" href="/themes/default/img/favicon.png"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ mix('/themes/default/css/app.min.css') }}"/>
</head>
<body id="app">
<div class="loader">
    <div class="cubeWrap">
        <div class="cube">
            <div class="faces1"></div>
            <div class="faces2"></div>
        </div>
    </div>
</div>
<div>@include('partials.header')</div>

<div>@yield('content')</div>

<div>@include('partials.footer')</div>

<script type="text/javascript" src="{{ mix('/themes/default/js/vendor.min.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="{{ mix('/themes/default/js/app.min.js') }}"></script>
<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>
</html>
