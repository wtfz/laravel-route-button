@props(['route' => null])

<svg class="lrb-modal-alert-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
<h3 class="lrb-modal-alert-title">
    @lang('Are you sure you want to do this?')
</h3>
<div class="lrb-modal-alert-actions">
    <button
        type="submit" 
        class="lrb-modal-alert-confirm">
        @lang('Continue')
    </button>
    <button 
        type="button" 
        class="lrb-modal-alert-cancel" 
        onclick="document.getElementById('{{ $route->lrb_modal_id }}').style.display = 'none'">
        @lang('Cancel')
    </button>
</div>