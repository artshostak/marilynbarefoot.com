@if(get_field('credentials'))
  <section class="credentials border-top">
    <div class="container">
      <header class="pt-xl">
        @php($field = get_field_object('credentials'))
        <h4>{{$field['label']}}</h4>
      </header>
      <div class="columns two-col">
        {{the_field('credentials')}}
      </div>
    </div>
  </section>
@endif