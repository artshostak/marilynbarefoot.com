<footer class="bottom
  <?php if(is_front_page()): ?> blue
  <?php elseif(is_page('about')): ?> light-blue
  <?php elseif(is_page('clients')): ?> blueberry
  <?php elseif(is_page('services')): ?> topaz
  <?php elseif(is_page('content')): ?> darkish-purple
  <?php endif; ?>
  ">
  <div class="container">
    <div class="grid four-col">
      @php(dynamic_sidebar('sidebar-footer'))
    </div>
    <div class="copyright">
      <small>&copy; Copyright {{the_date('Y')}} {{get_bloginfo()}}</small>
    </div>
  </div>
</footer>
