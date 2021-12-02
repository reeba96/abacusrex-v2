<style>
    .gdpr-container {
        color:#ccc;
        width:100%;
        position: fixed;
        padding: 45px !important;
        z-index: 10000;
        bottom: 0;
        left: 0;
        font-size: 15px;
        backdrop-filter: blur(10px);
        background-color: rgba(0, 0, 0, 0.8);
        padding: 4px 8px 12px;
        box-shadow: 0 -2px 15px rgba(0,0,0,0.19), 0 -1px 2px rgba(0,0,0,0.1);
    }
    .cookie-consent__agree {margin-top:20px;}
  </style>

<div class="gdpr-container js-cookie-consent ">
    <div class="gdpr-content-container">
        <div class="cookie-consent">
                <p>
                    <b>{!! __('cookieConsent.title') !!}</b>
                </p>
                <span class="cookie-consent__message">
                    {!! __('cookieConsent.message') !!}
                </span><br>
                
                <button  class="btn btn-primary btn-lg mt-4 js-cookie-consent-agree cookie-consent__agree">
                    {{ __('cookieConsent.agree') }}
                </button>
        </div>    
    </div>
</div>
  