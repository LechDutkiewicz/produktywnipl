<section id="kursy" class="s-courses">
    @if (have_rows('courses'))
      <div class="d-flex flex-wrap c-courses align-items-center">
        @while(have_rows('courses')) @php(the_row())
          <div class="c-courses__item col-md-6" style="background-image: url({{ the_sub_field('bg') }})">
            <div class="c-courses__item__inner row justify-content-center align-items-center">
              <div class="col-md-10">
                <p class="c-courses__item__heading">{{ the_sub_field('heading') }}</p>
                <h3 class="c-courses__item__title">{{ the_sub_field('title') }}</h3>
                <div class="c-courses__item__content">
                  {{ the_sub_field('content') }}
                </div>
                <a href="{{ the_sub_field('url') }}" target="_blank" rel="nofollow" class="btn btn--green btn--large">{{ __('Zapisz się na kurs', 'produktywni') }}</a>
              </div>
            </div>
          </div>
        @endwhile
      </div>
    @endif
</section>