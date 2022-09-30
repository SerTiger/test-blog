@extends('layouts.auth')
@section('content')
<section class="profile">
    <div class="profile-wrap">
        <h1>My Account</h1>
        {!! Form::open(['route'=>'account.update', 'class'=>"profile-wrapper", 'files' => true]) !!}
            <div class="profile-left">
                <h3>Main info</h3>
                <div class="profile-left-form">
                    <div class="img-wrap">
                        <input id="avatar" accept="image/*" name="avatar" type="file">
                        <label for="avatar">
                        </label>
                        <img id="ava" src="{{ $CURRENT_USER->avatar }}">
                    </div>
                    <div class="profile-left-form-wrap">
                        <div class="input-row">
                            <label>
                                <span>Name</span>
                                <input name="name" type="text" value="{{ $CURRENT_USER->name }}">
                            </label>
                        </div>
                        <div class="input-row">
                            <label>
                                <span>Surname</span>
                                <input name="surname" type="text" value="{{ $CURRENT_USER->surname }}">
                            </label>
                        </div>
                        <div class="input-row">
                            <label>
                                <span>Birth date</span>
                                <input data-toggle="datepicker" name="birthday" type="text" value="{{ $CURRENT_USER->birthday ? $CURRENT_USER->birthday->locale($CURRENT_LOCALE)->toDateString() : '' }}">
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
                            <input name="contacts[email]" type="email" value="{{ $CURRENT_USER->contacts['email'] ?? '' }}">
                        </label>
                    </div>
                    <div class="input-row">
                        <label>
                            <span>Discord</span>
                            <input name="contacts[discord]" type="text" value="{{ $CURRENT_USER->contacts['discord'] ?? '' }}">
                        </label>
                    </div>
                    <div class="input-row">
                        <label>
                            <span>Telegram</span>
                            <input name="contacts[telegram]" type="text" value="{{ $CURRENT_USER->contacts['telegram'] ?? '' }}">
                        </label>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
</div>
</section>
@stop
