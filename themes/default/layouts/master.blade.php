<!DOCTYPE html>
<html>
	<head>
        <title>OXO Capital</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="OXO Capital"/>
        <meta property="og:description" content="OXO Capital website"/>
{{--        <meta property="og:image" content="/themes/default/img/social.png">--}}
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1024">
        <meta property="og:image:height" content="1024">
        <link rel="icon" href="/themes/default/img/favicon.png"/>
        <link rel="stylesheet" href="{{ mix('/themes/default/css/app.min.css') }}"/>
	</head>
	<body>
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
		<script type="text/javascript" src="{{ mix('/themes/default/js/app.min.js') }}"></script>
	</body>
</html>
