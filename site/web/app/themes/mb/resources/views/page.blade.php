@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <section class="single-page container">
      <div id="page-{{basename(get_permalink())}}">
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
      </div>
    </section>

    @if(is_page('About'))
      @if(get_field('credentials'))
        <section class="credentials container">
          <header class="border-top pt-xl">
            @php($field = get_field_object('credentials'))
            <h4>{{$field['label']}}</h4>
          </header>
          <div class="wrapper max-550">
            {{the_field('credentials')}}
          </div>
        </section>
      @endif
    @endif

    @include('partials.prefooter')
  @endwhile
@endsection
