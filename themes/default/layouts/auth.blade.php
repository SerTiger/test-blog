@extends('layouts.master')

@section('main')
<div>@include('partials.header')</div>
<main>
    @include('partials.sidebar')
    <div class="main-view">
        @yield('content')
    </div>
</main>
@stop
