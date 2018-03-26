<article id="post-<?php the_ID(); ?>" <?php post_class('article-mea'); ?> role="article">
	<div class="image">
		<a href="<?php the_permalink() ?>">
			<?php the_post_thumbnail('actu-std');?>
		</a>
	</div>
	<header class="article-header">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	</header> <!-- end article header -->

	<section class="entry-content" itemprop="articleBody">
		<?php the_excerpt(); ?>
		<div class="cont-absolute-more">
			<a href="<?php the_permalink() ?>" class="more" title="en savoir plus">
				<div class="">
					<span>+</span>
				</div>
			</a>
		</div>
	</section>
</article> <!-- end article -->
