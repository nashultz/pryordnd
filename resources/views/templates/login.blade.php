<!doctype html>
<html class="" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- META -->
        @include('modules.head.meta')
        <!-- /META -->

        <!-- STYLES -->
        @include('modules.head.styles')
        <!-- /STYLES -->

        <!-- SCRIPTS -->
        @include('modules.head.scripts')
        <!-- /SCRIPTS -->
    </head>
    <body>
        <!-- BODY WRAPPER -->
        <section class="body-wrapper @stack('body-wrapper-classes')">
            <!-- BODY CONTENT -->
            @section('body-content')

            @show
            <!-- /BODY CONTENT -->
        </section>
        <!-- /BODY WRAPPER -->

        <!-- GLOBAL SCRIPTS -->
        @section('scripts-global')
            @include('modules.scripts.global')
        @show
        <!-- /GLOBAL SCRIPTS -->

        <!-- PAGE SPECIFIC SCRIPTS -->
        @stack('scripts-page-specific')
        <!-- /PAGE SPECIFIC SCRIPTS -->

    </body>
</html>