@extends('layouts.master')
@section('content')

<section class="invest">
    <div class="invest-wrapper">
        <div class="container">
            <div class="invest-wrap">
                <div class="invest-head">
                    <h1>Invest with OXO</h1>
                    <span>/</span>
                    <a href="/inquire-first">Inquire investments in OXO</a>
                </div>
                <div class="invest-status">
                    <div class="invest-status-line">
                        <div class="dot active"></div>
                        <div class="line half"></div>
                        <div class="dot"></div>
                        <div class="line"></div>
                        <div class="dot"></div>
                    </div>
                    <div class="invest-status-text">
                        <span class="active">Contact Details</span>
                        <span>Investman Details</span>
                        <span>Congrats</span>
                    </div>
                </div>
                <div class="invest-container">
                    <div class="contact-form-wrap">
                        {{ Form::open(['route' => 'invest-second','class'=>"contact-form", 'id'=>"invest_1", 'autocomplete'=>"off"]) }}
                            <div class="contact-form-container">
                                <div class="input-row">
                                    <label>
                                        <span>Full Name</span>
                                        <input type="text" name="name">
                                    </label>
                                </div>
                                <div class="input-row">
                                    <label>
                                        <span>Email</span>
                                        <input type="email" name="email">
                                    </label>
                                </div>
                                <div class="connector">
                                    <div class="input-row">
                                        <label>
                                            <span>Phone</span>
                                            <input type="tel" name="phone">
                                        </label>
                                    </div>
                                    <div class="input-row">
                                        <label>
                                            <span>Telegram</span>
                                            <input type="text" name="telegram">
                                        </label>
                                    </div>
                                </div>
                                <div class="btn-wrap">
                                    <button class="btn btn-blue" type="submit">
                                        <span>Next Step</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
