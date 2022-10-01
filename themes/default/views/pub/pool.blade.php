@extends('layouts.auth')
@section('content')
    @php($currency_info = currency_info($pool->currency))
    <section class="pool">
        <div class="pool-wrap">
            <div class="pool-container">
                <div class="pool-left" {{--style="max-width:70%; width: calc(70% - 48px);"--}}>
                    <div class="pool-head">
                        <div class="pool-head-image">
                            @if($pool->image)<img src="{{ $pool->image }}" alt="{{ $pool->title }}">@endif
                        </div>
                        <div class="pool-head-desc">
                            <div class="pool-head-desc-top">
                                <div class="pool-head-desc-left">
                                    <div class="pool-head-desc-left-title">
                                        <h1>{{ $pool->title }}</h1>
                                        <div class="tag">New</div>
                                    </div>
                                    <div class="pool-head-desc-left-creator">
                                        <p>By</p>
                                        <div class="img-wrap">
                                            <img src="{{ $pool->company->logo }}" alt="{{ $pool->company->name }}">
                                        </div>
                                        <p>{{ $pool->company->name }}</p>
                                    </div>
                                </div>
                                <div class="pool-head-desc-right">
                                    <div class="timer">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 7.5V12" stroke="white" stroke-width="2" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                            <path d="M15.8971 14.25L12 12" stroke="white" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.73437 9.34814H2.98438V5.59814" stroke="white" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <path
                                                d="M6.16635 17.8336C7.32014 18.9874 8.79015 19.7732 10.3905 20.0915C11.9908 20.4098 13.6496 20.2464 15.1571 19.622C16.6646 18.9976 17.9531 17.9402 18.8596 16.5835C19.7661 15.2268 20.25 13.6317 20.25 12C20.25 10.3683 19.7661 8.77325 18.8596 7.41655C17.9531 6.05984 16.6646 5.00242 15.1571 4.378C13.6496 3.75357 11.9908 3.5902 10.3905 3.90853C8.79015 4.22685 7.32014 5.01259 6.16635 6.16637L2.98438 9.34835"
                                                stroke="white" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                        <span>{{ $pool->start_date->locale($CURRENT_LOCALE)->diffForHumans($pool->end_date,\Carbon\CarbonInterface::DIFF_ABSOLUTE) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pool-head-desc-bot">
                                <div class="pool-head-desc-bot-item-wrap">
                                    <div class="pool-head-desc-bot-item">
                                        <p>Total Pool Amount</p>
                                        <span>{{ $pool->amount }} {{  $currency_info['currency']['symbol'] }}</span>
                                    </div>
                                    <div class="pool-head-desc-bot-item">
                                        <p>Contributions so far</p>
                                        <span>{{ $pool->contributed }} {{  $currency_info['currency']['symbol'] }}</span>
                                    </div>
                                </div>
                                <div class="pool-head-desc-bot-progress-wrap">
                                    <span>{{$pool->progress}}%</span>
                                    <div class="pool-head-desc-bot-progress" >
                                        <div class="line" style="width:{{$pool->progress}}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($pool->rules as $rule)
                    <div class="pool-users">
                        <div class="pool-users-head">
                            <h3>{{ $rule['group'] }}</h3>
                        </div>
                        <div class="pool-users-body">
                            <div class="pool-users-body-col">
                                <h3>Accepted Size</h3>
                                <div class="size-item-wrapper">
                                    <div class="size-item-wrap">
                                        <div class="size-item">
                                            <span>Min: {{ $rule['min_single'] }}</span>
                                        </div>
                                    </div>
                                    <div class="size-item-wrap">
                                        <div class="size-item">
                                            <span>Max: {{ $rule['max_single'] }}</span>
                                        </div>
                                    </div>
                                    @if($rule['fee'])<div class="size-item-wrap">
                                        <div class="size-item">
                                            <span>VC Fee: {{ $rule['fee'] }}%</span>
                                        </div>
                                    </div>@endif
                                </div>
                                <ul>
                                    @if($rule['amount_multiples'])<li>Alloweed in multiples of {{ $rule['amount_multiples'] }}</li>@endif
                                    @if($rule['contribute_counter'])<li>Only {{ $rule['contribute_counter'] }} transactions per user</li>@endif
                                </ul>
                            </div>
                            <div class="pool-users-body-col">
                                <h3>Accepted Coins</h3>
                                <div class="coin-item-wrapper">
                                    @foreach($pool->supported as $coin)
                                    @php($coin_info = currency_info($coin))
                                    <div class="coin-item-wrap">
                                        <div class="coin-item">
                                            <div class="img-wrap">
                                                <img src="{{ currency_icon($coin_info['currency']['symbol'],50) }}" alt="{{ $coin_info['icon'] }}">
                                            </div>
                                            <span>{{ $coin_info['currency']['symbol'] }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="pool-users-body-col">
                                <h3>Timeline</h3>
                                <p>Started On: {{ $pool->start_date ? $pool->start_date->locale($CURRENT_LOCALE)->isoFormat('llll') : '-' }}</p>
                                <p class="ended">Ends On: {{ $pool->end_date ? $pool->end_date->locale($CURRENT_LOCALE)->isoFormat('llll') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pool-right" {{--style="width:30%"--}}>
                    @php($rule=$pool->rules[0])
                    {!! Form::open(['route'=>['pool.transaction.create',$pool->uuid],'class'=>'pool-right-pay pool-contribute']) !!}
                        @auth
                        <div class="pool-right-pay-head">
                            <p>Your wallet <span>{{ $CURRENT_USER->address_masked }}</span></p>
                            <div class="tag">{{ $CURRENT_WALLET->network }}</div>
                        </div>
                        @endauth
                        {{--<div class="pool-right-pay-head">
                            <p>Wallet Balance: <span class="blue">0.12 BTC</span></p>
                        </div>--}}
                        <div class="input-row">
                            <label>
                                <span>Choose coin</span>
                                <select name="currency" class="selection">
                                    @foreach($pool->supported as $coin)
                                        @php($coin_info = currency_info($coin))
                                        <option value="{{$coin}}" data-image="{{ currency_icon($coin_info['currency']['symbol']) }}">{{ $coin_info['currency']['symbol'] }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                        <div class="input-row">
                            <label>
                                <span>Contribution Amount</span>
                                <input type="number" name="amount" step="any">
                                @if($rule['amount_multiples'])<span>Amount accepted in multiples of {{ $rule['amount_multiples'] }}</span>@endif
                            </label>
                        </div>
                        <div class="pool-right-pay-connector">
                            <span>Min: {{ $rule['min_single'] }} {{ $currency_info['currency']['symbol'] }}</span>
                            <span>Max: {{ $rule['max_single'] }} {{ $currency_info['currency']['symbol'] }}</span>
                        </div>
                        <div class="check-row">
                            <input id="agree" type="checkbox" name="agree" required>
                            <label for="agree">
                                <span>I understand that I need to <span>comeback after the transaction to fill the remaining form</span>, only then the contribution will be considered.</span>
                            </label>
                        </div>
                        <div class="check-row">
                            <input id="agreement" type="checkbox" name="agreement" required>
                            <label for="agreement">
                                <span>I agree to the terms and conditions of <span>OXO</span></span>
                            </label>
                        </div>
                        <div class="btn-wrap">
                            @auth
                                <button class="btn-blue" type="submit"><span>Proceed Transaction</span></button>
                            @endauth
                            @guest
                                <metamask-auth link="{{ route('pool',$pool->uuid) }}">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.75 6V18C3.75 18.3978 3.90804 18.7794 4.18934 19.0607C4.47064 19.342 4.85218 19.5 5.25 19.5H20.25C20.4489 19.5 20.6397 19.421 20.7803 19.2803C20.921 19.1397 21 18.9489 21 18.75V8.25C21 8.05109 20.921 7.86032 20.7803 7.71967C20.6397 7.57902 20.4489 7.5 20.25 7.5H5.25C4.85218 7.5 4.47064 7.34196 4.18934 7.06066C3.90804 6.77936 3.75 6.39782 3.75 6ZM3.75 6C3.75 5.60218 3.90804 5.22064 4.18934 4.93934C4.47064 4.65804 4.85218 4.5 5.25 4.5H18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M16.875 14.625C17.4963 14.625 18 14.1213 18 13.5C18 12.8787 17.4963 12.375 16.875 12.375C16.2537 12.375 15.75 12.8787 15.75 13.5C15.75 14.1213 16.2537 14.625 16.875 14.625Z" fill="white"/>
                                    </svg>
                                    <span>Connect Wallet</span>
                                </metamask-auth>
                            @endguest
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="pool-container">
                <div class="pool-left" {{--style="max-width:70%; width: calc(70% - 48px);"--}}>
                    <div class="pool-more">
                        <div class="pool-more-head">
                            <h3>More info about this project</h3>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5V11H5C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13H11V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11H13V5Z"
                                    fill="#F8FAFD"/>
                            </svg>
                        </div>
                        <div class="pool-more-body">
                            {!! $pool->description !!}
                        </div>
                    </div>
                </div>
                <div class="pool-right" {{--style="width:30%"--}}>
                    <div class="pool-info" {{--style="width:100%"--}}>
                        <h3>Organization  info</h3>
                        <p>{!! $pool->company->description !!}</p>
                        <a href="{{ $pool->company->website }}" target="_blank">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.49287 3.93062L10.2672 2.15625C10.6333 1.7898 11.0681 1.49908 11.5465 1.30069C12.025 1.1023 12.5379 1.00012 13.0559 1C13.5739 0.99988 14.0868 1.10182 14.5654 1.29999C15.044 1.49816 15.4789 1.78868 15.8451 2.15495C16.2114 2.52122 16.5019 2.95607 16.7001 3.43466C16.8983 3.91324 17.0002 4.42618 17.0001 4.94416C17 5.46215 16.8978 5.97504 16.6994 6.45353C16.501 6.93202 16.2103 7.36674 15.8438 7.73284L13.309 10.2677C12.9428 10.6338 12.5081 10.9243 12.0297 11.1224C11.5513 11.3206 11.0386 11.4226 10.5207 11.4226C10.0029 11.4226 9.49012 11.3206 9.0117 11.1224C8.53329 10.9243 8.09859 10.6338 7.73242 10.2677" stroke="#58667E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.50721 14.0691L7.73284 15.8435C7.36674 16.2099 6.93202 16.5007 6.45353 16.6991C5.97504 16.8975 5.46215 16.9996 4.94416 16.9998C4.42618 16.9999 3.91324 16.8979 3.43466 16.6998C2.95607 16.5016 2.52122 16.2111 2.15495 15.8448C1.78868 15.4785 1.49816 15.0437 1.29999 14.5651C1.10182 14.0865 0.99988 13.5736 1 13.0556C1.00012 12.5376 1.1023 12.0247 1.30069 11.5462C1.49908 11.0677 1.7898 10.633 2.15625 10.2669L4.69106 7.7321C5.05723 7.36593 5.49193 7.07548 5.97034 6.87731C6.44876 6.67914 6.96152 6.57715 7.47936 6.57715C7.99719 6.57715 8.50996 6.67914 8.98837 6.87731C9.46679 7.07548 9.90149 7.36593 10.2677 7.7321" stroke="#58667E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>{{ $pool->company->website }}</span>
                        </a>
                        <a href="mailto:{{ $pool->company->email }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 5.25H21V18C21 18.1989 20.921 18.3897 20.7803 18.5303C20.6397 18.671 20.4489 18.75 20.25 18.75H3.75C3.55109 18.75 3.36032 18.671 3.21967 18.5303C3.07902 18.3897 3 18.1989 3 18V5.25Z" stroke="#58667E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 5.25L12 13.5L3 5.25" stroke="#58667E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>{{ $pool->company->email }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
