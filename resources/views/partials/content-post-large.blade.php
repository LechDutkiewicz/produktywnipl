<article @php(post_class('blog-post col-12 blog-post--wide'))>
  <header>
    @if(has_post_thumbnail())
      <div class="blog-post__cover">
        <a href="{{ the_permalink() }}">
          @php(the_post_thumbnail('post-wide'))
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
