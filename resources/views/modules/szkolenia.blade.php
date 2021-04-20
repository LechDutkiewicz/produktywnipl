@component('components.skewy-container', ['variant' => 'white', 'id' => 'szkolenia'])
  <div class="container container--trainings container--padding">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <h2 class="std-heading std-heading--full-width">{{ the_field('szkolenia_heading') }}</h2>
        <div class="std-content">{{ the_field('szkolenia_content') }}</div>
      </div>
      <div class="col-lg-5 d-flex justify-content-lg-end">
        <a href="{{ get_permalink(get_page_by_title('Oferta szkoleń')->ID) }}" class="btn btn--secondary btn--large">{{ __('Sprawdź moje szkolenia', 'produktywni') }}</a>
      </div>
    </div>
  </div>
@endcomponent
