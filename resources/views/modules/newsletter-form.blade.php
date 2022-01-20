@php
$uniq_id = bin2hex(random_bytes(20))
@endphp

<form action="https://hook.integromat.com/pjqk9gtx51spuu1j8vj6why48yoccfn2" accept-charset="utf-8" method="post" style="position: relative;" class="d-flex getresponse-form" validate>
  <input type="text" name="name" class="name" placeholder="{{ __('Twoje imię', 'produktywni') }}" style="width: 100%;" required/>
  <!-- Pole email (wymagane) -->
  <input type="email" name="email" class="email" placeholder="{{ __('Twój adres e-mail', 'produktywni') }}" style="width: 100%;" required/>
  <!-- Token kampanii -->
  <!-- Pobierz token na: https://app.getresponse.com/campaign_list.html -->
  <input type="hidden" name="campaign_token" value="VX9bP" />
  <!-- Thank you page (optional) -->
  <input type="hidden" name="thankyou_url" value="{{ the_field('getresponse_submit_success_page', 'options') }}"/>
  <!-- Skąd idzie zapis -->
  <input type="hidden" name="origin" value="{{ $origin }}">
  <!-- Przycisk zapisu -->
  <input type="submit" id="{{ $uniq_id }}" value="{{ the_field('getresponse_submit_section', 'options') }}" class="g-recaptcha btn btn--large btn--green btn--subscribe" style="top: 0" data-ga-action="newsletter-section"/>
</form>