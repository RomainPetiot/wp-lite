<?php

add_action( 'admin_init', 'myThemeRegisterSettings' );

function myThemeRegisterSettings( )
{
	register_setting( 'my_theme', 'wpLite_email_dest' );

	register_setting( 'my_theme', 'wpLite_logo' );
	register_setting( 'my_theme', 'wpLite_favicon' );

	register_setting( 'my_theme', 'wpLite_facebook' );
	register_setting( 'my_theme', 'wpLite_twitter' );
	register_setting( 'my_theme', 'wpLite_linkedin' );
	register_setting( 'my_theme', 'wpLite_slack' );
	register_setting( 'my_theme', 'wpLite_mail' );
}

// la fonction myThemeAdminMenu( ) sera exécutée
// quand WordPress mettra en place le menu d'admin
add_action( 'admin_menu', 'myThemeAdminMenu' );
function myThemeAdminMenu( )
{
	add_menu_page(
		'Options de mon thème', // le titre de la page
		'Mon thème',            // le nom de la page dans le menu d'admin
		'administrator',        // le rôle d'utilisateur requis pour voir cette page
		'my-theme-page',        // un identifiant unique de la page
		'myThemeSettingsPage'   // le nom d'une fonction qui affichera la page
	);
}

function myThemeSettingsPage( )
{
	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();
	}else{
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
?>
	<div class="wrap">
		<h2>Options de mon thème</h2>

		<form method="post" action="options.php">
			<input type="hidden" name="action" value="update" />
			<?php
				wp_nonce_field('update-options');
				settings_fields( 'my_theme' );
			?>
				<?php add_option_text('wpLite_email_dest', 'Adresse email destination pour les formulaires');?>
				<?php add_option_image('wpLite_logo', 'Logo Header');?>
				<?php add_option_image('wpLite_favicon', 'Favicon');?>

				<?php add_option_text('wpLite_facebook', 'Facebook');?>
				<?php add_option_text('wpLite_twitter', 'Twitter');?>
				<?php add_option_text('wpLite_linkedin', 'Linkedin');?>
				<?php add_option_text('wpLite_slack', 'Slack');?>
				<?php add_option_text('wpLite_mail', 'Mail');?>
			</table>
			<p class="submit">
				<input type="submit" class="button-primary" value="Mettre à jour" />
			</p>
		</form>
	</div>
<?php
}


function add_option_text($name, $label){
	echo '	<table class="form-table"><tr valign="top">
				<th scope="row"><label for="'.$name.'">'.$label.'</label></th>
				<td><input type="text" id="'.$name.'" name="'.$name.'" class="regular-text" value="'.get_option( $name ).'" /></td>
			</tr>';
}
function add_option_image($name, $label){
	echo '	<tr valign="top">
				<th scope="row"><label for="'.$name.'">'.$label.'</label></th>
				<td>';
	$image = get_option($name);
	if( $image ) {
		echo wp_get_attachment_image( $image );
	}

	echo '<input class="'.$name.'_url" type="hidden" id="'.$name.'" name="'.$name.'" size="60" value="'.get_option($name).'">
			<button class="'.$name.'_upload button">Selectionner un fichier</button>
				</td>
			</tr>


			<script>
				jQuery(document).ready(function($) {
					$(".'.$name.'_upload").click(function(e) {
						e.preventDefault();
						var custom_uploader = wp.media({
							multiple: false  // Set this to true to allow multiple files to be selected
						})
						.on("select", function() {
							var attachment = custom_uploader.state().get("selection").first().toJSON();
							$(".'.$name.'").attr("src", attachment.url);
							$("#'.$name.'").val(attachment.id);
						})
						.open();
					});
				});
			</script>
	';
}
