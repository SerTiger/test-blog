<header id="header" class="header">
    <div class="header-container">
        <div class="header-left">
            <div class="header-name">
                <div class="header-name-ico">
                    @if($CURRENT_COMPANY->logo )
                    <span>{{ ucfirst(mb_strimwidth($CURRENT_COMPANY->name,0,1)) }}</span>
                    @else
                        <img src="{{ $CURRENT_COMPANY->logo }}" title="{{ $CURRENT_COMPANY->name }}" alt="{{ $CURRENT_COMPANY->name }}" />
                    @endif
                </div>
                <h3>{{ $CURRENT_COMPANY->name }}</h3>
            </div>
            <div class="header-search">
                <label>
                    <span>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path
    d="M7.33333 12.6667C10.2789 12.6667 12.6667 10.2789 12.6667 7.33333C12.6667 4.38781 10.2789 2 7.33333 2C4.38781 2 2 4.38781 2 7.33333C2 10.2789 4.38781 12.6667 7.33333 12.6667Z"
    stroke="#58667E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M14.0006 13.9996L11.1006 11.0996" stroke="#58667E" stroke-width="2" stroke-linecap="round"
      stroke-linejoin="round"/>
</svg>
                    </span>
                    <input type="text" placeholder="Search for Pool or Organizations">
                </label>
            </div>
            <div class="header-counter">
                <div class="header-counter-item">
                    <span>Total invested</span>
                    <p><span>$</span>1337</p>
                </div>
                <div class="header-counter-item">
                    <span>Contributions</span>
                    <p><span>$</span>228</p>
                </div>
                <div class="header-counter-item">
                    <span>Projects</span>
                    <p>3</p>
                </div>
            </div>
        </div>
        <div class="header-right">
            <a href="/" class="btn-blue">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="12" fill="white"/>
                    <rect x="11" y="6" width="2" height="12" rx="1" fill="#0187FF"/>
                    <rect x="18" y="11" width="2" height="12" rx="1" transform="rotate(90 18 11)" fill="#0187FF"/>
                </svg>
                <span>Create Pool</span>
            </a>
            <div class="header-wallet">
                <div class="header-wallet-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3.75 6V18C3.75 18.3978 3.90804 18.7794 4.18934 19.0607C4.47064 19.342 4.85218 19.5 5.25 19.5H20.25C20.4489 19.5 20.6397 19.421 20.7803 19.2803C20.921 19.1397 21 18.9489 21 18.75V8.25C21 8.05109 20.921 7.86032 20.7803 7.71967C20.6397 7.57902 20.4489 7.5 20.25 7.5H5.25C4.85218 7.5 4.47064 7.34196 4.18934 7.06066C3.90804 6.77936 3.75 6.39782 3.75 6ZM3.75 6C3.75 5.60218 3.90804 5.22064 4.18934 4.93934C4.47064 4.65804 4.85218 4.5 5.25 4.5H18"
                            stroke="#008DFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path
                            d="M16.875 14.625C17.4963 14.625 18 14.1213 18 13.5C18 12.8787 17.4963 12.375 16.875 12.375C16.2537 12.375 15.75 12.8787 15.75 13.5C15.75 14.1213 16.2537 14.625 16.875 14.625Z"
                            fill="#008DFF"/>
                    </svg>
                    @auth
                        <a class="header-link-btn" href="/logout">
                            <span>{{ $CURRENT_USER->address_masked }}</span>
                        </a>
                    @endauth
                </div>
                <div class="header-wallet-dropdown">
                    <div class="header-wallet-dropdown-head">
                        <span>ADDRESS</span>
                        <p>0x3e36****d793c</p>
                        <a href="/">View Transacton</a>
                    </div>
                    <div class="header-wallet-dropdown-body">
                        <p>ETH Mainet</p>
                        <span>Network</span>
                        <a href="/">
                            <span>Disconnect wallet</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header-btns">
                <div class="header-btns-wrap">
                    <a>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8 14C11.3137 14 14 11.3137 14 8C14 4.68629 11.3137 2 8 2C4.68629 2 2 4.68629 2 8C2 11.3137 4.68629 14 8 14Z"
                                stroke="#58667E" stroke-width="1.5" stroke-miterlimit="10"/>
                            <path d="M2 8H14" stroke="#58667E" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path
                                d="M8 13.839C9.38071 13.839 10.5 11.2248 10.5 8.00007C10.5 4.77531 9.38071 2.16113 8 2.16113C6.61929 2.16113 5.5 4.77531 5.5 8.00007C5.5 11.2248 6.61929 13.839 8 13.839Z"
                                stroke="#58667E" stroke-width="1.5" stroke-miterlimit="10"/>
                        </svg>
                    </a>
                    <span>/</span>
                    <a>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.5414 9.55072C12.5599 9.82346 11.5236 9.83064 10.5384 9.57153C9.55318 9.31243 8.65447 8.79632 7.93415 8.076C7.21382 7.35567 6.69771 6.45697 6.4386 5.47178C6.17949 4.48659 6.18667 3.45026 6.4594 2.46875L6.45956 2.4688C5.49148 2.73811 4.61086 3.25637 3.90542 3.97197C3.19999 4.68756 2.69437 5.5755 2.43892 6.54733C2.18348 7.51917 2.18714 8.54097 2.44952 9.51095C2.71191 10.4809 3.22387 11.3652 3.93441 12.0758C4.64494 12.7863 5.52925 13.2982 6.49923 13.5606C7.46921 13.823 8.49102 13.8266 9.46285 13.5712C10.4347 13.3157 11.3226 12.8101 12.0382 12.1047C12.7538 11.3992 13.272 10.5186 13.5413 9.55052L13.5414 9.55072Z"
                                stroke="#58667E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <div class="header-btns-dropdown">
                    <div class="header-btns-dropdown-head">
                        <a class="active" href="">
                            <span>There</span>
                            <div class="track">
                                <span>
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
<path
    d="M11.8487 8.35688C10.9899 8.59553 10.0831 8.60181 9.22107 8.37509C8.35903 8.14837 7.57266 7.69678 6.94238 7.0665C6.31209 6.43621 5.8605 5.64985 5.63378 4.78781C5.40705 3.92576 5.41333 3.01897 5.65197 2.16016L5.65211 2.1602C4.80504 2.39585 4.0345 2.84933 3.41724 3.47547C2.79999 4.10161 2.35757 4.87856 2.13406 5.72892C1.91055 6.57927 1.91374 7.47335 2.14333 8.32208C2.37292 9.17081 2.82089 9.94458 3.44261 10.5663C4.06432 11.188 4.83809 11.636 5.68683 11.8655C6.53556 12.0951 7.42964 12.0983 8.27999 11.8748C9.13034 11.6513 9.90729 11.2088 10.5334 10.5916C11.1596 9.97432 11.613 9.20377 11.8487 8.3567L11.8487 8.35688Z"
    stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                </span>
                            </div>
                        </a>
                    </div>
                    <div class="header-btns-dropdown-body">
                        <a class="active" href="">
                            <span>Englih</span>
                            <svg width="15" height="11" viewBox="0 0 15 11" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 3.85714L6.08696 9L14 1" stroke="#008DFF" stroke-width="2"
                                      stroke-linecap="round"/>
                            </svg>
                        </a>
                        <a href="">
                            <span>Русский</span>
                            <svg width="15" height="11" viewBox="0 0 15 11" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 3.85714L6.08696 9L14 1" stroke="#008DFF" stroke-width="2"
                                      stroke-linecap="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
