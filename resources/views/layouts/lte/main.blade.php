<!DOCTYPE html>
<html lang="en">

    @include('layouts.lte.head')


<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

<div class="app-wrapper">

    {{-- HEADER --}}
    @include('layouts.lte.navbar')

    {{-- SIDEBAR --}}
    @include('layouts.lte.sidebar')

    {{-- MAIN CONTENT --}}
    <main class="app-main"> 
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.lte.footer')

</div>

{{-- SCRIPTS --}}
@include('layouts.lte.script')

</body>

</html>
