@extends('layouts.master')
@section('content')
    <section class="pool">
        <div class="pool-wrap">
            <div class="pool-container">
                <div class="pool-left">
                    <div class="pool-head">
                        <div class="pool-head-image">
                            <img src="https://picsum.photos/300/200" alt="">
                        </div>
                        <div class="pool-head-desc">
                            <div class="pool-head-desc-top">
                                <div class="pool-head-desc-left">
                                    <div class="pool-head-desc-left-title">
                                        <h1>Pool Name</h1>
                                        <div class="tag">Life</div>
                                    </div>
                                    <div class="pool-head-desc-left-creator">
                                        <span>By</span>
                                        <div class="img-wrap">
                                            <img src="https://picsum.photos/100/100" alt="">
                                        </div>
                                        <span>Company Name</span>
                                    </div>
                                </div>
                                <div class="pool-head-desc-right">
                                    <div class="timer">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 7.5V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M15.8971 14.25L12 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.73437 9.34814H2.98438V5.59814" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.16635 17.8336C7.32014 18.9874 8.79015 19.7732 10.3905 20.0915C11.9908 20.4098 13.6496 20.2464 15.1571 19.622C16.6646 18.9976 17.9531 17.9402 18.8596 16.5835C19.7661 15.2268 20.25 13.6317 20.25 12C20.25 10.3683 19.7661 8.77325 18.8596 7.41655C17.9531 6.05984 16.6646 5.00242 15.1571 4.378C13.6496 3.75357 11.9908 3.5902 10.3905 3.90853C8.79015 4.22685 7.32014 5.01259 6.16635 6.16637L2.98438 9.34835" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span>40 days 23:18:59</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pool-head-desc-bot">
                                <div class="pool-head-desc-bot-item-wrap">
                                    <div class="pool-head-desc-bot-item">
                                        <p>Total Pool Amount</p>
                                        <span>$100,000</span>
                                    </div>
                                    <div class="pool-head-desc-bot-item">
                                        <p>Contributions so far</p>
                                        <span>$ 800.01</span>
                                    </div>
                                </div>
                                <div class="pool-head-desc-bot-progress-wrap">
                                    <span>43%</span>
                                    <div class="pool-head-desc-bot-progress">
                                        <div class="line"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pool-users">
                        <div class="pool-users-head">
                            <h3>All Users</h3>
                        </div>
                        <div class="pool-users-body">
                            <div class="pool-users-body-col">
                                <h3>Accepted Size</h3>
                                <div class="size-item-wrapper">
                                    <div class="size-item-wrap">
                                        <div class="size-item">
                                            <span>Min: $10</span>
                                        </div>
                                    </div>
                                    <div class="size-item-wrap">
                                        <div class="size-item">
                                            <span>Max: $1000</span>
                                        </div>
                                    </div>
                                    <div class="size-item-wrap">
                                        <div class="size-item">
                                            <span>VC Fee: 1%</span>
                                        </div>
                                    </div>
                                </div>
                                <ul>
                                    <li>Alloweed in multiples of 10</li>
                                    <li>Only 360 transactions per user</li>
                                </ul>
                            </div>
                            <div class="pool-users-body-col">
                                <h3>Accepted Coins</h3>
                                <div class="coin-item-wrapper">
                                    <div class="coin-item-wrap">
                                        <div class="coin-item">
                                            <div class="img-wrap">
                                                <img src="https://picsum.photos/50/50" alt="">
                                            </div>
                                            <span>Bitcoin</span>
                                        </div>
                                    </div>
                                    <div class="coin-item-wrap">
                                        <div class="coin-item">
                                            <div class="img-wrap">
                                                <img src="https://picsum.photos/50/50" alt="">
                                            </div>
                                            <span>Etherium</span>
                                        </div>
                                    </div>
                                    <div class="size-item-wrap">
                                        <div class="coin-item">
                                            <div class="img-wrap">
                                                <img src="https://picsum.photos/50/50" alt="">
                                            </div>
                                            <span>Luna</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pool-users-body-col">
                                <h3>Timeline</h3>
                                <p>Started On: 15 Feb 2022 01:48 PM</p>
                                <p class="ended">Ends On: 1 May 2022 01:48 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pool-right">
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.68934 20.2499H4.5C4.30109 20.2499 4.11032 20.1709 3.96967 20.0302C3.82902 19.8896 3.75 19.6988 3.75 19.4999V15.3105C3.75 15.2121 3.7694 15.1145 3.80709 15.0235C3.84478 14.9325 3.90003 14.8499 3.96967 14.7802L15.2197 3.53022C15.3603 3.38956 15.5511 3.31055 15.75 3.31055C15.9489 3.31055 16.1397 3.38956 16.2803 3.53022L20.4697 7.71956C20.6103 7.86021 20.6893 8.05097 20.6893 8.24989C20.6893 8.4488 20.6103 8.63956 20.4697 8.78022L9.21967 20.0302C9.15003 20.0999 9.06735 20.1551 8.97635 20.1928C8.88536 20.2305 8.78783 20.2499 8.68934 20.2499Z" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.75 6L18 11.25" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.95125 20.2022L3.79688 15.0479" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Edit Pool</span>
                    </a>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.81836 15.1813L15.1823 8.81738" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.5909 16.7726L10.9392 19.4243C10.0953 20.268 8.95077 20.7419 7.75743 20.7418C6.56409 20.7417 5.41965 20.2676 4.57583 19.4238C3.73201 18.5799 3.25791 17.4355 3.25781 16.2422C3.25771 15.0488 3.73161 13.9043 4.57529 13.0603L7.22694 10.4087" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16.7722 13.5904L19.4238 10.9388C20.2675 10.0948 20.7414 8.95028 20.7413 7.75694C20.7412 6.5636 20.2671 5.41916 19.4233 4.57534C18.5795 3.73152 17.435 3.25743 16.2417 3.25732C15.0483 3.25722 13.9038 3.73112 13.0599 4.5748L10.4082 7.22645" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Copy Link</span>
                    </a>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" fill="#323546" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>View Contribution Page</span>
                    </a>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 23C17.5228 23 22 18.5228 22 13C22 7.47715 17.5228 3 12 3C6.47715 3 2 7.47715 2 13C2 18.5228 6.47715 23 12 23Z" stroke="#27B96A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.9065 12.1537C16.5293 12.546 16.5293 13.4538 15.9065 13.846L10.5329 17.2305C9.86702 17.6499 9 17.1714 9 16.3844L9 9.61538C9 8.82838 9.86702 8.3498 10.5329 8.76922L15.9065 12.1537Z" fill="#27B96A"/>
                        </svg>
                        <span>Start Pool</span>
                    </a>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 23C17.5228 23 22 18.5228 22 13C22 7.47715 17.5228 3 12 3C6.47715 3 2 7.47715 2 13C2 18.5228 6.47715 23 12 23Z" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <rect x="8" y="9" width="8" height="8" rx="1" fill="#FA4D4D"/>
                        </svg>
                        <span>Stop Pool</span>
                    </a>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 10L12 15L17 10" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 15L12 3" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M21 15L21 19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21L5 21C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19L3 15" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Download CSV</span>
                    </a>
                </div>
            </div>

        </div>
    </section>
@stop
