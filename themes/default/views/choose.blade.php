@extends('layouts.master')
@section('content')
    <section class="choose">
        <div class="choose-wrapper">
            <div class="container">
                <div class="choose-wrap">
                    <div class="choose-item-wrap">
                        <div class="choose-item">
                            <h2>Invest with OXO</h2>
                            @auth
                                <a href="/invest-first" class="btn-blue">
                                    <span>Invest</span>
                                </a>
                            @endauth
                            @guest
                                <metamask-sign
                                    :link="'/invest-first'"
                                >Invest</metamask-sign>
                            @endguest
                        </div>
                        <div class="choose-item">
                            <h2>Inquire investments in OXO</h2>
                            @auth
                                <a href="/inquire-first" class="btn-blue">
                                    <span>Inquiry</span>
                                </a>
                            @endauth
                            @guest
                                <metamask-sign
                                    :link="'/inquire-first'"
                                >Inquiry</metamask-sign>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
