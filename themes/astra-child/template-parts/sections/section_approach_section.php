<?php
/**
 * Section template: Approach Section (value: approach_section)
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
$opt_classes    = trim( 'gc-section gc-section--approach-overview gc-height--default gc-width--default gc-section--bg-default gc-flex gc-flex--col' . $opt_extra_classes );

// Get the values of the content settings
$sec_header      = isset( $opt_content['section_header'] ) ? $opt_content['section_header'] : '';
$sec_description = isset( $opt_content['section_description'] ) ? $opt_content['section_description'] : '';
$opt_add_button  = ! empty( $opt_content['option_add_button'] );
$sec_buttons     = $opt_add_button && ! empty( $opt_content['section_buttons'] ) ? $opt_content['section_buttons'] : array();
$opt_add_image   = ! empty( $opt_content['option_add_image'] );
$sec_image       = $opt_add_image && ! empty( $opt_content['section_image'] ) ? $opt_content['section_image'] : null;

// Get the values of the Approach Items
$opt_approach_section  = get_sub_field('section_approach_content');
$opt_item_header_level = ! empty( $opt_approach_section['option_heading_level'] ) ? $opt_approach_section['option_heading_level'] : 'h3';
$opt_item_header_level = in_array( $opt_item_header_level, array( 'h3', 'h4', 'h5', 'h6', 'p' ), true ) ? $opt_item_header_level : 'h3';
$opt_item_heading_id   = 'approach-heading-' . get_row_index();
$sec_approach_items    = ! empty ( $opt_approach_section['section_approach_items']) ?  $opt_approach_section['section_approach_items'] : array();
$opt_item_count        = count( $sec_approach_items );
?>

<section class="<?php echo esc_attr( $opt_classes ); ?>"<?php echo $sec_header ? ' aria-labelledby="' . esc_attr( $opt_heading_id ) . '"' : ''; ?>>
	<div class="gc-con--inner">
		<?php if ( ! empty( $sec_header ) ): ?>
		<div class="gc-section--wrapper gc-section--wrapper-content gc-section--content-header gc-width--third gc-flex gc-align--center">
			<div class="gc-wrap--inner">
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

        <?php if ( ! empty( $sec_header ) ): ?>
		<div class="gc-section--wrapper gc-section--wrapper-content gc-section--content-approach-list gc-flex gc-align--center">
			<div class="gc-wrap--inner">
				
                <div class="gc-approach--wrapper gc-card-wrapper" data-item-count="<?= esc_attr($opt_item_count) ?>">
                    <div class="gc-wrap--inner-card">
                        <?php foreach ($sec_approach_items as $approach_index => $approach_item) :

                            $item_approach_image          = isset($approach_item['approach_icon']) ? $approach_item['approach_icon'] : null;
                            $item_approach_title          = isset($approach_item['approach_title']) ? $approach_item['approach_title'] : '';
                            $item_approach_description    = isset($approach_item['approach_description']) ? $approach_item['approach_description'] : '';
                            $item_approach_heading_id     = 'gc-card--' . uniqid();
                            $item_approach_index          = $approach_index + 1;
                        ?>

                        <?php if ( $item_approach_title || $item_approach_description ) : ?>
                            <div class="gc-content__card gc-card gc-card--icon-text gc-card__bg-white <?= esc_attr($item_approach_heading_id) ?>" id="<?= esc_attr($item_approach_heading_id) ?>">
                                <div class="gc-card--inner-wrap">
                                    <div class="gc-card--image-container gc-flex">
                                        <div class="gc-content gc-content--image gc-flex">
                                            <figure class="gc-card--icon-block gc-icon--default">

                                                <?php 
                                                
                                                echo wp_get_attachment_image(
                                                    $item_approach_image['ID'],
                                                    'full',
                                                    false,
                                                    array(
                                                        'alt'           => '',
                                                        'class'         => 'gc-card__icon',
                                                    )
                                                );

                                                ?>

                                            </figure>
                                        </div>
                                    </div>

                                    <div class="gc-card--content-container gc-flex gc-flex--col">
                                        <div class="gc-card--header-container">
                                            <<?php echo tag_escape($opt_item_header_level); ?> id="<?php echo esc_attr( $opt_item_heading_id ); ?>" class="gc-card__title gc-size--default">
                                                <?php echo esc_html( $item_approach_title ); ?>
                                            </<?php echo tag_escape($opt_item_header_level); ?>>
                                        </div>

                                        <?php if ( $item_approach_description ) : ?>
                                        <div class="gc-card--description-container">
                                            <?php echo wp_kses_post( $item_approach_description ); ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endif; ?>

                        <? endforeach; ?>
                    </div>        
                </div>

			</div>
		</div>
		<?php endif; ?>
        
	</div>
</section>