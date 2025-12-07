<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.lte.head')
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

<div class="app-wrapper">

    {{-- HEADER --}}
    @include('layouts.lte.navbar')

    {{-- SIDEBAR --}}
    @include('layouts.lte.sidebar')

    {{-- MAIN CONTENT --}}
    <main class="app-main">

        {{-- Breadcrumb --}}
        <div class="app-content-header">
            <div class="container-fluid">
                @yield('breadcrumb')
            </div>
        </div>

        {{-- Content --}}
        <div class="app-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    @include('layouts.lte.footer')

</div>

{{-- SCRIPTS --}}
@include('layouts.lte.script')

</body>

</html>
