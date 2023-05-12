@include('admin.layouts.header')
@include('admin.layouts.sidebar')

<main id="main" class="main" >
    <section class="home-content">
        @yield('home-content')
    </section>
</main>
<!-- End #main -->


@include('admin.layouts.footer')
