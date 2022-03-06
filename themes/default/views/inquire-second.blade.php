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
                            <div class="line full"></div>
                            <div class="dot active"></div>
                            <div class="line half"></div>
                            <div class="dot"></div>
                        </div>
                        <div class="invest-status-text">
                            <span class="active">Contact Details</span>
                            <span class="active">Project Details</span>
                            <span>Congrats</span>
                        </div>
                    </div>
                    <div class="invest-container">
                        <div class="contact-form-wrap">
                            <form class="contact-form" id="inquire_2" autocomplete="off" action="">
                                <div class="contact-form-container">
                                    <div class="input-row">
                                        <label>
                                            <span>Project Name</span>
                                            <input type="text" name="project_name">
                                        </label>
                                    </div>
                                    <div class="input-row">
                                        <label>
                                            <span>Web Site</span>
                                            <input type="text" name="site">
                                        </label>
                                    </div>
                                    <div class="connector">
                                        <div class="input-row">
                                            <label>
                                                <span>Telegram Channel</span>
                                                <input type="text" name="telegram_channel">
                                            </label>
                                        </div>
                                        <div class="input-row">
                                            <label>
                                                <span>Twitter</span>
                                                <input type="text" name="twitter">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-row">
                                        <label>
                                            <span>Other Social Media</span>
                                            <input type="text" name="other">
                                        </label>
                                    </div>
                                    <div class="input-row">
                                        <label>
                                            <span>Investment Round</span>
                                            <select name="round" class="select">
                                                <option value="1">Choose the right option</option>
                                                <option value="2">Choose the right option</option>
                                                <option value="3">Choose the right option</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="input-row">
                                        <label>
                                            <span>White Paper or PitchDeck</span>
                                            <input type="text" name="pitch">
                                        </label>
                                    </div>
                                    <div class="input-row">
                                        <label>
                                            <span>Additional Questions</span>
                                            <textarea name="message"></textarea>
                                        </label>
                                    </div>

                                    <div class="btn-wrap spaced">
                                        <a href="/inquire-first">
                                            <span>Back</span>
                                        </a>
                                        <button class="btn btn-blue" type="submit">
                                            <span>Send Form</span>
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
