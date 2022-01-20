{{--
  Template Name: Szkolenia
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')

    @component('components.skewy-container', ['variant' => 'white', 'classes' => 'no-padding-top'])
    <div class="container container--padding">
      <div class="row">
        <div class="col-lg-9">
          @component('components.shadow-box', ['variant' => 'white', 'row' => false, 'classes' => 'main-blog'])
            <div class="row justify-content-center">
              <div class="col-md-10"> 
                <div class="row ajax-posts">
                  @php
                  $args = [
                    'post_type' => 'training',
                    'order'     => 'ASC',
                  ];
                  @endphp

                  @query($args)
                    <article class="s-training col-lg-6">
                      @php($thumb = get_field('thumbnail'))

                      @if($thumb)
                        <div class="s-training__cover">
                          <i class="zmdi {{ the_field('icon') }}"></i>
                          <img src="{{ $thumb['url'] }}" />
                        </div>
                      @endif
                      <p class="s-training__subheading">{{ the_field('length') }}</p>
                      <h3 class="s-training__title">
                        <a href="{{ the_permalink() }}">{{ the_title() }}</a>
                      </h3>
                      <div class="s-training__excerpt">
                        {{ the_field('excerpt') }}
                      </div>
                      <a href="{{ the_permalink() }}" class="link link--arrow">{{ __('Czytaj więcej', 'produktywni') }}<i class="zmdi zmdi-arrow-right"></i></a>
                    </article>
                  @endquery
                  @php(wp_reset_postdata())
                </div>
              </div>
            </div> 
          @endcomponent
        </div>
        <div class="col-lg-3 sidebar">
          @include('partials.trainings-list')
          @php(dynamic_sidebar('sidebar-trainings'))
        </div>
      </div>
    </div>
    @endcomponent
  @endwhile

  @include('modules.newsletter', ['origin' => get_the_title() . '-footer'])
  @include('modules.latest-posts', ['simple' => true])
@endsection
