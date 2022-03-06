@extends('layouts.master')
@section('content')

    <section class="invest">
        <div class="invest-wrapper">
            <div class="container">
                <div class="invest-wrap">
                    <div class="invest-head">
                        <h1>Invest with OXO</h1>
                        <span>/</span>
                        <a href="/">Inquire investments in OXO</a>
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
                            <span class="active">Investman Details</span>
                            <span>Congrats</span>
                        </div>
                    </div>
                    <div class="invest-container">
                        <div class="contact-form-wrap">
                            <form class="contact-form" id="invest_1" autocomplete="off" action="">
                                <div class="contact-form-container">
                                    <div class="input-row">
                                        <label>
                                            <span>Investor Type</span>
                                            <select name="type" class="select">
                                                <option value="1">Choose Type</option>
                                                <option value="2">Choose Type</option>
                                                <option value="3">Choose Type</option>
                                                <option value="4">Choose Type</option>
                                                <option value="5">Choose Type</option>
                                                <option value="6">Choose Type</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="input-row">
                                        <label>
                                            <span>Your Capital</span>
                                            <select name="type" class="select">
                                                <option value="1">Choose the right option</option>
                                                <option value="2">Choose the right option</option>
                                                <option value="3">Choose the right option</option>
                                                <option value="4">Choose the right option</option>
                                                <option value="5">Choose the right option</option>
                                                <option value="6">Choose the right option</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="radio-row">
                                        <h3>Interested Areas</h3>
                                        <div class="radio-row-group">
                                            <label>
                                                <input type="checkbox" value="Web3" name="area">
                                                <span>Web3</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" value="DeFi" name="area">
                                                <span>DeFi</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" value="NFT" name="area">
                                                <span>NFT</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" value="Protocols" name="area">
                                                <span>Protocols</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" value="Metaverse" name="area">
                                                <span>Metaverse</span>
                                            </label>
                                            <label>
                                                <input type="checkbox" value="Gaming" name="area">
                                                <span>Gaming</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="input-row">
                                        <label>
                                            <span>Additional Questions</span>
                                            <textarea name="message"></textarea>
                                        </label>
                                    </div>

                                    <div class="btn-wrap">
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
