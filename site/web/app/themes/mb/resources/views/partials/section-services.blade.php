@php($services = get_field('services'))
@if($services)
  <section class="services">
    @foreach($services as $s)
      @include('partials.content-service-full', ['id' => $s->ID])
    @endforeach
  </section>
@endif