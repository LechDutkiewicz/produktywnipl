@component('components.skewy-container', ['variant' => 'white', 'id' => 'kontakt'])
  <div class="container container--contact container--padding">
    <div class="row">
      <div class="col-lg-6">
        <h2 class="std-heading">{{ the_field('contact_heading', 'option') }}</h2>
        <div class="std-content">{{ the_field('contact_content', 'option') }}</div>

        <address>
          {{ the_field('contact_address', 'option') }}
        </address>

        <p class="contact__email">
          <a href="mailto:{{ the_field('contact_email', 'option') }}"><i class="zmdi zmdi-email"></i>{{ the_field('contact_email', 'option') }}</a>
        </p>

        @if (have_rows('contact_people'))
          <div class="contacts-list">
            @while(have_rows('contact_people')) @php(the_row())
              <div class="contacts-list__item">
                <div class="contacts-list__item-icon">
                  <i class="zmdi zmdi-email"></i>
                </div>
                <div class="contacts-list__item-content">
                  <p class="contacts-list__email">
                    <a href="mailto:{{ the_sub_field('email') }}">{{ the_sub_field('email') }}</a>
                  </p>
                  <div class="contacts-list__name">
                    <strong>{{ the_sub_field('name') }}</strong><span class="contacts-list__name-separator">|</span>{{ the_sub_field('role') }}
                  </div>
                </div>
              </div>
            @endwhile
          </div>
        @endif
      </div>

      <div class="col-lg-6 contact-form">
        @php
          $form = get_field('contact_form', 'option');
          $shortcode = '[contact-form-7 id="' . $form->ID .'" title="' . $form->post_title . '"]';
          echo do_shortcode( $shortcode );
        @endphp
      </div>
    </div>
  </div>
@endcomponent
