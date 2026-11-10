<?php
/**
 * The template for displaying all pages.
 * 
 */

defined( 'ABSPATH' ) || exit;

get_header();

/**
 * get_header() already have the opening <main> tag, so we don't need to add it here.
 *  
 * main#content
 *    .ast-container
 */
?>

<?php if ( have_rows( 'contents' ) ) : ?>
	<?php while ( have_rows( 'contents' ) ) : the_row();

		$opt_general          = get_sub_field( 'option_general_settings' );
		$opt_template         = sanitize_key( get_sub_field( 'option_select_template' ) );

        $opt_enable_section   = isset( $opt_general['option_enable_section'] ) ? $opt_general['option_enable_section'] : false;

		if ( empty( $opt_enable_section ) || ! $opt_enable_section ) {
			continue;
		}

		get_template_part( 'template-parts/sections/section_' . $opt_template );

	endwhile; ?>
<?php endif; ?>

<?php

/**
 * get_footer() already have the closing </main> tag, so we don't need to add it here.
 */

get_footer();