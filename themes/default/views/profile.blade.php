@extends('layouts.master')
@section('content')
<section class="profile">
    <div class="profile-wrap">
        <h1>My Account</h1>
        <div class="profile-wrapper">
            <div class="profile-left">
                <h3>Main info</h3>
                <form class="profile-left-form">
                    <div class="img-wrap">
                        <img src="https://picsum.photos/100/100">
                    </div>
                    <div class="profile-left-form-wrap">
                        <div class="input-row">
                            <label>
                                <span>Name</span>
                                <input type="text">
                            </label>
                        </div>
                        <div class="input-row">
                            <label>
                                <span>Surname</span>
                                <input type="text">
                            </label>
                        </div>
                        <div class="input-row">
                            <label>
                                <span>Birth date</span>
                                <input type="text">
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="profile-right">
                <h3>Contact</h3>
                <div class="profile-right-form">
                    <div class="input-row">
                        <label>
                            <span>Email</span>
                            <input type="text">
                        </label>
                    </div>
                    <div class="input-row">
                        <label>
                            <span>Discord</span>
                            <input type="text">
                        </label>
                    </div>
                    <div class="input-row">
                        <label>
                            <span>Telegram</span>
                            <input type="text">
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
