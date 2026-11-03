<?php
/**
 * Section template: Full Height Page Banner (value: hero_banner)
 *
 * Runs inside the "contents" repeater loop, so get_sub_field() is
 * already pointed at the current row.
 */

$opt_general = get_sub_field( 'option_general_settings' );
$opt_content = get_sub_field( 'option_section_content' );

// Get the values of the general settings
$opt_extra_classes = ! empty( $opt_general['option_extra_classes'] ) ? $opt_general['option_extra_classes'] : '';

/**
 * Full Height Page Banner always outputs an H1, so the Header Level setting is not used here.
 * 
 * $opt_header_level  = ! empty( $opt_general['option_header_level'] ) ? $opt_general['option_header_level'] : 'h2';
 * $opt_header_level  = in_array( $opt_header_level, array( 'h2', 'h3' ), true ) ? $opt_header_level : 'h2';
 */

$opt_header_level = 'h1'; // Always use H1 for the hero banner heading

// Get the values of the content settings
$sec_header      = isset( $opt_content['section_header'] ) ? $opt_content['section_header'] : '';
$sec_description = isset( $opt_content['section_description'] ) ? $opt_content['section_description'] : '';
$opt_add_button  = ! empty( $opt_content['option_add_button'] );
$sec_buttons     = $opt_add_button && ! empty( $opt_content['section_buttons'] ) ? $opt_content['section_buttons'] : array();
$opt_add_image   = ! empty( $opt_content['option_add_image'] );
$sec_image       = $opt_add_image && ! empty( $opt_content['section_image'] ) ? $opt_content['section_image'] : null;

$opt_heading_id = 'hero-banner-heading-' . get_row_index();
$opt_classes    = trim( 'gc-section gc-height--full gc-width--full gc-section--hero-banner ' . $opt_extra_classes );
?>

<?php /* Temporary: remove once layouting is done */ ?>

<section class="<?php echo esc_attr( $opt_classes ); ?>"<?php echo $sec_header ? ' aria-labelledby="' . esc_attr( $opt_heading_id ) . '"' : ''; ?>>
	<div class="gc-section--inner-container">
		<?php if ( !empty( $sec_header ) ): ?>
		<div class="gc-section--content-block gc-flex gc-flex--col gc-flex--center gc-flex--gap-3 gc-flex--col-6">

			<div class="gc-section--header-block">
				<<?php echo $opt_header_level; ?> id="<?php echo esc_attr( $opt_heading_id ); ?>" class="gc-section__header gc-section__title">
					<?php echo esc_html( $sec_header ); ?>
				</<?php echo $opt_header_level; ?>>
			</div>

			<?php if ( $sec_description ) : ?>
			<div class="gc-section--description-block">
				<?php echo wp_kses_post( $sec_description ); ?>
			</div>
			<?php endif; ?>

			<?php if ( $sec_buttons ) : ?>
			<div class="gc-section--buttons-block gc-flex gc-flex--row gc-flex--gap-1">
				<?php foreach ( $sec_buttons as $sec_button ) :
					if ( empty( $sec_button['section_button_link'] ) || empty( $sec_button['section_button_label'] ) ) {
						continue;
					}
					$opt_new_tab      = ! empty( $sec_button['option_new_tab'] );
					$opt_button_style = ! empty( $sec_button['button_style'] ) ? $sec_button['button_style'] : 'btn_primary';
					?>
					<a
						class="gc-button <?php echo esc_attr( $opt_button_style ); ?>"
						href="<?php echo esc_url( $sec_button['section_button_link'] ); ?>"
						<?php echo $opt_new_tab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
					>
						<?php echo esc_html( $sec_button['section_button_label'] ); ?>
						<?php if ( $opt_new_tab ) : ?>
							<span class="screen-reader-text"><?php esc_html_e( '(opens in a new tab)', 'GoCreative' ); ?></span>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

		</div>
		<?php endif; ?>

		<?php if ( $sec_image ) : ?>
		<div class="gc-section--image-block">
			<?php
			echo wp_get_attachment_image(
					$sec_image['ID'],
					'full',
					false,
					array(
						'alt'           => '',
						'class'         => 'gc-section__image gc-section__image--hero-banner',
						'fetchpriority' => 'high',
					)
				);
			?>
		</div>
	<?php endif; ?>
	</div>
</section>