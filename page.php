<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post();?>
	<header id="header-page" class="wrapper">
		<h1 class="page-title"><?php the_title();?></h1>
	</header>

	<div class="wrapper" id="excerpt">
		<?php the_excerpt();?>
	</div>

	<div class="wrapper" id="thumbnail">
		<div class="illustration"></div>
		<?php the_post_thumbnail( 'full-std'); ?>
	</div>

	<section class="entry-content wrapper" itemprop="articleBody">
		<?php the_content(); ?>
		<hr>
	</section>

	<footer class="article-footer wrapper">
		<div id="button-return"></div>
		<div id="button-share">
			<a href="http://www.twitter.com/share?url=<?php the_permalink();?>" target="_blank"><i class="fa fa-twitter"></i></a>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" target="_blank"><i class="fa fa-facebook"></i></a>
			<a href="https://www.linkedin.com/cws/share?url=<?php the_permalink();?>" target="_blank"><i class="fa fa-linkedin"></i></a>
		</div>
	</footer>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
