@extends('layouts.master')
@section('content')
<section class="profile">
    <div class="profile-wrap">
        <h1>My Account</h1>
        <form class="profile-wrapper" autocomplete="off">
            <div class="profile-left">
                <h3>Main info</h3>
                <div class="profile-left-form">
                    <div class="img-wrap">
                        <input id="avatar" accept="image/*" name="avatar" type="file">
                        <label for="avatar">
                        </label>
                        <img id="ava" src="https://picsum.photos/100/100">
                    </div>
                    <div class="profile-left-form-wrap">
                        <div class="input-row">
                            <label>
                                <span>Name</span>
                                <input name="name" type="text">
                            </label>
                        </div>
                        <div class="input-row">
                            <label>
                                <span>Surname</span>
                                <input name="surname" type="text">
                            </label>
                        </div>
                        <div class="input-row">
                            <label>
                                <span>Birth date</span>
                                <input data-toggle="datepicker" name="date" type="text">
                            </label>
                        </div>
                        <div class="input-row">
                            <button class="btn-blue">
                                <span>Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile-right">
                <h3>Contact</h3>
                <div class="profile-right-form">
                    <div class="input-row">
                        <label>
                            <span>Email</span>
                            <input name="email" type="email">
                        </label>
                    </div>
                    <div class="input-row">
                        <label>
                            <span>Discord</span>
                            <input name="discord" type="text">
                        </label>
                    </div>
                    <div class="input-row">
                        <label>
                            <span>Telegram</span>
                            <input name="telegram" type="text">
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@stop
