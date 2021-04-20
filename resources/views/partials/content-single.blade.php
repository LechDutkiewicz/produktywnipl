<article @php(post_class())>
  <header class="s-post__header" style="background-image: url({{ get_the_post_thumbnail_url() }})">
    <div class="container container--padding">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <div class="s-post__header__inner">
            <div class="blog-post__meta">
              @include('partials/entry-meta')
            </div>
            <h1 class="entry-title">{{ get_the_title() }}</h1>
          </div>
        </div>
        <div class="col-lg-4">
          {{ get_search_form() }}
        </div>
      </div>
    </div>
  </header>

  @component('components.skewy-container', ['variant' => 'white'])
  <div class="container container--padding">
    <div class="row">
      <div class="col-lg-9">
      @component('components.shadow-box', ['variant' => 'white', 'row' => false])
        
        <div class="row justify-content-center">
          <div class="col-sm-11 col-md-10"> 
            <div class="entry-content">
              @php(the_content())
            </div>
            <footer>
              @include('partials.social-sharers')
              {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
            </footer>
          </div>
        </div>
        
      @endcomponent
        <div class="c-related">
          @php(related_posts())
        </div>
        <div class="c-comments">
          @php(comments_template('/partials/comments.blade.php'))
        </div>
      </div>
      <div class="col-lg-3 sidebar">
        @php(dynamic_sidebar('sidebar-post'))
      </div>
    </div>
  </div>
  @endcomponent
 
</article>
