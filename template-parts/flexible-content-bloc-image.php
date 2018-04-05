<h2>
	<?php the_sub_field('title');?>
</h2>
<div class="content">
	<div>
		<?php
		$image = get_sub_field('image');
		$size = '400';
		if( $image ) {
			echo wp_get_attachment_image( $image, $size );
		}
		?>
	</div>
	<div>
		<?php the_sub_field('content');?>
	</div>
</div>
