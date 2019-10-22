<div id="page">


<?php get_header("portfolio"); ?>

<div class="content-wrap">
	<main id="content" role="main">
		<div class="container">

				<div class="col-xs-12">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article id="entry-<?php the_ID(); ?>" <?php post_class('entry'); ?>>

								<div class="col-md-8 col-md-push-2">
									<?php if ( has_post_thumbnail() ) : ?>
										<figure class="entry-thumb">
											<a href="<?php echo ci_get_featured_image_src('large'); ?>" class="fancybox">
												<?php the_post_thumbnail('main_thumb'); ?>
											</a>
										</figure>
									<?php endif; ?>
									<h1 class="entry-title"><?php the_title(); ?></h1>

									<div class="entry-content">
										<?php the_content(); ?>
									</div>

									<?php comments_template(); ?>
								</div>
							</div>
						</article>
					<?php endwhile; endif; ?>
			
			</div>

	</main>
</div>

<?php get_footer(); ?>

</div>
