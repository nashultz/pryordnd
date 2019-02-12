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
        <!-- MAIN NAV -->
        @section('main-nav')
            @include($primaryNavigation['view-name'])
        @show
        <!-- /MAIN NAV -->

        <!-- BODY WRAPPER -->
        <section class="body-wrapper @stack('body-wrapper-classes')">
            <!-- BODY CONTENT -->
            @section('body-content')

            @show
            <!-- /BODY CONTENT -->
        </section>
        <!-- /BODY WRAPPER -->

        <!-- PRIMARY FOOTER -->
        @section('footer-primary')
            <footer class="footer-primary">
                @section('footer-primary-content')
                    @include('modules.footer.primary.links')
                    @include('modules.footer.primary.company')
                    @include('modules.footer.primary.social')
                    @include('modules.footer.primary.legal')
                @show
            </footer>
        @show
        <!-- /PRIMARY FOOTER -->

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