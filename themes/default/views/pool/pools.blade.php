@extends('layouts.auth')
@section('content')
    <section class="pools" id="pools">
        <div class="pools-wrap">
            {{--<div class="pools-wrapper">
                <div class="pools-welcome">
                    <div class="img-wrap">
                        <img src="themes/default/img/empty-pool.png">
                    </div>
                    <h2>Welcome to OXO Capital</h2>
                    <p>No contributions found from</p>
                    <span>0x17bb*****3412f</span>
                    <p>All pools that you have contributed, will appear here</p>
                </div>
            </div>--}}
            @if($pools && count($pools))
            <h1>Pools</h1>
            <h4>Manage your pools</h4>
            @foreach($pools as $pool)
            <div class="pools-wrapper">
                <a href="{{ route('pool.edit',$pool->uuid) }}" class="pools-item">
                    @php($currency_info = currency_info($pool->currency))
                    <div class="pools-item-image">
                        <div class="tag">
                            <span>New</span>
                        </div>
                        <img src="{{ $pool->image }}" alt="{{ $pool->title }}">
                    </div>
                    <div class="pools-item-desc">
                        <div class="pools-item-desc-top">
                            <div class="pools-item-desc-top-left">
                                <h2>{{ $pool->title }}</h2>
                                <div class="pools-item-desc-top-left-creator">
                                    <p>By</p>
                                    <div class="img-wrap">
                                        <img src="{{ $pool->company->logo }}" alt="{{ $pool->company->name }}">
                                    </div>
                                    <p>{{ $pool->company->name }}</p>
                                </div>
                                <div class="pools-item-desc-top-left-progress">
                                    <span>$<span class="progress-price" data-cap="{{ $pool->amount }}">0 {{$currency_info['currency']['symbol'] }}</span></span>
                                    <div class="pools-item-desc-top-left-progress-bar">
                                        <div class="line" style="width: 5%"></div>
                                    </div>
                                    <span class="progress-data">0%</span>
                                </div>
                            </div>
                            <div class="pools-item-desc-top-right">
                                <div class="timer">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 7.5V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M15.8971 14.25L12 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.73437 9.34814H2.98438V5.59814" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M6.16635 17.8336C7.32014 18.9874 8.79015 19.7732 10.3905 20.0915C11.9908 20.4098 13.6496 20.2464 15.1571 19.622C16.6646 18.9976 17.9531 17.9402 18.8596 16.5835C19.7661 15.2268 20.25 13.6317 20.25 12C20.25 10.3683 19.7661 8.77325 18.8596 7.41655C17.9531 6.05984 16.6646 5.00242 15.1571 4.378C13.6496 3.75357 11.9908 3.5902 10.3905 3.90853C8.79015 4.22685 7.32014 5.01259 6.16635 6.16637L2.98438 9.34835" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>{{ $pool->start_date->locale($CURRENT_LOCALE)->diffForHumans($pool->end_date,\Carbon\CarbonInterface::DIFF_ABSOLUTE) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="pools-item-desc-bot">
                            <div class="pools-item-desc-bot-left">
                                <div class="pools-item-desc-bot-left-item">
                                    <p>Pool Cap</p>
                                    <span>{{ $pool->amount }} {{ $currency_info['currency']['symbol']}}</span>
                                </div>
                                <div class="pools-item-desc-bot-left-item">
                                    <p>Contributed</p>
                                    <span>0</span>
                                </div>
                            </div>
                            <div class="pools-item-desc-bot-right">
                                <p>Started  On: {{  $pool->start_date->locale($CURRENT_LOCALE)->isoFormat('lll') }}</p>
                                <p class="end">Ends On: {{  $pool->end_date->locale($CURRENT_LOCALE)->isoFormat('lll') }}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            {{--<h4>March (1)</h4>--}}
            @else
            <h1>Pools</h1>
            <h4>Manage your pools</h4>
            <div class="pools-wrapper">
                <div class="none-pool">
                    <div class="none-pool-container">
                        <h2>No pools were found for</h2>
                        <h3>{{ $CURRENT_USER->address_masked }}</h3>
                        <p>Want to create one?</p>
                        <a href="{{ route('pool.create') }}" class="btn-blue">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="12" fill="white"/>
                                <rect x="11" y="6" width="2" height="12" rx="1" fill="#0187FF"/>
                                <rect x="18" y="11" width="2" height="12" rx="1" transform="rotate(90 18 11)" fill="#0187FF"/>
                            </svg>
                            <span>Create Pool</span>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
@stop
