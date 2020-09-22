<main data-barba="wrapper">
  @include('partials.header')

  <div class="container" role="document" data-barba="container"
  data-barba-namespace="{{ $loaderNamespace }}">
    <div id="body-classes" @php body_class() @endphp>
      @yield('content')
    </div>
  </div>

  @include('partials.footer')
</main>
