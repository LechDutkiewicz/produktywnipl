<section class="p-trainings-list widget p-trainings-list--{{ $light ? 'light' : 'dark' }}">
  <h3>{{ __('Oferta szkoleń', 'produktywni') }}</h3>

  @php
  $args = [
    'post_type' => 'training',
    'order'     => 'ASC',
  ];
  @endphp

  <ul>
    @query($args)
      <li>
        <a href="{{ the_permalink() }}">
          <i class="zmdi {{ the_field('icon') }}"></i>
          {{ the_title() }}
        </a>
      </li>
    @endquery
    @php(wp_reset_postdata())
  </ul>
</section>