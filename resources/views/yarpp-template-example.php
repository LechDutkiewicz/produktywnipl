<?php 
/*
YARPP Template: Produktywni
Author: Thom Krupa
Description: A simple example YARPP template.
*/
?>
<?php if (have_posts()):?>
<h2 class="s-heading-post">Podobne wpisy:</h2>
<div class="row">
	<?php while (have_posts()) : the_post(); ?>
		<article class="blog-post col-lg-6">
			<header>
				<?php if (has_post_thumbnail()) : ?>
					<div class="blog-post__cover">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('post-small'); ?>
						</a>
					</div>
				<?php endif; ?>
				<div class="blog-post__meta">
					<span class="blog-post__meta__date"><?php the_date(); ?></span>
					<span class="blog-post__meta__separator">•</span>
					<?php App\post_categories() ?>
				</div>

				<h3 class="blog-post__title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h3>  
			</header>
			<main class="blog-post__excerpt">
				<?php the_excerpt(); ?>
			</main>
			<footer class="d-flex justify-content-between">
				<p>
					<a class="link link--arrow" href="<?php the_permalink(); ?>"><?php _e('Czytaj więcej', 'produktywni'); ?><i class="zmdi zmdi-arrow-right"></i></a>
				</p>
				<p class="blog-post__comments-count">
					(<?php comments_number( 'Brak komentarzy', '1 komentarz', '% komentarzy' ); ?>)
				</p>
			</footer>
		</article>
	<?php endwhile; ?>
</div>
<?php endif; ?>
