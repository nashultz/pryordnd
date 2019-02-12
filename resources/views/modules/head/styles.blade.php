{{-- Main/Global CSS --}}
@section('styles-global')
    @css('pryordnd/global.css')
@show

<!-- PAGE SPECIFIC STYLES -->
@stack('styles-page-specific')
<!-- /PAGE SPECIFIC STYLES -->