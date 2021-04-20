@php($current = get_queried_object())

<section class="page-hero page-hero--small" style="background-image: url('{{ get_the_post_thumbnail_url($current->ID) }}');">
  <div class="container container--padding">    
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="entry-title">
          {!! App\title() !!}
        </h1>
      </div>

      <div class="col-lg-4">
        {{ get_search_form() }}
      </div>
    </div>
  </div>
</section>