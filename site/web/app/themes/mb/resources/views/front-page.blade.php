@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <section class="hero fullpage">
      <div class="container py-l">
        @php($animation = get_field('animation'))
        @if($animation)
          <div
            id="lottie"
            data-name="{{$animation['title']}}"
            data-animation-path="{{$animation['url']}}"
            data-anim-loop="false"
          /></div>
        @endif
        <div class="wrapper max-550">
          @includeFirst(['partials.content-page', 'partials.content'])
        </div>
      </div>
    </section>
  @endwhile

  {{-- Clients --}}
  @php($clients = get_field('clients'))
  @if($clients)
    <section class="clients container">
      <header class="grid">
        <div class="offset-2 grid border-top flex spaced centered">
          <div class="left">
            @php($field = get_field_object('clients'))
            <p>{{$field['label']}}</p>
          </div>
          <div class="right">
            <a href="/clients">View All</a>
          </div>
        </div>
      </header>
      <div class="clients grid">
        <div class="offset-2 grid flex spaced centered">
          @foreach($clients as $c)
            @include('partials.content-client', ['id' => $c->ID])
          @endforeach
        </div>
      </div>
    </section>
  @endif

  {{-- About --}}
  @if(get_field('about'))
    <section class="about">
      @while(have_rows('about')) @php(the_row())
        <div class="container grid standard">
          <div class="left">
            <h3>{{the_sub_field('heading')}}</h3>
            <div class="h4">
              {{the_sub_field('description')}}
            </div>
            @php($link = get_sub_field('link'))
            @include('partials.link', ['class' => 'button'])
          </div>
          <div class="right">
            @php($image = get_sub_field('image'))
            @include('partials.image')
          </div>
        </div>
      @endwhile
    </section>
  @endif

  {{-- Services --}}
  @php($services = get_field('services'))
  @if($services)
    <section class="services container">
      <header class="grid">
        <div class="offset-2 grid border-top flex spaced centered">
          <div class="left">
            @php($field = get_field_object('services'))
            <p>{{$field['label']}}</p>
          </div>
          <div class="right">
            <a href="/services">View All</a>
          </div>
        </div>
      </header>
      <div class="services grid">
        <div class="offset-2 grid flex spaced centered">
          @foreach($services as $s)
            @include('partials.content-service', ['id' => $s->ID])
          @endforeach
        </div>
      </div>
    </section>
  @endif

  @include('partials.prefooter')
@endsection
