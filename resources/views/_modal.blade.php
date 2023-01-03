@props(['route' => null])

<div id="{{ $route->lrb_modal_id }}" tabindex="-1" aria-hidden="true" class="lrb-modal-wrapper" style="display: none;">
    <div class="lrb-modal-container">
        <div class="lrb-modal-outer">
            <div class="lrb-modal-header">
                <h3 class="lrb-modal-heading">
                    @lang($route->lrb_text)
                </h3>
                <button onclick="document.getElementById('{{ $route->lrb_modal_id }}').style.display = 'none'" 
                    type="button" class="lrb-modal-close">
                    <svg aria-hidden="true" class="lrb-modal-close-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    <span class="lrb-modal-close-text">@lang('Close modal')</span>
                </button>
            </div>
            <div class="lrb-modal-body">
                {{ $route->lrb_html->with('route', $route) }}
            </div>
        </div>
    </div>
</div>

@once
    @push('after-scripts')
        <style>
            .lrb-modal-alert-icon {
                width: 7rem;
                height: 7rem;
                margin: 0 auto;
            }
            .lrb-modal-alert-icon path {
                stroke: #f27474;
            }
            .lrb-modal-wrapper {
                padding: 1rem; 
                background-color: rgb(0 0 0/0.3); 
                overflow-x: hidden; 
                overflow-y: auto; 
                width: 100%; 
                height: 100%; 
                z-index: 50; 
                left: 0; 
                right: 0; 
                top: 0; 
                position: fixed;
            }
            @media (min-width: 768px) {
                .lrb-modal-wrapper {
                    height: 100%;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    top: 0;
                }
            }
            .lrb-modal-container {
                position: relative;
                width: 100%;
                max-width: 100%;
                height: 100%;
            }
            @media (min-width: 768px) {
                .lrb-modal-container {
                    height: auto;
                    left: 50%;
                    top: 50%;
                    width: 32rem;
                    transform: translate(-50%,-50%) rotate(0) skewX(0) skewY(0) scaleX(1) scaleY(1);
                }
            }
            .lrb-modal-outer {
                box-shadow: 0 0 #0000,0 0 #0000,0 0 #0000;
                background-color: rgb(255 255 255);
                border-radius: 0.5rem;
                position: relative;
            }
            .lrb-modal-header {
                padding: 1rem;
                border-bottom-width: 1px;
                border-top-left-radius: 0.3125rem;
                border-top-right-radius: 0.3125rem;
                justify-content: space-between;
                align-items: center;
                display: flex;
            }
            .lrb-modal-heading {
                color: rgb(17 24 39);
                font-weight: 600;
                font-size: 1.125rem;
                line-height: 1.75rem;
                margin: 0;
            }
            .lrb-modal-alert-title {
                font-size: 1.25rem;
                line-height: 1.75rem;
                color: #6b7280;
                text-align: center;
                display: block;
                white-space: normal;
                margin-bottom: 1rem;
            }
            .lrb-modal-alert-actions {
                display: flex; 
                flex-direction: row; 
                width: 100%;
                justify-content: center;
                gap: .75rem;
            }
            .lrb-modal-alert-confirm {
                min-width: 100px;
                -webkit-appearance: button;
                background-image: none;
                background-color: #6e7881;
                border-radius: 5px;
                color: #fff;
                font-size: 1rem;
                line-height: 1rem;
                padding: 1rem 1.75rem;
                text-align: center;
            }
            .lrb-modal-alert-cancel {
                min-width: 100px;
                -webkit-appearance: button;
                background-image: none;
                background-color: #dc3741;
                border-radius: 5px;
                color: #fff;
                font-size: 1rem;
                line-height: 1rem;
                padding: 1rem 1.75rem;
                text-align: center;
            }
            .lrb-modal-body {
                padding: 1.5rem;
                border-bottom-left-radius: 0.3125rem;
                border-bottom-right-radius: 0.3125rem;
            }
            .lrb-modal-close {
                color: rgb(156 163 175);
                font-size: .875rem;
                line-height: 1.25rem;
                padding: 0.375rem;
                background-color: transparent;
                border-radius: 0.5rem;
                align-items: center;
                display: inline-flex;
                margin-left: auto;
                -webkit-appearance: button;
                background-image: none;
                cursor: pointer;
                text-transform: none;
                margin: 0;
            }
            .lrb-modal-close:hover {
                color: rgb(17 24 39);
                background-color: rgb(229 231 235);
            }
            .lrb-modal-close-icon {
                height: 1.25rem;
                width: 1.25rem;
            }
            .lrb-modal-close-text {
                clip: rect(0,0,0,0);
                border-width: 0;
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                white-space: nowrap;
                width: 1px;
            }
        </style>
    @endpush
@endonce