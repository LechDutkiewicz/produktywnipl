{{--
  Template Name: Produktywna Lista
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header')
    @include('modules.newsletter', ['origin' => get_the_title() . '-footer'])
  @endwhile
@endsection
