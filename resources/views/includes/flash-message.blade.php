@if (Session::get('flash_message') != null)
    <div id="flash-message" class="{{ Session::get('flash_type') != null ? 'flash-message--' . Session::get('flash_type') : '' }}">
        {{ Session::get('flash_message') }}
    </div>
@endif
