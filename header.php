<!doctype html>

  <html class="no-js"  <?php language_attributes(); ?>>

	<head>
		<meta charset="utf-8">

		<!-- Force IE to use the latest rendering engine available -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
		$image = get_option('wplite_favicon');
		if( $image ) {
			$src = wp_get_attachment_image_src( $image, 'ico' );
			?>
			<link rel="icon" href="<?php echo $src[0];?>" sizes="16x16" type="image/png">
			<?php
		}
		?>

		<?php wp_head(); ?>

		<!-- Drop Google Analytics here -->
		<!-- end analytics -->

	</head>

	<body <?php body_class(); ?> >

		<div class="" id="menuMobile">
			<div class="align-right">
				<i class="fa fa-times" aria-hidden="true" id="times-menu" onclick="menuMobile()"></i>
			</div>
			<?php  wplite_top_nav(); ?>
		</div>
		<div id="burger-menu" class="">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</div>

		<div class="overlay" onclick="closeModal()" id="modalOverlay"></div>

		<header id="header" class="wrapper">
			<div class="header-logo">
				<a href="<?php echo home_url();?>">
					<?php $image = get_option('wplite_logo');
					if( $image ) {
						echo wp_get_attachment_image( $image, 'logo' );
					}
					?>
				</a>
			</div>
			<div class="header-menu">
				<?php  wplite_top_nav(); ?>
			</div>
			<?php if ( is_active_sidebar( 'sidebarmenu' ) ) : ?>

				<?php dynamic_sidebar( 'sidebarmenu' ); ?>

			<?php endif; ?>
		</header> <!-- end .header -->
