@props(['route' => null, 'type' => null, 'routes_count' => 0])

@if(in_array($route->lrb_method, ['delete','patch','post']))
    <form method="post" name="{{ $route->lrb_name ?? '' }}" action="{{ $route->lrb_url }}">
        @csrf

        @if(in_array($route->lrb_method, ['delete','patch']))
            @method($route->lrb_method)
        @endif

        @if($route->lrb_html)
            <button id="{{ $route->lrb_modal_button_id }}" type="button" 
                onclick="document.getElementById('{{ $route->lrb_modal_id }}').style.display = 'block'"  class="
                @if($type == 'dropdown') 
                    lrb-link 
                @elseif($type == 'main' && $routes_count > 1) 
                    lrb-multiple-left 
                @else 
                    lrb-single 
                @endif">
                @lang($route->lrb_text)
            </button>

            @include('route-button::_modal', ['route' => $route])
        @else
            <button type="submit" class="
                @if($type == 'dropdown') 
                    lrb-link 
                @elseif($type == 'main' && $routes_count > 1) 
                    lrb-multiple-left 
                @else 
                    lrb-single 
                @endif">
                @lang($route->lrb_text)
            </button>
        @endif
    </form>
@else
    <a href="{{ $route->lrb_url }}" class="
        @if($type == 'dropdown')
            lrb-link 
        @elseif($type == 'main' && $routes_count > 1)
            lrb-multiple-left 
        @else
            lrb-single 
        @endif">
        @lang($route->lrb_text)
    </a>
@endif

@push('after-scripts')
    <script>
        // hide dropdown if click outside
        document.addEventListener('click', function(event) {
            let lrb_dropdown = document.querySelector('#{{ $route->lrb_dropdown_id }}');
            if(lrb_dropdown) {
                if (!lrb_dropdown.contains(event.target) && !event.target.closest('#{{ $route->lrb_toggle_id }}')) {
                    if(lrb_dropdown.style.display == 'block') {
                        lrb_dropdown.style.display = 'none';
                    }
                }
            }
            let lrb_modal = document.querySelector('#{{ $route->lrb_modal_id }}');
            if(lrb_modal) {
                if (!event.target.closest('.lrb-modal-outer') && event.target.closest('.lrb-modal-wrapper')) {
                    if(lrb_modal.style.display == 'block') {
                        lrb_modal.style.display = 'none';
                    }
                }
            }
        });

        // hide dropdown if press Esc
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                let lrb_dropdown = document.querySelector('#{{ $route->lrb_dropdown_id }}');
                if(lrb_dropdown) {
                    lrb_dropdown.style.display = 'none';
                }
                let lrb_modal = document.querySelector('#{{ $route->lrb_modal_id }}');
                if(lrb_modal) {
                    lrb_modal.style.display = 'none';
                }
            }
        });
    </script>
@endpush