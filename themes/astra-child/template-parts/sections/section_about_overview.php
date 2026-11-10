<?php
/**
 * Section template: About Overview (value: about_overview)
 *
 * Runs inside the "contents" repeater loop, so get_sub_field() is
 * already pointed at the current row.
 */

$opt_general = get_sub_field( 'option_general_settings' );
$opt_content = get_sub_field( 'option_section_content' );

// Get the values of the general settings
$opt_extra_classes = ! empty( $opt_general['option_extra_classes'] ) ? $opt_general['option_extra_classes'] : '';
$opt_header_level  = ! empty( $general['option_header_level'] ) ? $general['option_header_level'] : 'h2';
$opt_header_level  = in_array( $opt_header_level, array( 'h2', 'h3' ), true ) ? $opt_header_level : 'h2';
$opt_heading_id = 'hero-banner-heading-' . get_row_index();
$opt_classes    = trim( 'gc-section gc-section--about-overview gc-height--default gc-width--default gc-section--bg-default gc-flex gc-flex--col' . $opt_extra_classes );

// Get the values of the content settings
$sec_header      = isset( $opt_content['section_header'] ) ? $opt_content['section_header'] : '';
$sec_description = isset( $opt_content['section_description'] ) ? $opt_content['section_description'] : '';
$opt_add_button  = ! empty( $opt_content['option_add_button'] );
$sec_buttons     = $opt_add_button && ! empty( $opt_content['section_buttons'] ) ? $opt_content['section_buttons'] : array();
$opt_add_image   = ! empty( $opt_content['option_add_image'] );
$sec_image       = $opt_add_image && ! empty( $opt_content['section_image'] ) ? $opt_content['section_image'] : null;

// Get the values of the Key Point Items
$sec_about_overview        = get_sub_field('section_about_overview');
$opt_about_header_level    = ! empty( $sec_about_overview['option_heading_level'] ) ? $sec_about_overview['option_heading_level'] : 'h3';
$opt_about_header_level    = in_array( $opt_about_header_level, array( 'h3', 'h4', 'h5', 'h6', 'p' ), true ) ? $opt_about_header_level : 'h3';
$opt_item_heading_id       = 'about-overview-heading-' . get_row_index();
$sec_keypoint_items        = ! empty ( $sec_about_overview['section_keypoint_items']) ?  $sec_about_overview['section_keypoint_items'] : array();
?>

<section class="<?php echo esc_attr( $opt_classes ); ?>"<?php echo $sec_header ? ' aria-labelledby="' . esc_attr( $opt_heading_id ) . '"' : ''; ?>>
	<div class="gc-con--inner">
		<?php if ( ! empty( $sec_header ) ): ?>
		<div class="gc-section--wrapper gc-section--wrapper-content gc-section--wrapper-content-text gc-flex gc-flex--row<?= $sec_keypoint_items ? ' gc-flex--justify__space-between' : ''; ?>"">
			<div class="gc-wrap--inner<?= $sec_keypoint_items ? ' gc-content--left' : ''; ?>">
				<div class="gc-content gc-content--header gc-flex">
					<div class="gc-content--container">
						<<?php echo tag_escape($opt_header_level); ?> id="<?php echo esc_attr( $opt_heading_id ); ?>" class="gc-header--title gc-size--l">
							<?php echo esc_html( $sec_header ); ?>
						</<?php echo tag_escape($opt_header_level); ?>>
					</div>
				</div>

				<?php if ( $sec_description ) : ?>
				<div class="gc-content gc-content--description gc-flex">
					<div class="gc-content--container">
						<?php echo wp_kses_post( $sec_description ); ?>
					</div>
				</div>
				<?php endif; ?>
				
				<?php if ( empty ( $sec_keypoint_items ) && $sec_buttons ) : ?>
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
			
			<?php if ( $sec_keypoint_items ) : ?>
			<div class="gc-wrap--inner gc-content--right">
				<div class="gc-content gc-content--card-wrap gc-flex gc-flex--col gc-gap--none">
					<?php foreach ( $sec_keypoint_items as $keypoint_item ) : 
					
					$item_keypoint_title       = isset( $keypoint_item['keypoint_title'] ) ? $keypoint_item['keypoint_title'] : '';
					$item_keypoint_description = isset( $keypoint_item['keypoint_description'] ) ? $keypoint_item['keypoint_description'] : '';

					?>
					<?php if ( $item_keypoint_title || $item_keypoint_description ) : ?>
						<div class="gc-content__card gc-card gc-card--text-only">
							<div class="gc-card--inner-wrap">
								<div class="gc-card--header-container">
									<<?php echo tag_escape($opt_about_header_level); ?> id="<?php echo esc_attr( $opt_item_heading_id ); ?>" class="gc-card__title gc-size--default">
										<?php echo esc_html( $item_keypoint_title ); ?>
									</<?php echo tag_escape($opt_about_header_level); ?>>
								</div>

								<?php if ( $item_keypoint_description ) : ?>
								<div class="gc-card--header-container">
									<?php echo wp_kses_post( $item_keypoint_description ); ?>
								</div>
								<?php endif; ?>
							</div>

						</div>
					<?php endif; ?>

					<? endforeach; ?>
				</div>

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
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if ( ! empty( $sec_image ) ): ?>
		<div class="gc-section--wrapper gc-section--wrapper-content gc-section--wrapper-content-image gc-flex gc-flex--row">
			<div class="gc-wrap--inner">
				<div class="gc-content gc-content--image gc-flex">
					<figure class="gc-section--image-block gc-image--default">
			
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

					</figure>
				</div>
			</div>
		</div>

		<?php endif; ?>

	</div>
</section> 