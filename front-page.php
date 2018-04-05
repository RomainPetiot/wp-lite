<?php get_header(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<main>
			<div id="home-main" class="wrapper">
				<div id="home-title">
					<h1><?php the_title();?></h1>
				</div>
				<div id="home-content">
					<?php the_content();?>
				
				</div>
			</div>
			<div id="archive-actualite" class="wrapper">
				<div id="listing-article">
					<?php
					global $post;
					$args = array( 'posts_per_page' => 1, 'category' => 'actualite' );
					$myposts = get_posts( $args );
					foreach ( $myposts as $post ) : setup_postdata( $post );
						get_template_part( 'template-parts/loop', 'archive-MEA' );
					endforeach;
					wp_reset_postdata();?>
				</div>
			</div>
		</main>

	<?php endwhile; endif; ?>
<?php get_footer(); ?>
