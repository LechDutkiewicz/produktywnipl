{{--
  Template Name: Home Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('modules.hero')
    @include('modules.about')
    @include('modules.clients')
    @include('modules.latest-posts')
    {{-- @include('modules.interviews') --}}
    @include('modules.courses')
    @include('modules.szkolenia')
    @include('modules.newsletter', ['origin' => 'home-footer'])
  @endwhile
@endsection

