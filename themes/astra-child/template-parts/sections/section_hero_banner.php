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

$opt_header_level = 'h1'; // Always use H1 for the hero banner heading

// Get the values of the content settings
$sec_header      = isset( $opt_content['section_header'] ) ? $opt_content['section_header'] : '';
$sec_description = isset( $opt_content['section_description'] ) ? $opt_content['section_description'] : '';
$opt_add_button  = ! empty( $opt_content['option_add_button'] );
$sec_buttons     = $opt_add_button && ! empty( $opt_content['section_buttons'] ) ? $opt_content['section_buttons'] : array();
$opt_add_image   = ! empty( $opt_content['option_add_image'] );
$sec_image       = $opt_add_image && ! empty( $opt_content['section_image'] ) ? $opt_content['section_image'] : null;

$opt_heading_id = 'hero-banner-heading-' . get_row_index();
$opt_classes    = trim( 'gc-section gc-section--hero-banner gc-height--full gc-width--full gc-section--bg-img gc-flex gc-flex--row' . $opt_extra_classes );
?>

<section class="<?php echo esc_attr( $opt_classes ); ?>"<?php echo $sec_header ? ' aria-labelledby="' . esc_attr( $opt_heading_id ) . '"' : ''; ?> style="--gc-background: url('<?php echo esc_url( $sec_image['url'] ); ?>');">>
	<div class="gc-con--inner">
		<?php if ( ! empty( $sec_header ) ): ?>
		<div class="gc-section--wrapper gc-section--wrapper-content gc-section--wrapper-content-text gc-pos--bottom gc-width--half gc-flex gc-color--white">
			<div class="gc-wrap--inner">
				<div class="gc-content gc-content--header gc-flex">
					<div class="gc-content--container">
						<<?php echo tag_escape($opt_header_level); ?> id="<?php echo esc_attr( $opt_heading_id ); ?>" class="gc-header--title gc-size--xl">
							<?php echo esc_html( $sec_header ); ?>
						</<?php echo tag_escape($opt_header_level); ?>>
					</div>
				</div>

				<?php if ( $sec_description ) : ?>
				<div class="gc-content gc-content--description gc-flex gc-size--m">
					<div class="gc-content--container">
						<?php echo wp_kses_post( $sec_description ); ?>
					</div>
				</div>
				<?php endif; ?>

				<?php if ( $sec_buttons ) : ?>
				<div class="gc-content gc-content--buttons-block gc-flex gc-flex--row">
					<div class="gc-content--container">
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
				</div>
				<?php endif; ?>

			</div>
		</div>
		<?php endif; ?>
	</div>
</section>