@if(count($routes) > 0)
    <div class="w-full flex space-x-2 space-y-2 justify-end">
        <div class="flex items-center shadow rounded-lg overflow-hidden text-sm h-10">
            @if(in_array($routes[0]['method'], ['delete','patch','post']))
                <form method="post" class="" name="{{ $routes[0]['form'] }}-item"
                    action="{{ $routes[0]['route'] }}"
                    >
                    @csrf
                    @if(in_array($routes[0]['method'], ['delete','patch']))
                        @method($routes[0]['method'])
                    @endif
                    <button type="submit"
                        class="@if(count($routes) > 1) rounded-l-lg @else rounded-lg @endif
                            bg-gray-100 hover:bg-gray-200 text-gray-500 border-gray-300
                            appearance-none flex items-center px-4 h-10 font-semibold leading-none tracking-wide border"
                        >
                        @lang($routes[0]['text'])
                    </button>
                </form>
            @else
                <a href="{{ $routes[0]['route'] }}"
                    class="@if(count($routes) > 1) rounded-l-lg @else rounded-lg @endif
                        bg-gray-100 hover:bg-gray-200 text-gray-500 border-gray-300
                        appearance-none flex items-center px-4 h-10 font-semibold leading-none tracking-wide border"
                    >
                    @lang($routes[0]['text'])
                </a>
            @endif
            @if(count($routes) > 1)
                <button id="button_{{ $model->route_button_key }}"
                    class="rounded-r-lg border border-l-0
                        bg-gray-100 hover:bg-gray-200 text-gray-500 border-gray-300
                        appearance-none flex items-center justify-center align-middle w-10 h-10"
                    onclick="(e => {
                        let route_button_dropdown = document.getElementById('{{ $model->route_button_key }}')
                        let route_button_state = route_button_dropdown.__x.$data.{{ $model->route_button_key }}
                        document.getElementById('{{ $model->route_button_key }}').__x.$data.{{ $model->route_button_key }} = !route_button_state
                        route_button_dropdown.style.position = 'absolute'
                        route_button_dropdown.style.top = (window.scrollY + document.getElementById('button_{{ $model->route_button_key }}').getBoundingClientRect().bottom) + 'px'
                        route_button_dropdown.style.left = (window.scrollX + document.getElementById('button_{{ $model->route_button_key }}').getBoundingClientRect().right) + 'px'
                        return false;
                    })(arguments[0]); return false;"
                    >
                    <svg class="fill-gray-500 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"/>
                    </svg>
                </button>
            @endif
        </div>
        @if(count($routes) > 1)
            <div id="{{ $model->route_button_key }}"
                x-data="{ {{ $model->route_button_key }}: false}"
                x-show="{{ $model->route_button_key }}"
                >
                <ul
                    @click.away="{{ $model->route_button_key }} = false"
                    @keydown.escape="{{ $model->route_button_key }} = false"
                    class="z-10 absolute right-2 w-44 space-y-2 text-sm rounded-md overflow-hidden shadow-md
                        text-gray-500 bg-white border border-gray-200"
                    >
                    <li class="flex flex-col divide-gray-200 divide-y">
                        @foreach($routes as $route)
                            @if(in_array($route['method'], ['delete','patch','post']))
                                <form method="post" class="" name="{{ $route['form'] }}-item"
                                    action="{{ $route['route'] }}"
                                    >
                                    @csrf
                                    @if(in_array($route['method'], ['delete','patch']))
                                        @method($route['method'])
                                    @endif
                                    <button type="submit"
                                        class="block items-center text-center w-full px-4 py-2 font-semibold
                                            hover:bg-gray-100 hover:text-gray-800"
                                        >
                                        @lang($route['text'])
                                    </button>
                                </form>
                            @else
                                <a href="{{ $route['route'] }}"
                                    class="block items-center text-center w-full px-4 py-2 font-semibold
                                        hover:bg-gray-100 hover:text-gray-800"
                                    >
                                    @lang($route['text'])
                                </a>
                            @endif
                        @endforeach
                    </li>
                </ul>
            </div>
        @endif
    </div>
@endif
