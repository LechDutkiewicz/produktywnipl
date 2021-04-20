<div id="produktywna-lista" class="footer-newsletter">
  <div class="container container--padding">
    <div class="row">
      <div class="col-12">
        <h2>{{ __('Produktywna lista', 'produktywni') }}</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-8">
        <p>{{ __('Dołącz do 1800 czytelników a otrzymasz Produktywną Paczkę zawierającą m.in. Excel pomagający w planowaniu i realizacji celów, kalendarz tygodnia ułatwiający zarządzanie zadaniami, koło życia i wiele innych!', 'produktywni') }}</p>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-8">
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
          <input type="submit" value="{{ the_field('getresponse_submit_section', 'options') }}" class="btn btn--large btn--green btn--subscribe" style="top: 0" data-ga-action="newsletter-section"/>
        </form>
      </div>
    </div>
  </div>
</div>