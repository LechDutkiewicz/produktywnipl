@php
$image = get_field('hero_bg');
@endphp

<section class="page-hero @php($small ? 'page-hero--small' : '')" style="background-image: url('{{ $image['url'] }}');">
  <div class="container container--flex container--padding">
    <div class="page-hero__content">
      <h1 class="page-hero__heading">
        {{ the_field('hero_heading') }}
      </h1>
      <div class="page-hero__lead">
        {{ the_field('hero_content') }}
      </div>
        @include('modules.newsletter-form')
      </form>
    </div>
  </div>
</section>
