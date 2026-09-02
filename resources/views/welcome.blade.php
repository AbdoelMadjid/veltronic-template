@php
    $frontpageView = \App\Support\Frontpage::currentView();
@endphp
@include($frontpageView)
