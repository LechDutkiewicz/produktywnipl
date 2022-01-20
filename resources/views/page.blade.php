@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')

    @component('components.skewy-container', ['variant' => 'white', 'classes' => 'no-padding-top'])
    <div class="container container--padding">
      <div class="row justify-content-center">
        <div class="col-lg-9">
          @component('components.shadow-box', ['variant' => 'white', 'row' => false, 'classes' => 'main-blog'])
            <div class="row justify-content-center post">
              <div class="col-md-10 entry-content"> 
                @include('partials.content-page')
              </div>
            </div> 
          @endcomponent
        </div>
        <div class="col-lg-3 sidebar">
          @php(dynamic_sidebar('sidebar-post'))
          <section class="widget widget-banner banner--pkpk">
            <p class="widget-banner__subheading">
              Nowa edycja kursu online!
            </p>
            <h3 class="widget-banner__title">Produktywność Krok Po Kroku</h3>
            <a href="https://produktywnosckrokpokroku.pl" target="_blank" rel="nofollow" class="btn btn--border-white btn--full-width">
              Zapisz się
            </a>
          </section>
        </div>
      </div>
    </div>
    @endcomponent
  @endwhile

  @include('modules.newsletter', ['origin' => get_the_title() . '-footer'])
@endsection
