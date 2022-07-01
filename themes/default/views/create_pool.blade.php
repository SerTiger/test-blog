@extends('layouts.master')
@section('content')
    <section class="create">
        <div class="create-wrap">
            <h1>Create new Pool</h1>
            <div class="create-nav">
                <div class="create-nav-item active">
                    <span>Step 1</span>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 17H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16 13H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 9H9H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Introduction</span>
                    </a>
                </div>
                <div class="create-nav-item">
                    <span>Step 2</span>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 6.75V8.25" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 15.75V17.25" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.75 15.75H13.125C13.6223 15.75 14.0992 15.5525 14.4508 15.2008C14.8025 14.8492 15 14.3723 15 13.875C15 13.3777 14.8025 12.9008 14.4508 12.5492C14.0992 12.1975 13.6223 12 13.125 12H10.875C10.3777 12 9.90081 11.8025 9.54917 11.4508C9.19754 11.0992 9 10.6223 9 10.125C9 9.62772 9.19754 9.15081 9.54917 8.79917C9.90081 8.44754 10.3777 8.25 10.875 8.25H14.25" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Funds</span>
                    </a>
                </div>
                <div class="create-nav-item">
                    <span>Step 3</span>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.5 3.75H4.5C4.08579 3.75 3.75 4.08579 3.75 4.5V19.5C3.75 19.9142 4.08579 20.25 4.5 20.25H19.5C19.9142 20.25 20.25 19.9142 20.25 19.5V4.5C20.25 4.08579 19.9142 3.75 19.5 3.75Z" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M16.5 2.25V5.25" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M7.5 2.25V5.25" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M3.75 8.25H20.25" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Contribution Rules</span>
                    </a>
                </div>
                <div class="create-nav-item">
                    <span>Step 4</span>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M19.4 15C19.2669 15.3016 19.2272 15.6362 19.286 15.9606C19.3448 16.285 19.4995 16.5843 19.73 16.82L19.79 16.88C19.976 17.0657 20.1235 17.2863 20.2241 17.5291C20.3248 17.7719 20.3766 18.0322 20.3766 18.295C20.3766 18.5578 20.3248 18.8181 20.2241 19.0609C20.1235 19.3037 19.976 19.5243 19.79 19.71C19.6043 19.896 19.3837 20.0435 19.1409 20.1441C18.8981 20.2448 18.6378 20.2966 18.375 20.2966C18.1122 20.2966 17.8519 20.2448 17.6091 20.1441C17.3663 20.0435 17.1457 19.896 16.96 19.71L16.9 19.65C16.6643 19.4195 16.365 19.2648 16.0406 19.206C15.7162 19.1472 15.3816 19.1869 15.08 19.32C14.7842 19.4468 14.532 19.6572 14.3543 19.9255C14.1766 20.1938 14.0813 20.5082 14.08 20.83V21C14.08 21.5304 13.8693 22.0391 13.4942 22.4142C13.1191 22.7893 12.6104 23 12.08 23C11.5496 23 11.0409 22.7893 10.6658 22.4142C10.2907 22.0391 10.08 21.5304 10.08 21V20.91C10.0723 20.579 9.96512 20.258 9.77251 19.9887C9.5799 19.7194 9.31074 19.5143 9 19.4C8.69838 19.2669 8.36381 19.2272 8.03941 19.286C7.71502 19.3448 7.41568 19.4995 7.18 19.73L7.12 19.79C6.93425 19.976 6.71368 20.1235 6.47088 20.2241C6.22808 20.3248 5.96783 20.3766 5.705 20.3766C5.44217 20.3766 5.18192 20.3248 4.93912 20.2241C4.69632 20.1235 4.47575 19.976 4.29 19.79C4.10405 19.6043 3.95653 19.3837 3.85588 19.1409C3.75523 18.8981 3.70343 18.6378 3.70343 18.375C3.70343 18.1122 3.75523 17.8519 3.85588 17.6091C3.95653 17.3663 4.10405 17.1457 4.29 16.96L4.35 16.9C4.58054 16.6643 4.73519 16.365 4.794 16.0406C4.85282 15.7162 4.81312 15.3816 4.68 15.08C4.55324 14.7842 4.34276 14.532 4.07447 14.3543C3.80618 14.1766 3.49179 14.0813 3.17 14.08H3C2.46957 14.08 1.96086 13.8693 1.58579 13.4942C1.21071 13.1191 1 12.6104 1 12.08C1 11.5496 1.21071 11.0409 1.58579 10.6658C1.96086 10.2907 2.46957 10.08 3 10.08H3.09C3.42099 10.0723 3.742 9.96512 4.0113 9.77251C4.28059 9.5799 4.48572 9.31074 4.6 9C4.73312 8.69838 4.77282 8.36381 4.714 8.03941C4.65519 7.71502 4.50054 7.41568 4.27 7.18L4.21 7.12C4.02405 6.93425 3.87653 6.71368 3.77588 6.47088C3.67523 6.22808 3.62343 5.96783 3.62343 5.705C3.62343 5.44217 3.67523 5.18192 3.77588 4.93912C3.87653 4.69632 4.02405 4.47575 4.21 4.29C4.39575 4.10405 4.61632 3.95653 4.85912 3.85588C5.10192 3.75523 5.36217 3.70343 5.625 3.70343C5.88783 3.70343 6.14808 3.75523 6.39088 3.85588C6.63368 3.95653 6.85425 4.10405 7.04 4.29L7.1 4.35C7.33568 4.58054 7.63502 4.73519 7.95941 4.794C8.28381 4.85282 8.61838 4.81312 8.92 4.68H9C9.29577 4.55324 9.54802 4.34276 9.72569 4.07447C9.90337 3.80618 9.99872 3.49179 10 3.17V3C10 2.46957 10.2107 1.96086 10.5858 1.58579C10.9609 1.21071 11.4696 1 12 1C12.5304 1 13.0391 1.21071 13.4142 1.58579C13.7893 1.96086 14 2.46957 14 3V3.09C14.0013 3.41179 14.0966 3.72618 14.2743 3.99447C14.452 4.26276 14.7042 4.47324 15 4.6C15.3016 4.73312 15.6362 4.77282 15.9606 4.714C16.285 4.65519 16.5843 4.50054 16.82 4.27L16.88 4.21C17.0657 4.02405 17.2863 3.87653 17.5291 3.77588C17.7719 3.67523 18.0322 3.62343 18.295 3.62343C18.5578 3.62343 18.8181 3.67523 19.0609 3.77588C19.3037 3.87653 19.5243 4.02405 19.71 4.21C19.896 4.39575 20.0435 4.61632 20.1441 4.85912C20.2448 5.10192 20.2966 5.36217 20.2966 5.625C20.2966 5.88783 20.2448 6.14808 20.1441 6.39088C20.0435 6.63368 19.896 6.85425 19.71 7.04L19.65 7.1C19.4195 7.33568 19.2648 7.63502 19.206 7.95941C19.1472 8.28381 19.1869 8.61838 19.32 8.92V9C19.4468 9.29577 19.6572 9.54802 19.9255 9.72569C20.1938 9.90337 20.5082 9.99872 20.83 10H21C21.5304 10 22.0391 10.2107 22.4142 10.5858C22.7893 10.9609 23 11.4696 23 12C23 12.5304 22.7893 13.0391 22.4142 13.4142C22.0391 13.7893 21.5304 14 21 14H20.91C20.5882 14.0013 20.2738 14.0966 20.0055 14.2743C19.7372 14.452 19.5268 14.7042 19.4 15V15Z" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Settings</span>
                    </a>
                </div>
                <div class="create-nav-item">
                    <span>Step 5</span>
                    <a>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.5 3.75H4.5C4.08579 3.75 3.75 4.08579 3.75 4.5V19.5C3.75 19.9142 4.08579 20.25 4.5 20.25H19.5C19.9142 20.25 20.25 19.9142 20.25 19.5V4.5C20.25 4.08579 19.9142 3.75 19.5 3.75Z" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M20.25 14.9999L16.2803 11.0302C16.1397 10.8896 15.9489 10.8105 15.75 10.8105C15.5511 10.8105 15.3603 10.8896 15.2197 11.0302L11.0303 15.2196C10.8897 15.3602 10.6989 15.4392 10.5 15.4392C10.3011 15.4392 10.1103 15.3602 9.96967 15.2196L8.03033 13.2802C7.88967 13.1396 7.69891 13.0605 7.5 13.0605C7.30108 13.0605 7.11032 13.1396 6.96967 13.2802L3.75 16.4999" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.375 9.75C9.99632 9.75 10.5 9.24632 10.5 8.625C10.5 8.00368 9.99632 7.5 9.375 7.5C8.75368 7.5 8.25 8.00368 8.25 8.625C8.25 9.24632 8.75368 9.75 9.375 9.75Z" fill="#A6B0C3"/>
                        </svg>
                        <span>Img</span>
                    </a>
                </div>
            </div>
            <div class="create-body">
                <div class="create-body-left">
                    <form id="introduction" class="create-body-tab">
                        <div class="input-row">
                            <label>
                                <span>Project Title</span>
                                <input type="text" id="title" name="title">
                            </label>
                        </div>
                        <div class="input-row">
                            <label>
                                <span>Project Description</span>
                                <textarea name="description" id="description" class="ckeditor"></textarea>
                            </label>
                        </div>
                        <div class="btn-wrap">
                            <span></span>
                            <button class="btn-blue">
                                <span>Next Steps</span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12L19 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <form id="funds" class="create-body-tab">
                        <div class="input-row">
                            <label>
                                <span>Funds Receive Address</span>
                                <input id="address" name="address" type="text">
                            </label>
                        </div>
                        <div class="connector">
                            <div class="input-row">
                                <label>
                                    <span>Total Pool Amount</span>
                                    <input id="amount" name="amount" type="tel">
                                </label>
                            </div>
                            <div class="input-row">
                                <label>
                                    <span>Pool Currency</span>
                                    <select class="selection" id="currency" name="currency">
                                        <option value="AL">Ethereum (BNB)</option>
                                        <option value="WY">Ethereum (BNB)</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="input-row">
                            <label>
                                <span>Supported Deposit</span>
                                <select class="selection" id="supported" name="supported" multiple="multiple">
                                    <optgroup label="Binance Smart Chain (BNB)">
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                        <option value="AL">BTC Bitcoin</option>
                                    </optgroup>
                                    <optgroup label="Ehereum">
                                        <option value="da">USDC</option>
                                        <option value="da">USDC</option>
                                    </optgroup>
                                    <optgroup label="Polygon">
                                        <option value="asa">BUSD</option>
                                        <option value="asa">BUSD</option>
                                    </optgroup>
                                </select>
                            </label>
                        </div>
                        <div class="btn-wrap">
                            <a id="to_introduction">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 12L5 12" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 19L5 12L12 5" stroke="#A6B0C3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>Back</span>
                            </a>
                            <button class="btn-blue">
                                <span>Next Steps</span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12L19 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 5L19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="create-body-right">
                    <div class="create-body-right-info">
                        <div class="create-body-right-info-head">
                        <span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8 6.5V9" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.13451 2.49904L1.63599 11.9986C1.54801 12.1506 1.50161 12.3231 1.50147 12.4987C1.50132 12.6743 1.54743 12.8469 1.63516 12.999C1.7229 13.1512 1.84915 13.2776 2.00123 13.3654C2.1533 13.4533 2.32584 13.4995 2.50147 13.4995H13.4985C13.6741 13.4995 13.8467 13.4533 13.9987 13.3654C14.1508 13.2776 14.2771 13.1512 14.3648 12.999C14.4525 12.8469 14.4986 12.6743 14.4985 12.4987C14.4984 12.3231 14.452 12.1506 14.364 11.9986L8.86545 2.49904C8.77761 2.34728 8.65141 2.22129 8.4995 2.1337C8.3476 2.04611 8.17533 2 7.99998 2C7.82463 2 7.65237 2.04611 7.50046 2.1337C7.34855 2.22129 7.22235 2.34728 7.13451 2.49904V2.49904Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M8 12C8.41421 12 8.75 11.6642 8.75 11.25C8.75 10.8358 8.41421 10.5 8 10.5C7.58579 10.5 7.25 10.8358 7.25 11.25C7.25 11.6642 7.58579 12 8 12Z" fill="white"/>
