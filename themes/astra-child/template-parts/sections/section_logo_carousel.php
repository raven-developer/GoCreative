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
$opt_header_level  = ! empty( $general['option_header_level'] ) ? $general['option_header_level'] : 'h2';
$opt_header_level  = in_array( $opt_header_level, array( 'h2', 'h3' ), true ) ? $opt_header_level : 'h2';

// Get the values of the content settings
$sec_header      = isset( $opt_content['section_header'] ) ? $opt_content['section_header'] : '';
$sec_description = isset( $opt_content['section_description'] ) ? $opt_content['section_description'] : '';
$opt_add_button  = ! empty( $opt_content['option_add_button'] );
$sec_buttons     = $opt_add_button && ! empty( $opt_content['section_buttons'] ) ? $opt_content['section_buttons'] : array();

// Get the values of the Logo Carousel Group
$sec_gallery      = get_sub_field( 'section_logo_carousel' );
$sec_logo_gallery = ! empty( $sec_gallery['section_logo_images'] ) ? $sec_gallery['section_logo_images'] : array();

$opt_heading_id = 'logo-carousel-heading-' . get_row_index();
$opt_classes    = trim( 'gc-section gc-section--logo-carousel gc-height--default gc-width--full gc-section--bg-default gc-flex gc-flex--col' . $opt_extra_classes );
?>

<section class="<?php echo esc_attr( $opt_classes ); ?>"<?php echo $sec_header ? ' aria-labelledby="' . esc_attr( $opt_heading_id ) . '"' : ''; ?>>
	<div class="gc-con--inner">
		<?php if ( ! empty( $sec_header ) ): ?>
		<div class="gc-section--wrapper gc-section--wrapper-content gc-section--wrapper-content-text gc-width--half gc-flex gc-align--center">
			<div class="gc-wrap--inner">
				<div class="gc-content gc-content--header gc-flex">
					<div class="gc-content--container">
						<<?php echo tag_escape($opt_header_level); ?> id="<?php echo esc_attr( $opt_heading_id ); ?>" class="gc-header--title gc-size--l">
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

        <?php if ( $sec_logo_gallery ) : ?>
            <div class="gc-section--wrapper gc-section--wrapper-content gc-section--wrapper-content-image gc-flex">
			    <div class="gc-wrap--inner">
                    <div class="gc-content gc-content--carousel-block gc-slider gc-slider--rtl swiper">
                        <ul class="gc-carousel--list swiper-wrapper">
                            <?php foreach ( $sec_logo_gallery as $sec_logo_image ) : ?>
                                <li class="gc-carousel--item swiper-slide gc-image--contain" id="gc-carousel--item-<?= esc_html($sec_logo_image['ID']) ?>">
                                    <img
                                        src="<?= esc_url($sec_logo_image['sizes']['thumbnail'])?>"
                                        alt="<?= esc_attr( $sec_logo_image['alt'] ); ?>"
                                        class="gc-carousel__img gc-image"
                                        loading="lazy"
                                    >
                                </li>
                            <?php endforeach; ?>
                        </ul>
						<div class="gc-slider--overlay gc-slider--overlay-left"></div>
						<div class="gc-slider--overlay gc-slider--overlay-right"></div>
                    </div>

                    <div class="gc-content gc-content--carousel-block gc-slider gc-slider--ltr swiper">
                        <ul class="gc-carousel--list swiper-wrapper">
                            <?php foreach ( $sec_logo_gallery as $sec_logo_image ) : ?>
                                <li class="gc-carousel--item swiper-slide gc-image--contain" id="gc-carousel--item-<?= esc_html($sec_logo_image['ID']) ?>">
                                    <img
                                        src="<?= esc_url($sec_logo_image['sizes']['thumbnail'])?>"
                                        alt="<?= esc_attr( $sec_logo_image['alt'] ); ?>"
                                        class="gc-carousel__img gc-image"
                                        loading="lazy"
                                    >
                                </li>
                            <?php endforeach; ?>
                        </ul>
						<div class="gc-slider--overlay gc-slider--overlay-left"></div>
						<div class="gc-slider--overlay gc-slider--overlay-right"></div>
                    </div>

                </div>
            </div>
        <?php endif; ?>
        
	</div>
</section>