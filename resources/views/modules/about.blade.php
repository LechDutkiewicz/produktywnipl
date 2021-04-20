@component('components.skewy-container', ['variant' => 'white', 'id' => 'o-mnie'])
  <div class="container container--about container--padding">
    <div class="row">
      <div class="col-lg-6">
        <h2 class="std-heading std-heading--full-width">{{ the_field('about_heading') }}</h2>
        <div class="std-lead">{{ the_field('about_lead') }}</div>
        <div class="std-content">{{ the_field('about_content') }}</div>

        @if (have_rows('social_media'))
          <ul class="std-social-media">
            @while(have_rows('social_media')) @php(the_row())
              <li>
                <a href="{{ the_sub_field('url') }}"><i class="zmdi {{ the_sub_field('icon') }}"></i></a>
              </li>
            @endwhile
          </ul>
        @endif

      </div>

      <div class="col-lg-5 offset-lg-1">
        <div class="video-container">
          <iframe class="video" width="560" height="315" src="https://www.youtube.com/embed/{{ the_field('youtube_id') }}?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
        <p class="video-subheading">{{ __('Moje najnowsze wideo', 'produktywni') }}</p>
        <p>{{ the_field('youtube_title') }}</p>
        <a href="https://www.youtube.com/channel/UCAvoPJDc8JNAAoKu_3JWHvQ" target="_blank" rel="nofollow" class="link link--arrow">{{ __('Zobacz więcej video', 'produktywni') }}<i class="zmdi zmdi-arrow-right"></i></a>
      </div>
    </div>
  </div>
@endcomponent
