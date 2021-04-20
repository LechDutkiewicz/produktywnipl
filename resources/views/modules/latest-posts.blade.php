@php
  $args = [
    'posts_per_page' => $simple ? 3 : 4,
  ];

  $i = 0;
@endphp

@haveposts($args)
@component('components.skewy-container', ['variant' => 'white', 'id' => 'blog'])
  <div class="container container--program container--padding">
    <h2 class="std-heading std-heading--full-width">{{ __('Ostatnio na blogu', 'produktywni') }}</h2>

    <div class="row blog-posts">
      @query($args)
        @if($i === 0 && !$simple) 
          <article class="blog-post col-12 col-md-6 col-lg-12">
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
                    <span class="blog-post__meta__separator">•</span>
                    {!! App\post_categories() !!}
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
        @endif

        @if($i > 0 || $simple)
          <article class="blog-post col-md-6 col-lg-4">
            <header>
              @if(has_post_thumbnail())
                <div class="blog-post__cover">
                  <a href="{{ the_permalink() }}">
                    @php(the_post_thumbnail('post-small'))
                  </a>
                </div>
              @endif
              <div class="blog-post__meta">
                <span class="blog-post__meta__date">{{ get_the_date() }}</span>
                <span class="blog-post__meta__separator">•</span>
                {!! App\post_categories() !!}
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
            <footer class="d-flex justify-content-between">
              <p>
                <a class="link link--arrow" href="{{ the_permalink() }}">{{ __('Czytaj więcej', 'produktywni') }}<i class="zmdi zmdi-arrow-right"></i></a>
              </p>
              <p class="blog-post__comments-count">
                ({{ comments_number( 'Brak komentarzy', '1 komentarz', '% komentarzy' ) }})
              </p>
            </footer>
          </article>
        @endif
        @php($i++)
      @endquery
      @php(wp_reset_postdata())
    </div>

    <div class="row justify-content-center c-read-more">
      <div class="col-lg-4">
        <a href="{{ get_permalink(get_page_by_title('Najnowsze wpisy')->ID) }}" class="btn btn--full-width btn--border-secondary">{{ __('Zobacz więcej postów', 'produktywni') }}</a>
      </div>
    </div>
  </div>
@endcomponent
@endhaveposts
