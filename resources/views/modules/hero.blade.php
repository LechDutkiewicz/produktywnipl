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
      <form action="https://app.getresponse.com/add_subscriber.html" accept-charset="utf-8" method="post" style="position: relative;" class="d-flex getresponse-form" validate>
        <input type="text" name="name" class="name" placeholder="{{ __('Twoje imię', 'produktywni') }}" style="width: 100%;" required/>
        <!-- Pole email (wymagane) -->
        <input type="email" name="email" class="email" placeholder="{{ __('Twój adres e-mail', 'produktywni') }}" style="width: 100%;" required/>
        <!-- Token kampanii -->
        <!-- Pobierz token na: https://app.getresponse.com/campaign_list.html -->
        <input type="hidden" name="campaign_token" value="VX9bP" />
        <!-- Thank you page (optional) -->
        <input type="hidden" name="thankyou_url" value="{{ the_field('getresponse_submit_success_page', 'options') }}"/>
        <!-- Przycisk zapisu -->
        <input type="submit" value="{{ the_field('getresponse_submit_hero', 'options') }}" class="btn btn--large btn--green btn--subscribe" data-ga-action="newsletter-hero" style="top: 0"/>
      </form>
    </div>
  </div>
</section>
