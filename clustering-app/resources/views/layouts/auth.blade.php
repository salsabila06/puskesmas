@include('layouts.partials.header')

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex align-items-center justify-content-center">
                <div class="col-lg-5 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="p-4 m-3">
                        <img src="{{ asset('assets/img/auth-logo.svg') }}" alt="logo" width="150"
                            class="shadow-light  mb-5 mt-2 d-block mx-auto">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif

                        @yield('content')

                        {{-- <div class="text-center mt-5 text-small">
                            Copyright &copy; Your Company. Made with 💙 by Stisla
                            <div class="mt-2">
                                <a href="#">Privacy Policy</a>
                                <div class="bullet"></div>
                                <a href="#">Terms of Service</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('layouts.partials.script')
</body>

</html>
