@extends('layouts.auth')
@section('content')
    <section class="contributions">
        @if($contributions->isNotEmpty())
        <div class="contributions-wrap">
            <h1>My Contribution</h1>

            <form class="contributions-filter">
                <div class="contributions-filter-item">
                    <h3>Date</h3>
                    <label>
                        <input data-toggle="datepicker" name="start_date" type="text">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.5 8H13.5" stroke="#A6B0C3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 3.5L13.5 8L9 12.5" stroke="#A6B0C3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <input data-toggle="datepicker" name="end_date" type="text">
                    </label>
                </div>
                <div class="contributions-filter-item">
                    <h3>Status</h3>
                    <label>
                        <select class="selection" name="" id="">
                            <option value="qwerty">
                                All
                            </option>
                            <option value="qwerty">
                                Few
                            </option>
                            <option value="qwerty">
                                Some
                            </option>
                        </select>
                    </label>
                </div>
                <div class="contributions-filter-item">
                    <h3>Сurrency</h3>
                    <label>
                        <select class="selection" name="" id=""> data-toggle="datepicker" name=""
                            <option value="qwerty">
                                Matic
                            </option>
                            <option value="qwerty">
                                USDT
                            </option>
                            <option value="qwerty">
                                BTC
                            </option>
                        </select>
                    </label>
                </div>
            </form>
            <div class="contributions-wrapper">
                @foreach($contributions as $transaction)
                <div class="contributions-item">
                    <div class="contributions-item-wrap">
                        <div class="contributions-item-col">
                            <div class="contributions-item-title">
                                <h2>{{ $transaction->pool->title }}</h2>
                                <span class="tag">Life</span>
                            </div>
                            <div class="contributions-item-creator">
                                <span>By</span>
                                <div class="img-wrap">
                                    <img src="{{ $transaction->pool->company->logo }}" alt="">
                                </div>
                                <span>{{ $transaction->pool->company->name }}</span>
                            </div>
                        </div>
                        <div class="contributions-item-col">
                            <span>Contributed On</span>
                            <p>{{ $transaction->created_at ? $transaction->created_at->locale($CURRENT_LOCALE)->isoFormat('llll') : '-' }} </p>
                            <span>Block Time</span>
                            <p>{{ $transaction->updated_at ? $transaction->updated_at->locale($CURRENT_LOCALE)->isoFormat('llll') : '-' }} </p>
                        </div>
                        <div class="contributions-item-col">
                            <span>Contributed Amount</span>
                            <div class="contributions-item-status">
                                <p>{{ $transaction->amount }} {{ $transaction->currency }}</p>
                                <span class="status">{{ $transaction->getStringStatus() }}</span>
                            </div>
                            <span>Submitted Details</span>
                            @forelse($transaction->collect as $key => $details)
                                <a class="contact"
                                   @if($key=='email')href="mailto:{{$details}}"@endif
                                >{{ $key }}: {{ $details }}</a>
                            @empty
                            @endforelse
                        </div>
                        <div class="contributions-item-col">
                            <span>From</span>
                            <p>{{ $transaction->contributor_account }}</p>
                            <a class="link" href="/">View Transacton</a>
                        </div>
                    </div>
                    <a href="/" class="show">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.75 9L14.25 9" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 3.75L14.25 9L9 14.25" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @else
            <div class="pools-wrap">
                <div class="pools-wrapper">
                        <div class="pools-welcome">
                            <div class="img-wrap">
                                <img src="{{ asset('themes/default/img/empty-pool.png') }}">
                            </div>
                            <h2>Welcome to OXO Capital</h2>
                            <p>No pools found from</p>
                            <span>{{ $CURRENT_USER->address_masked }}</span>
                            <p>All pools that you have created, will appear here</p>
                        </div>
                    </div>
            </div>
        @endif
    </section>
@stop
