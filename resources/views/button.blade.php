@if($routes->count() > 0)
    <div class="route-btn-wrapper">
        <div class="route-btn-container">
            @if(in_array($routes->first()->method, ['delete','patch','post']))
                <form method="post" class="" name="{{ $routes->first()->form }}-alert" action="{{ $routes->first()->route }}">
                    @csrf
                    @if(in_array($routes->first()->method, ['delete','patch']))
                        @method($routes->first()->method)
                    @endif
                    <button type="submit" class="@if($routes->count() > 1) route-btn-multiple-left @else route-btn-single @endif">
                        @lang($routes->first()->text)
                    </button>
                </form>
            @else
                <a href="{{ $routes->first()->route }}" class="@if($routes->count() > 1) route-btn-multiple-left @else route-btn-single @endif">
                    @lang($routes->first()->text)
                </a>
            @endif
            @if($routes->count() > 1)
                <button id="{{ $model->route_button_toggle }}" onclick="toggleRouteButton(event, '{{ $model->route_button_toggle }}', '{{ $model->route_button_dropdown }}');" class="route-btn-multiple-right">
                    <svg class="route-btn-caret" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/>
                    </svg>
                </button>
            @endif
        </div>
        @if($routes->count() > 1)
            <div id="{{ $model->route_button_dropdown }}" style="display: none;">
                <div class="route-btn-dropdown">
                    <div class="route-btn-list">
                        @foreach($routes as $route)
                            @if(in_array($route->method, ['delete','patch','post']))
                                <form method="post" name="{{ $route->form }}-alert" action="{{ $route->route }}">
                                    @csrf
                                    @if(in_array($route->method, ['delete','patch']))
                                        @method($route->method)
                                    @endif
                                    <button type="submit" class="route-btn-link">
                                        @lang($route->text)
                                    </button>
                                </form>
                            @else
                                <a href="{{ $route->route }}" class="route-btn-link">
                                    @lang($route->text)
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        document.addEventListener('click', function(event) {
            let lrb_dropdown = document.querySelector('#{{ $model->route_button_dropdown }}');

            if(lrb_dropdown) {
                if (!lrb_dropdown.contains(event.target)
                    && !event.target.closest('#{{ $model->route_button_toggle }}')) {
                        if(lrb_dropdown.style.display == 'block') {
                            lrb_dropdown.style.display = 'none';
                        }
                }
            }
        });
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelector('#{{ $model->route_button_dropdown }}').style.display = 'none';
            }
        });
    </script>
@endif

