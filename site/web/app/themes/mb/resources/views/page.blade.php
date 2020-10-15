@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <section id="page-{{basename(get_permalink())}}" class="single-page container">
      @include('partials.page-header')
      <div class="grid standard">
        <div class="left">
          <section class="entry-content">
            @includeFirst(['partials.content-page', 'partials.content'])
          </section>
        </div>
        <div class="right">
          <?= get_the_post_thumbnail('', 'full'); ?>
        </div>
      </div>
    </section>

    @if(is_page('About'))
      @include('partials.section-about')
    @elseif(is_page('Services'))
      @include('partials.section-services')
    @elseif(is_page('Clients'))
      @include('partials.section-clients')
    @elseif(is_page('Content'))
      @include('partials.section-content')
    @endif

    @include('partials.prefooter')
  @endwhile
@endsection
