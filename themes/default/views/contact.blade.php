@extends('layouts.master')
@include('partials.thanks')
@section('content')

    <section class="contact">
        <div class="contact-wrap">
            <div class="contact-container">
                <h1>
                    If you'd like to contact with us, feel free to send us <br> a message at
                    <a href="mailto:research@oxocapital.fund">research@oxocapital.fund</a><br>
                    or leave your request here below:
                </h1>
                <div class="contact-form-wrap">
                    <form class="contact-form" id="contact" autocomplete="off">
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
                            <div class="input-row">
                                <label>
                                    <span>Message</span>
                                    <textarea name="message"></textarea>
                                </label>
                            </div>
                            <div class="btn-wrap">
                                <button class="btn btn-blue">
                                    <span>Send</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
