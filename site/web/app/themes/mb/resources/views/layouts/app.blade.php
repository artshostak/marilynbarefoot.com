<main data-barba="wrapper">
  <div class="loading-container">
    <div class="loading-screen"></div>
  </div>

  @include('partials.header')

  <div class="barba-container <?php if(!is_front_page()): ?> offset-header<?php endif; ?>" role="document" data-barba="container"
  data-barba-namespace="{{ $loaderNamespace }}">
    <div id="body-classes" @php body_class() @endphp>
      @yield('content')
      @include('partials.footer')
    </div>
  </div>

</main>
