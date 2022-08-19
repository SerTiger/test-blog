@extends('layouts.master')
@section('content')
    <section class="auth">
        <div class="auth-wrap">
            <div class="auth-left">
                <div class="auth-logo">
                    <svg width="287" height="120" viewBox="0 0 287 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M47.1597 83.3894C73.1438 83.3894 94.208 64.7221 94.208 41.6947C94.208 18.6674 73.1438 0 47.1597 0C21.1756 0 0.111328 18.6674 0.111328 41.6947C0.111328 64.7221 21.1756 83.3894 47.1597 83.3894ZM47.1582 79.3213C64.6823 79.3213 78.8885 62.4751 78.8885 41.6944C78.8885 20.9136 64.6823 4.06743 47.1582 4.06743C29.634 4.06743 15.4279 20.9136 15.4279 41.6944C15.4279 62.4751 29.634 79.3213 47.1582 79.3213Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M239.73 83.3894C265.714 83.3894 286.778 64.7221 286.778 41.6947C286.778 18.6674 265.714 0 239.73 0C213.746 0 192.682 18.6674 192.682 41.6947C192.682 64.7221 213.746 83.3894 239.73 83.3894ZM239.728 79.3213C257.253 79.3213 271.459 62.4751 271.459 41.6944C271.459 20.9136 257.253 4.06743 239.728 4.06743C222.204 4.06743 207.998 20.9136 207.998 41.6944C207.998 62.4751 222.204 79.3213 239.728 79.3213Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M145.612 32.4137L173.448 2.03223H181.74L149.548 37.169L186.117 81.3539H168.61L140.35 47.2081L109.066 81.3539H100.773L136.415 42.4528L102.961 2.03223H120.468L145.612 32.4137Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M94.2076 109.036C94.2091 108.962 94.2099 108.888 94.2099 108.814C94.2099 108.74 94.2091 108.666 94.2076 108.593V109.036ZM92.8982 113.898C90.9063 117.521 86.8519 120.001 82.1743 120.001C75.5272 120.001 70.1387 114.992 70.1387 108.814C70.1387 102.636 75.5272 97.6279 82.1743 97.6279C86.851 97.6279 90.9046 100.107 92.897 103.729H90.5465C88.9762 101.276 86.3023 99.6612 83.2676 99.6612C78.4334 99.6612 74.5144 103.759 74.5144 108.814C74.5144 113.869 78.4334 117.966 83.2676 117.966C86.3027 117.966 88.9769 116.351 90.5471 113.898H92.8982Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M125.938 97.627H122.655V117.966H125.938V109.831H131.408C135.034 109.831 137.973 107.1 137.973 103.73C137.973 100.36 135.034 97.6281 131.408 97.6281H125.938V97.627ZM125.938 98.645V108.814H129.22C131.637 108.814 133.596 106.538 133.596 103.73C133.596 100.922 131.637 98.645 129.22 98.645H125.938Z" fill="white"/>
                        <path d="M143.446 97.627H146.729V117.966H143.446V97.627Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M171.456 97.6274H153.293V99.6613H160.953V117.966H164.235V99.6613H171.456V97.6274Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M105.152 97.627H107.34L107.34 97.6274H108.432L117.185 117.966H113.903L111.277 111.864H101.213L98.5867 117.966H96.3984L105.15 97.6296L105.15 97.6274H105.151L105.152 97.627ZM106.245 100.172L102.088 109.83H110.401L106.245 100.172Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M183.928 97.627H186.116L186.116 97.6272H187.209L195.962 117.966H192.68L190.054 111.864H179.989L177.363 117.966H175.175L183.927 97.6285L183.927 97.6272H183.928L183.928 97.627ZM185.021 100.171L180.864 109.83H189.179L185.021 100.171Z" fill="white"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M204.717 97.6274H201.435V117.966H204.717V117.965H214.564V115.932H204.717V97.6274Z" fill="white"/>
                    </svg>
                </div>
            </div>
            <div class="auth-right">
                <h1>Welcome to OXO Capital</h1>
                <p>To get started, connect your wallet</p>
                <p>Please connect your wallet to view your contributions.</p>
                @auth
                <a href="{{ route('organization.create') }}" class="btn-blue">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.75 6V18C3.75 18.3978 3.90804 18.7794 4.18934 19.0607C4.47064 19.342 4.85218 19.5 5.25 19.5H20.25C20.4489 19.5 20.6397 19.421 20.7803 19.2803C20.921 19.1397 21 18.9489 21 18.75V8.25C21 8.05109 20.921 7.86032 20.7803 7.71967C20.6397 7.57902 20.4489 7.5 20.25 7.5H5.25C4.85218 7.5 4.47064 7.34196 4.18934 7.06066C3.90804 6.77936 3.75 6.39782 3.75 6ZM3.75 6C3.75 5.60218 3.90804 5.22064 4.18934 4.93934C4.47064 4.65804 4.85218 4.5 5.25 4.5H18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.875 14.625C17.4963 14.625 18 14.1213 18 13.5C18 12.8787 17.4963 12.375 16.875 12.375C16.2537 12.375 15.75 12.8787 15.75 13.5C15.75 14.1213 16.2537 14.625 16.875 14.625Z" fill="white"/>
                    </svg>
                    <span>Wallet</span>
                </a>
                @endauth
                @guest
                <metamask-sign link="{{ route('organization.create') }}">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.75 6V18C3.75 18.3978 3.90804 18.7794 4.18934 19.0607C4.47064 19.342 4.85218 19.5 5.25 19.5H20.25C20.4489 19.5 20.6397 19.421 20.7803 19.2803C20.921 19.1397 21 18.9489 21 18.75V8.25C21 8.05109 20.921 7.86032 20.7803 7.71967C20.6397 7.57902 20.4489 7.5 20.25 7.5H5.25C4.85218 7.5 4.47064 7.34196 4.18934 7.06066C3.90804 6.77936 3.75 6.39782 3.75 6ZM3.75 6C3.75 5.60218 3.90804 5.22064 4.18934 4.93934C4.47064 4.65804 4.85218 4.5 5.25 4.5H18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.875 14.625C17.4963 14.625 18 14.1213 18 13.5C18 12.8787 17.4963 12.375 16.875 12.375C16.2537 12.375 15.75 12.8787 15.75 13.5C15.75 14.1213 16.2537 14.625 16.875 14.625Z" fill="white"/>
                    </svg>
                    <span>Connect Wallet</span>
                </metamask-sign>
                @endguest
            </div>
        </div>
    </section>
@stop

