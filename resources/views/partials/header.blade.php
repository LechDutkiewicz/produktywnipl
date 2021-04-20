<header id="main-header" class="banner banner--landing white-logo">
  <div class="container container--flex justify-content-between container--padding">

    <a class="brand" href="{{ home_url('/') }}">
      @include('partials.logo')
      @include('partials.logo-color')
    </a>

    <button id="open-mobile-nav" class="hamburger hamburger--3dy hidden-lg-up" type="button">
      <span class="hamburger-box">
        <span class="hamburger-inner"></span>
      </span>
    </button>

    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>

    <nav class="nav-cta">
      <ul class="nav">
        <li><a href="#produktywna-lista" class="btn btn--bg-transparent btn--border-white scroll-to-btn">{{ the_field('getresponse_submit_navbar', 'options') }}</a></li>
      </ul>
    </nav>
  </div>
</header>
