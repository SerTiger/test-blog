@extends('layouts.master')
@section('content')
    <section class="await">
        <div class="await-container">
            <div class="await-icon active">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M33.3334 10L15.0001 28.3333L6.66675 20" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h2>Your contribution is awaiting confirmation from Blockchain. It will be auto-verified.</h2>
            <h3>In case if a speed-up transaction was made, please make to update the new hash</h3>
            <div class="await-top">
                <div class="await-top-head">
                    <span>Contributed Amount</span>
                    <p>0.02 BTC</p>
                </div>
                <div class="await-top-body">
                    <div class="await-top-body-from">
                        <span>From:</span>
                        <span>0x3e36...793c</span>
                    </div>
                    <span>15 Feb 2022  01:48 PM</span>
                </div>
            </div>
            <form class="await-bot">
                <h3>Update From for Name Pool</h3>
                <div class="input-row">
                    <label>
                        <span>Email ID*</span>
                        <input type="email">
                    </label>
                </div>
                <button class="btn-blue">
                    <span>Save details</span>
                </button>
            </form>
        </div>
    </section>
@stop