</svg>
                        </span>
                            <h3>Before you fundraise:</h3>
                        </div>
                        <div class="create-body-right-info-body">
                            <ul>
                                <li>Add a Introduction</li>
                                <li>Add Funds</li>
                                <li>Add Contribution rules</li>
                            </ul>
                        </div>
                    </div>
                    <button class="btn-blue">
                        <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.2573 23.0711C10.8431 27.3137 5.18628 27.3137 5.18628 27.3137C5.18628 27.3137 5.18628 21.6569 9.42892 20.2427" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24.9853 13.1715L16.5 21.6568L10.8431 15.9999L19.3284 7.51466C22.5414 4.30164 25.7545 4.33298 27.1247 4.53743C27.3357 4.56888 27.531 4.66727 27.6818 4.8181C27.8327 4.96894 27.9311 5.16423 27.9625 5.37521C28.167 6.74548 28.1983 9.9585 24.9853 13.1715Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M23.5711 14.5859V22.657C23.5711 22.7883 23.5452 22.9184 23.4949 23.0397C23.4447 23.161 23.371 23.2713 23.2782 23.3641L19.2355 27.4068C19.1075 27.5348 18.9471 27.6257 18.7716 27.6697C18.596 27.7137 18.4118 27.7093 18.2386 27.6568C18.0653 27.6044 17.9096 27.5059 17.7879 27.3719C17.6663 27.2378 17.5833 27.0733 17.5478 26.8958L16.5 21.657" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.9142 8.92871H9.84314C9.71181 8.92871 9.58178 8.95458 9.46045 9.00483C9.33913 9.05509 9.22889 9.12874 9.13603 9.2216L5.09331 13.2643C4.96532 13.3923 4.87447 13.5526 4.83045 13.7282C4.78642 13.9038 4.79087 14.088 4.84332 14.2612C4.89577 14.4344 4.99426 14.5902 5.12828 14.7119C5.26229 14.8335 5.42681 14.9165 5.6043 14.952L10.8431 15.9998" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Create Pool</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

@stop
