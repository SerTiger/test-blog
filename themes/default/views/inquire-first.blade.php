@extends('layouts.master')
@section('content')

<section class="invest">
    <div class="invest-wrapper">
        <div class="container">
            <div class="invest-wrap">
                <div class="invest-head">
                    <a href="/invest-first">Invest with OXO</a>
                    <span>/</span>
                    <h1>Inquire investments in OXO</h1>
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
                        <span>Project Details</span>
                        <span>Congrats</span>
                    </div>
                </div>
                <div class="invest-container">
                    <div class="contact-form-wrap">
                        <form class="contact-form" id="inquire_1" autocomplete="off" action="">
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
                                <div class="input-row">
                                    <label>
                                        <span>Company Name</span>
                                        <input type="text" name="company">
                                    </label>
                                </div>
                                <div class="input-row">
                                    <label>
                                        <span>Your Position</span>
                                        <input type="text" name="position">
                                    </label>
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
