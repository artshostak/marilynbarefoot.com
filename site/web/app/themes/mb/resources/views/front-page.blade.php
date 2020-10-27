@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    {{-- Hero --}}
    <section class="hero fullpage">
      <div class="container py-l">
        <div class="overlays">
          @php($animation = get_field('animation'))
          @if($animation)
            <div
              id="lottie"
              data-name="{{$animation['title']}}"
              data-animation-path="{{$animation['url']}}"
              data-anim-loop="false"
            ></div>
          @endif
          <div class="info lax"
            data-lax-opacity="400 1, 200 1, 0 0" data-lax-anchor="self">
            <div class="wrapper max-550">
              @includeFirst(['partials.content-page', 'partials.content'])
            </div>
          </div>
          <div class="logo lax"
            data-lax-translate-x="500 0, 200 -500px, 0 -1000" data-lax-anchor="self">
            <svg xmlns="http://www.w3.org/2000/svg" width="203" height="26" viewBox="0 0 203 26">
              <g fill="none" fill-rule="evenodd">
                <g fill="currentColor">
                    <path d="M8.627 20.412L2.657 3.461 2.531 3.461 2.531 20.412 0 20.412 0 .709 4.345.709 9.877 16.753 9.971 16.753 15.221.709 19.503.709 19.503 20.412 16.784 20.412 16.784 3.461 16.659 3.461 10.908 20.412 8.627 20.412M31.519 13.657l-3.063.656c-2.157.47-3.532.876-3.532 2.533 0 1.158.781 2.033 2.345 2.033 2.406 0 4.25-1.814 4.25-4.566v-.656zm2.5 4.066c0 .719.407 1.063 1.063 1.063.313 0 .813-.094 1.188-.313v1.407c-.469.47-1.032.813-2.094.813-1.407 0-2.407-1.063-2.563-2.69-.75 1.596-2.688 2.784-4.907 2.784-2.657 0-4.376-1.439-4.376-3.784 0-2.596 2.22-3.66 5.501-4.316l3.688-.75v-.532c0-1.876-1.094-3.034-3-3.034-1.97 0-3.032 1.158-3.438 2.752l-2.313-.312C23.3 8.246 25.331 6.37 28.55 6.37c3.438 0 5.47 1.751 5.47 5.223v6.13zM46.457 9.34c-.75-.406-1.282-.562-2.126-.562-1.969 0-3.438 1.782-3.438 4.409v7.225H38.3V6.745h2.594v2.784c.5-1.564 1.907-3.16 3.876-3.16.844 0 1.47.22 1.938.626l-.25 2.346M49.015 20.412h2.594V6.745h-2.594v13.667zm-.063-16.763h2.688V.709h-2.688v2.94zM55.14 20.412L57.734 20.412 57.734.709 55.14.709zM63.234 25.666L65.452 20.38 59.701 6.745 62.421 6.745 66.765 17.253 66.89 17.253 71.079 6.745 73.641 6.745 65.765 25.666 63.234 25.666M78.077 20.412h-2.594V6.745h2.594v2.44c.657-1.658 2.5-2.815 4.532-2.815 3.563 0 5.001 2.377 5.001 5.566v8.476h-2.594v-8.257c0-2.283-1.094-3.721-3.25-3.721-2.063 0-3.689 1.626-3.689 4.128v7.85M100.69 11.31v6.881h5.689c2.938 0 4.47-1.282 4.47-3.409 0-2.157-1.532-3.472-4.47-3.472h-5.689zm0-2.095h5.501c2.845 0 4.064-1.22 4.064-3.127 0-1.876-1.22-3.159-4.064-3.159h-5.5v6.286zm5.751 11.197h-8.376V.709h8.033c4.876 0 6.876 2.127 6.876 5.254 0 2.283-1.626 3.847-3.72 4.222 2.407.407 4.282 2.002 4.282 4.816 0 3.41-2.5 5.411-7.095 5.411zM124.693 13.657l-3.063.656c-2.157.47-3.532.876-3.532 2.533 0 1.158.781 2.033 2.344 2.033 2.407 0 4.25-1.814 4.25-4.566v-.656zm2.5 4.066c0 .719.407 1.063 1.063 1.063.312 0 .813-.094 1.188-.313v1.407c-.469.47-1.031.813-2.094.813-1.407 0-2.407-1.063-2.563-2.69-.75 1.596-2.688 2.784-4.907 2.784-2.657 0-4.376-1.439-4.376-3.784 0-2.596 2.219-3.66 5.501-4.316l3.688-.75v-.532c0-1.876-1.094-3.034-3-3.034-1.97 0-3.032 1.158-3.439 2.752l-2.313-.312c.532-2.565 2.563-4.441 5.783-4.441 3.438 0 5.47 1.751 5.47 5.223v6.13zM139.63 9.34c-.75-.406-1.281-.562-2.125-.562-1.969 0-3.438 1.782-3.438 4.409v7.225h-2.594V6.745h2.594v2.784c.5-1.564 1.906-3.16 3.876-3.16.843 0 1.468.22 1.937.626l-.25 2.346M151.13 12.53c-.093-2.188-1.313-4.19-3.907-4.19-2.469 0-3.938 1.939-4.25 4.19h8.157zm2.594 3.285c-.687 3.096-2.969 4.972-6.376 4.972-4.063 0-7.032-2.752-7.032-7.005 0-4.316 2.97-7.412 6.907-7.412 4.345 0 6.564 3.096 6.564 6.817v1.033H142.91c.125 2.658 2.032 4.535 4.47 4.535 2.281 0 3.626-1.095 4.188-3.19l2.156.25zM154.91 8.621V6.745h2.093V5.15c0-2.909 1.657-4.816 4.533-4.816 2.344 0 3.656 1.063 4.282 3.127l-1.782.625c-.344-1.063-1.125-1.876-2.375-1.876-1.438 0-2.094 1.032-2.094 2.659v1.876h3.844v1.876h-3.844v11.791h-2.564V8.622h-2.094M171.192 18.786c2.782 0 4.344-2.159 4.344-5.192 0-3.065-1.562-5.192-4.344-5.192-2.75 0-4.282 2.127-4.282 5.192 0 3.033 1.531 5.192 4.282 5.192zm0 2.001c-4 0-6.939-2.94-6.939-7.193s2.938-7.224 6.939-7.224c4.032 0 7.001 2.97 7.001 7.224 0 4.253-2.97 7.193-7.001 7.193zM186.608 18.786c2.782 0 4.344-2.159 4.344-5.192 0-3.065-1.562-5.192-4.344-5.192-2.75 0-4.282 2.127-4.282 5.192 0 3.033 1.532 5.192 4.282 5.192zm0 2.001c-4.001 0-6.939-2.94-6.939-7.193s2.938-7.224 6.939-7.224c4.032 0 7.001 2.97 7.001 7.224 0 4.253-2.97 7.193-7.001 7.193zM196.186 8.621h-2.062V7.214l.875-.156c1.28-.25 1.563-.876 1.875-2.19l.406-1.907h1.47v3.784h3.844v1.876h-3.844v8.288c0 1.22.5 1.783 1.687 1.783.875 0 1.781-.375 2.563-.813v1.751c-1 .75-2 1.157-3.5 1.157-1.938 0-3.314-.907-3.314-3.565v-8.6" transform="translate(-41 -30) translate(-1 -1) translate(2 31) translate(40)"/>
                </g>
              </g>
            </svg>
          </div>
        </div>
      </div>
    </section>
  @endwhile

  {{-- Clients --}}
  @php($clients = get_field('clients'))
  @if($clients)
    <section class="clients">
      <div class="clients">
        <header class="container">
          <div class="border-top flex spaced centered">
            <div class="left">
              @php($field = get_field_object('clients'))
              <p>{{$field['label']}}</p>
            </div>
            <div class="right">
              <a class="underline" href="/clients">See all &rsaquo;</a>
            </div>
          </div>
        </header>
        <div class="scrollable">
          <div class="scroll">
            @foreach($clients as $c)
              @include('partials.content-client', ['id' => $c->ID])
            @endforeach
          </div>
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
    <section class="services">
      <div class="services">
        <header class="container">
          <div class="border-top flex spaced centered">
            <div class="left">
              @php($field = get_field_object('services'))
              <p>{{$field['label']}}</p>
            </div>
            <div class="right">
              <a class="underline" href="/services">See all &rsaquo;</a>
            </div>
          </div>
        </header>
        <div class="scrollable">
          <div class="scroll">
            @foreach($services as $s)
              @include('partials.content-service', ['id' => $s->ID])
            @endforeach
          </div>
        </div>
      </div>
    </section>
  @endif

  @include('partials.prefooter')
@endsection
