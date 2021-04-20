@component('components.skewy-container', ['variant' => 'gray', 'id' => 'wywiady'])
    <div class="container container--program container--padding">
      <div class="row justify-content-between align-items-center">
        <div class="col">
          <h2 class="std-heading std-heading--full-width">{{ __('Porozmawiane', 'produktywni') }}</h2>
        </div>
        <div class="col d-flex justify-content-end">
          <a href="#" class="link link--arrow">{{ __('Zobacz więcej wywiadów', 'produktywni') }}<i class="zmdi zmdi-arrow-right"></i></a>
        </div>
      </div>
    @php
      $args = [
        'posts_per_page' => 1,
      ];

      $i = 0;
    @endphp

    <div class="row blog-posts">
      @query($args)
        <article class="blog-post col-12">
          <div class="row align-items-center">
            <div class="col-lg-6">
              @if(has_post_thumbnail())
                <div class="blog-post__cover">
                  <a href="{{ the_permalink() }}">
                    @php(the_post_thumbnail('post-large'))
                  </a>
                </div>
              @endif
            </div>
            <div class="col-lg-6">
              <header>
                <div class="blog-post__meta">
                  <span class="blog-post__meta__date">{{ the_date() }}</span>
                </div>

                <h3 class="blog-post__title">
                  <a href="{{ the_permalink() }}">
                    {{ the_title() }}
                  </a>
                </h3>
                
              </header>
              <main class="blog-post__excerpt">
                @php(the_excerpt())
              </main>
              <footer class="blog-post__footer d-flex justify-content-between align-items-center">
                <p>
                  <a class="btn btn--border-green" href="{{ the_permalink() }}">{{ __('Czytaj więcej', 'produktywni') }}<i class="zmdi zmdi-arrow-right"></i></a>
                </p>
                <p class="blog-post__comments-count">
                  ({{ comments_number( 'Brak komentarzy', '1 komentarz', '% komentarzy' ) }})
                </p>
              </footer>
            </div>
          </div>
        </article>

      @endquery
      @php(wp_reset_postdata())
    </div>
  </div>
@endcomponent