@once
    @push('after-scripts')
        <style>
            .route-btn-wrapper {
                display: flex;
                width: 100%;
                justify-content: flex-end;
            }
            .route-btn-wrapper > :not([hidden]) ~ :not([hidden]) {
                --tw-space-x-reverse: 0;
                margin-right: calc(0.5rem * var(--tw-space-x-reverse));
                margin-left: calc(0.5rem * calc(1 - var(--tw-space-x-reverse)));
                --tw-space-y-reverse: 0;
                margin-top: calc(0.5rem * calc(1 - var(--tw-space-y-reverse)));
                margin-bottom: calc(0.5rem * var(--tw-space-y-reverse));
            }
            .route-btn-wrapper .route-btn-container {
                display: flex;
                height: 38px;
                align-items: center;
                overflow: hidden;
                border-radius: 0.5rem;
                font-size: 0.875rem;
                line-height: 1.25rem;
                --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }
            .route-btn-wrapper .route-btn-container .route-btn-single {
                display: flex;
                height: 38px;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                align-items: center;
                border-radius: 0.5rem;
                border-width: 1px;
                --tw-border-opacity: 1;
                border-color: rgb(209 213 219 / var(--tw-border-opacity));
                --tw-bg-opacity: 1;
                background-color: rgb(243 244 246 / var(--tw-bg-opacity));
                padding-left: 1rem;
                padding-right: 1rem;
                font-weight: 600;
                line-height: 1;
                letter-spacing: 0.025em;
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity));
            }
            .route-btn-wrapper .route-btn-container .route-btn-multiple-left {
                display: flex;
                height: 38px;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                align-items: center;
                border-top-left-radius: 0.5rem;
                border-bottom-left-radius: 0.5rem;
                border-width: 1px;
                --tw-border-opacity: 1;
                border-color: rgb(209 213 219 / var(--tw-border-opacity));
                --tw-bg-opacity: 1;
                background-color: rgb(243 244 246 / var(--tw-bg-opacity));
                padding-left: 1rem;
                padding-right: 1rem;
                font-weight: 600;
                line-height: 1;
                letter-spacing: 0.025em;
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity));
            }
            .route-btn-wrapper .route-btn-container .route-btn-multiple-right {
                display: flex;
                height: 38px;
                width: 2.5rem;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                align-items: center;
                justify-content: center;
                border-top-right-radius: 0.5rem;
                border-bottom-right-radius: 0.5rem;
                border-width: 1px;
                border-left-width: 0px;
                --tw-border-opacity: 1;
                border-color: rgb(209 213 219 / var(--tw-border-opacity));
                --tw-bg-opacity: 1;
                background-color: rgb(243 244 246 / var(--tw-bg-opacity));
                vertical-align: middle;
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity));
            }
            .route-btn-wrapper .route-btn-container .route-btn-multiple-right .route-btn-caret {
                height: 1rem;
                width: 1rem;
                fill: #6b7280;
            }
            .route-btn-wrapper .route-btn-dropdown {
                position: absolute;
                right: 0.5rem;
                z-index: 10;
                min-width: 11rem;
            }
            .route-btn-wrapper .route-btn-dropdown {
                overflow: hidden;
                border-radius: 0.375rem;
                border-width: 1px;
                --tw-border-opacity: 1;
                border-color: rgb(229 231 235 / var(--tw-border-opacity));
                --tw-bg-opacity: 1;
                background-color: rgb(255 255 255 / var(--tw-bg-opacity));
                font-size: 0.875rem;
                line-height: 1.25rem;
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity));
                --tw-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }
            .route-btn-wrapper .route-btn-dropdown .route-btn-list {
                display: flex;
                flex-direction: column;
            }
            .route-btn-wrapper .route-btn-dropdown .route-btn-list > :not([hidden]) ~ :not([hidden]) {
                --tw-divide-y-reverse: 0;
                border-top-width: calc(1px * calc(1 - var(--tw-divide-y-reverse)));
                border-bottom-width: calc(1px * var(--tw-divide-y-reverse));
                --tw-divide-opacity: 1;
                border-color: rgb(229 231 235 / var(--tw-divide-opacity));
            }
            .route-btn-wrapper .route-btn-dropdown .route-btn-list .route-btn-link {
                display: block;
                width: 100%;
                align-items: center;
                padding-left: 1rem;
                padding-right: 1rem;
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                text-align: center;
                font-weight: 600;
            }
        </style>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
        <script>
            function toggleRouteButton(event, toggle, dropdown) {
                event.preventDefault()
                let lrb_toggle = document.getElementById(toggle);
                let lrb_dropdown = document.getElementById(dropdown);
                if(lrb_dropdown.style.display == 'none') {
                    lrb_dropdown.style.display = 'block';
                    lrb_dropdown.style.position = 'absolute';
                    lrb_dropdown.style.top = (window.scrollY + lrb_toggle.getBoundingClientRect().bottom) + 'px';
                    lrb_dropdown.style.left = (window.scrollX + lrb_toggle.getBoundingClientRect().right) + 'px';
                } else {
                    lrb_dropdown.style.display = 'none';
                }
            }
            document.querySelector('body').addEventListener('submit', function(e) {
                e.preventDefault()

                if (e.target.getAttribute('name') === 'delete-alert') {
                    Swal.fire({
                        title: 'Confirm Action',
                        html: 'Are you sure you want to delete this item?',
                        showCancelButton: true,
                        confirmButtonText: 'Confirm Delete',
                        cancelButtonText: 'Cancel',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.value) {
                            e.target.submit()
                        }
                    });
                }
                if (e.target.getAttribute('name') === 'confirm-alert') {
                    Swal.fire({
                        title: 'Confirm Action',
                        html: 'Are you sure you want to do this?',
                        showCancelButton: true,
                        confirmButtonText: 'Continue',
                        cancelButtonText: 'Cancel',
                        icon: 'warning'
                    }).then((result) => {
                        if (result.value) {
                            e.target.submit()
                        }
                    });
                }
            });
        </script>
    @endpush
@endonce
