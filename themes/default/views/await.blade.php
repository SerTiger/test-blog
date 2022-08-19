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
        <div class="await-notification active">
            <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="35" cy="35" r="35" fill="#3F5B45"/>
                <circle cx="35" cy="35" r="27" fill="#699573"/>
                <path d="M44.1427 28.1426L31.5713 40.714L25.857 34.9997" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span>Contribution is updated</span>
            <div class="await-notification-close">
                <svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.239096 0.239096C0.557892 -0.0796988 1.07476 -0.0796988 1.39356 0.239096L7.7609 6.60644C8.0797 6.92524 8.0797 7.44211 7.7609 7.7609C7.44211 8.0797 6.92524 8.0797 6.60644 7.7609L0.239096 1.39356C-0.0796988 1.07476 -0.0796988 0.557892 0.239096 0.239096Z" fill="#A6B0C3"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.7609 0.239096C8.0797 0.557892 8.0797 1.07476 7.7609 1.39356L1.39356 7.7609C1.07476 8.0797 0.557892 8.0797 0.239096 7.7609C-0.0796988 7.44211 -0.0796988 6.92524 0.239096 6.60644L6.60644 0.239096C6.92524 -0.0796988 7.44211 -0.0796988 7.7609 0.239096Z" fill="#A6B0C3"/>
                </svg>
            </div>
        </div>
    </section>
@stop
