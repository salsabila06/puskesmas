@include('layouts.partials.header')

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('layouts.partials.navbar')
            @include('layouts.partials.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('title') </h1>
                    </div>

                    <div class="section-body">

                        @yield('content')
                    </div>
                </section>
            </div>

            @include('layouts.partials.footer')

        </div>
    </div>

    @include('layouts.partials.script')

</body>

</html>
