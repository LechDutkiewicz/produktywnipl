@extends('layouts.app')
@php
$i = 0;
global $wp_query;
$paged = (get_query_var('paged')) ? true : false;
@endphp

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  @component('components.skewy-container', ['variant' => 'white', 'classes' => 'no-padding-top'])
  <div class="container container--padding">
    <div class="row">
      <div class="col-lg-9">
        @component('components.shadow-box', ['variant' => 'white', 'row' => false, 'classes' => 'main-blog'])
          <div class="row justify-content-center">
            <div class="col-md-10"> 
              <div class="d-flex flex-wrap ajax-posts">
                @while (have_posts()) @php(the_post())
                  @if($i < 2 && !$paged)
                    @include ('partials.content-post-large')
                  @else
                    @include ('partials.content-'.(get_post_type() === 'post' ?: get_post_type()))
                  @endif
                  @php($i++)
                @endwhile
              </div>
            </div>
          </div> 
        @endcomponent
        @php(load_more_button())
      </div>
      <div class="col-lg-3 sidebar">
        @php(dynamic_sidebar('sidebar-post'))
      </div>
    </div>
  </div>
  @endcomponent

@include('modules.newsletter')
@endsection

