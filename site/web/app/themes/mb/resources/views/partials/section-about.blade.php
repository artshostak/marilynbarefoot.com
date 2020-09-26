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