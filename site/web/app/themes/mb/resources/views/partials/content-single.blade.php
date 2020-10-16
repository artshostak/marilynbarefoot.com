<article @php(post_class('single-article mb-xl'))>
  <header class="page-header mb-m">
    <h2 class="entry-title">
      {!! $title !!}
    </h2>
  </header>

  <div class="grid">
    <div class="left mb-m">
      <div class="small mb-m">
        @include('partials/entry-meta')
      </div>

      <section class="entry-content">
        @php(the_content())
      </section>

      <footer class="author mt-m">    
        <span rel="author" class="fn">
          — {{ get_the_author() }}
        </span>
      </footer>
    </div>

    <div class="right">
      <?= get_the_post_thumbnail('', 'full'); ?>
      <figcaption class="small py">
        {{the_post_thumbnail_caption()}}
      </figcaption>
    </div>
  </div>
</article>
