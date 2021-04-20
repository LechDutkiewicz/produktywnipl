{{--
  Template Name: Kursy online
--}}

@extends('layouts.app')

@php($frontpage_id = get_option( 'page_on_front' ))
@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    {{-- @include('modules.interviews') --}}
    @php
    $your_query = new WP_Query( 'pagename=home' );
    @endphp
    @while ( $your_query->have_posts() ) @php($your_query->the_post())
      @include('modules.courses')
      @include('modules.szkolenia')
    @endwhile

    @php(wp_reset_postdata())
    
    @include('modules.newsletter')
  @endwhile
@endsection
