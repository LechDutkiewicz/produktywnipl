<article @php(post_class())>
  <header class="s-post__header s-post__header--training" style="background-image: url({{ get_the_post_thumbnail_url() }})">
    <div class="container container--padding">
      <div class="row align-items-center">
        <div class="col-lg-7">
          <div class="s-post__header__inner">
            <h1 class="entry-title">
              <i class="zmdi {{ the_field('icon') }}"></i>
              {{ get_the_title() }}
            </h1>
            <div class="s-goals">
              <p class="s-goals__title">{{ __('Cele:', 'produktywni') }}</p>
              @if(have_rows('goals'))
                <ul>
                  @while(have_rows('goals')) @php(the_row())
                    <li>
                      <i class="zmdi zmdi-check"></i>
                      {{ the_sub_field('goal') }}
                    </li>
                  @endwhile
                </ul>
              @endif
            </div>
            <h2 class="ss-training__price">
              <strong>{{ __('Cena:', 'produktuwni') }}</strong> {{ the_field('price') }}
            </h2>
            <a href="#kontakt" class="scroll-to-btn btn btn--large btn--white">{{ __('Zamów szkolenie', 'produktywni') }}</a>
          </div>
        </div>
        <div class="col-lg-3 offset-lg-2">
          @include('partials.trainings-list', ['light' => true])
        </div>
      </div>
    </div>
  </header>

  @component('components.skewy-container', ['variant' => 'white'])
  <div class="container container--padding">
    <div class="row">

      <div class="col-lg-6">
        <h2 class="ss-training__heading">{{ the_field('why_heading') }}</h2>
        <div class="std-content ss-training__content">
          {{ the_field('why_content') }}
        </div>
        <a href="#kontakt" class="btn btn--border-green btn--full-width">{{ __('Skontaktuj się ze mną', 'produktywni') }}</a>
      </div>

      <div class="col-lg-5 offset-lg-1 ss-training__box">
        @component('components.shadow-box', ['variant' => 'white', 'row' => false])
          <div class="row justify-content-center">
            <div class="col-md-10"> 
              <p class="upper-subheading">{{ the_field('who_upper_heading') }}</p>
              <h2 class="ss-training__heading">{{ the_field('who_heading') }}</h2>
              <div class="s-goals s-goals--dark">
                @if(have_rows('who_goals'))
                  <ul>
                    @while(have_rows('who_goals')) @php(the_row())
                      <li>
                        <i class="zmdi zmdi-check"></i>
                        {{ the_sub_field('goal') }}
                      </li>
                    @endwhile
                  </ul>
                @endif
              </div>
            </div>
          </div>
        @endcomponent
      </div>
      
    </div>
  </div>
  @endcomponent

  @component('components.skewy-container', ['variant' => 'gray', 'classes' => 'ss-days'])
  <div class="container container--padding">
    <div class="row justify-content-center">

      @if(have_rows('days'))
        @while(have_rows('days')) @php(the_row())
          <div class="col-lg-5 ss-day">
            <h3 class="ss-day__heading">{{ the_sub_field('heading') }}</h3>
            @if(have_rows('goals'))
              <div class="s-goals s-goals--dark">
                <ul>
                  @while(have_rows('goals')) @php(the_row())
                    <li>
                      <i class="zmdi zmdi-check"></i>
                      {{ the_sub_field('goal') }}
                    </li>
                  @endwhile
                </ul>
              </div>
            @endif
          </div>
        @endwhile
      @endif
    </div>
    <div class="row">
      <a href="#kontakt" class="btn btn--border-green btn--full-width">{{ __('Zamów szkolenie', 'produktywni') }}</a>
    </div>
  </div>
  @endcomponent
 
</article>

@include('modules.newsletter')