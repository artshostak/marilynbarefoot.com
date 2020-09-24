<footer class="bottom <?php if(is_front_page()): ?> blue<?php endif; ?>">
  <div class="container">
    <div class="grid four-col">
      @php(dynamic_sidebar('sidebar-footer'))
    </div>
    <div class="copyright">
      <small>&copy; Copyright {{the_date('Y')}} {{get_bloginfo()}}</small>
    </div>
  </div>
</footer>
