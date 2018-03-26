<?php
// SIDEBARS AND WIDGETIZED AREAS
wpLite_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => __('Sidebar', 'wplite'),
		'description' => __('The first (primary) sidebar.', 'wplite'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));

/*	register_sidebar(array(
		'id' => 'sidebarmenu',
		'name' => __('Sidebar Menu', 'wplite'),
		'description' => __('Side bar menu pour le choix de la langue', 'wplite'),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));*/


} // don't remove this bracket!


/**
 * Extend Recent Posts Widget
 *
 * Adds different formatting to the default WordPress Recent Posts Widget
 */

Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

	function widget($args, $instance) {

		extract( $args );

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);

		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 3;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'category_name' => 'event', 'post_status' => 'publish' ) ) );

		if( $r->have_posts() ) :

			echo $before_widget;
			//if( $title ) echo $before_title . $title . $after_title;
			?>
			<ul id="sidebar-tablette">
				<?php while( $r->have_posts() ) : $r->the_post(); ?>
				<li>
					<h2>
						<a href="<?php the_field('link'); ?>" title="inscription à <?php the_title(); ?>" >
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="image">
						<a href="<?php the_field('link'); ?>" title="inscription à <?php the_title(); ?>" >
							<?php the_post_thumbnail( '200' ); ?>
							<div class="sidebar-more">
								+
							</div>
						</a>
					</div>
					<?php the_excerpt();?>
					<b>
						<?php the_field('date');?><br>
						à <?php the_field('city');?>
					</b>
				</li>
				<?php endwhile; ?>
			</ul>
			<div id="" class="carousel">
				<div class="slideshow-container">
					<?php $nbSlide=0; while( $r->have_posts() ) : $r->the_post(); ?>
					<div class="mySlides fade">
						<h2>
							<a href="<?php the_field('link'); ?>" title="inscription à <?php the_title(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
						<div class="image">
							<a href="<?php the_field('link'); ?>" title="inscription à <?php the_title(); ?>" >
								<?php the_post_thumbnail( '200' ); ?>
								<div class="sidebar-more">
									+
								</div>
							</a>
						</div>
						<?php the_excerpt();?>
						<b>
							<?php the_field('date');?><br>
							à <?php the_field('city');?>
						</b>
					</div>
					<?php $nbSlide++; endwhile; ?>
					<a class="prev event" onclick="plusSlides(this, -1)" data-item="">&#10094;</a>
					<a class="next event" onclick="plusSlides(this, 1)" data-item="">&#10095;</a>
				</div>
				<div style="text-align:center">
					<?php for($i=0; $i<$nbSlide; $i++): ?>
		 				<span class="dot" onclick="currentSlide(this, <?php echo $i+1;?>)"  data-item=""></span>
				  	<?php endfor;?>
				</div>
			</div>
			<?php
			echo $after_widget;

		wp_reset_postdata();

		endif;
	}
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');
