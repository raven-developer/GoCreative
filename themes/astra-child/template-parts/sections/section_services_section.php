<?php

/**
 * Section template: About Overview (value: about_overview)
 *
 * Runs inside the "contents" repeater loop, so get_sub_field() is
 * already pointed at the current row.
 */

$opt_general = get_sub_field('option_general_settings');
$opt_content = get_sub_field('option_section_content');

// Get the values of the general settings
$opt_extra_classes = ! empty($opt_general['option_extra_classes']) ? $opt_general['option_extra_classes'] : '';
$opt_header_level  = ! empty($general['option_header_level']) ? $general['option_header_level'] : 'h2';
$opt_header_level  = in_array($opt_header_level, array('h2', 'h3'), true) ? $opt_header_level : 'h2';
$opt_heading_id = 'services-heading-' . get_row_index();
$opt_classes    = trim('gc-section gc-section--services gc-height--default gc-width--full-l gc-section--bg-default gc-flex gc-flex--col' . $opt_extra_classes);

// Get the values of the content settings
$sec_header      = isset($opt_content['section_header']) ? $opt_content['section_header'] : '';
$sec_description = isset($opt_content['section_description']) ? $opt_content['section_description'] : '';
$opt_add_button  = ! empty($opt_content['option_add_button']);
$sec_buttons     = $opt_add_button && ! empty($opt_content['section_buttons']) ? $opt_content['section_buttons'] : array();

// Get the values of the Services List
$opt_services_list        = get_sub_field('section_services_list');
$opt_item_header_level    = ! empty($opt_services_list['option_heading_level']) ? $opt_services_list['option_heading_level'] : 'h3';
$opt_item_header_level    = in_array($opt_item_header_level, array('h2', 'h3', 'h4', 'h5', 'h6', 'p'), true) ? $opt_item_header_level : 'h3';
$opt_item_heading_id      = 'services-card-heading-' . get_row_index();
$sec_services_items       = ! empty($opt_services_list['section_services_items']) ?  $opt_services_list['section_services_items'] : array();

?>

<section class="<?php echo esc_attr($opt_classes); ?>" <?php echo $sec_header ? ' aria-labelledby="' . esc_attr($opt_heading_id) . '"' : ''; ?>>
    <div class="gc-con--inner">
        <?php if (! empty($sec_header)): ?>
            <div class="gc-section--wrapper gc-section--wrapper-content gc-section--wrapper-content-text gc-width--default gc-flex gc-flex--row gc-flex--justify__space-between">
                <div class="gc-wrap--inner gc-content--left">
                    <div class="gc-content gc-content--header gc-flex">
                        <div class="gc-content--container">
                            <<?php echo tag_escape($opt_header_level); ?> id="<?php echo esc_attr($opt_heading_id); ?>" class="gc-header--title gc-size--l">
                                <?php echo esc_html($sec_header); ?>
                            </<?php echo tag_escape($opt_header_level); ?>>
                        </div>
                    </div>

                    <?php if (empty($sec_description) && $sec_buttons) : ?>
                        <div class="gc-content gc-content--buttons-block gc-flex gc-flex--row">
                            <div class="gc-content--container">
                                <?php foreach ($sec_buttons as $sec_button) :
                                    if (empty($sec_button['section_button_link']) || empty($sec_button['section_button_label'])) {
                                        continue;
                                    }
                                    $opt_new_tab      = ! empty($sec_button['option_new_tab']);
                                    $opt_button_style = ! empty($sec_button['button_style']) ? $sec_button['button_style'] : 'btn_primary';
                                ?>
                                    <a
                                        class="gc-button <?php echo esc_attr($opt_button_style); ?>"
                                        href="<?php echo esc_url($sec_button['section_button_link']); ?>"
                                        <?php echo $opt_new_tab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                        <?php echo esc_html($sec_button['section_button_label']); ?>
                                        <?php if ($opt_new_tab) : ?>
                                            <span class="screen-reader-text"><?php esc_html_e('(opens in a new tab)', 'GoCreative'); ?></span>
                                        <?php endif; ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (! empty($sec_description)) : ?>
                    <div class="gc-wrap--inner gc-content--right">

                        <?php if ($sec_description) : ?>
                            <div class="gc-content gc-content--description gc-flex">
                                <div class="gc-content--container">
                                    <?php echo wp_kses_post($sec_description); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($sec_buttons) : ?>
                            <div class="gc-content gc-content--buttons-block gc-flex gc-flex--row">
                                <div class="gc-content--container">
                                    <?php foreach ($sec_buttons as $sec_button) :
                                        if (empty($sec_button['section_button_link']) || empty($sec_button['section_button_label'])) {
                                            continue;
                                        }
                                        $opt_new_tab      = ! empty($sec_button['option_new_tab']);
                                        $opt_button_style = ! empty($sec_button['button_style']) ? $sec_button['button_style'] : 'btn_primary';
                                    ?>
                                        <a
                                            class="gc-button <?php echo esc_attr($opt_button_style); ?>"
                                            href="<?php echo esc_url($sec_button['section_button_link']); ?>"
                                            <?php echo $opt_new_tab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                            <?php echo esc_html($sec_button['section_button_label']); ?>
                                            <?php if ($opt_new_tab) : ?>
                                                <span class="screen-reader-text"><?php esc_html_e('(opens in a new tab)', 'GoCreative'); ?></span>
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

        <?php if (! empty($sec_services_items)): ?>
            <div class="gc-section--wrapper gc-section--wrapper-content gc-width--full gc-section--content-services-list gc-flex gc-flex--row">
                <div class="gc-wrap--inner">
                    <div class="gc-services--rail">
                        <div class="gc-services--sticky_rail">
                            <div class="gc-services--track">
                                <?php foreach ($sec_services_items as $service_index => $services_item) :

                                    $item_service_image          = isset($services_item['service_image']) ? $services_item['service_image'] : null;
                                    $item_service_title          = isset($services_item['service_title']) ? $services_item['service_title'] : '';
                                    $item_service_description    = isset($services_item['service_description']) ? $services_item['service_description'] : '';
                                    $item_service_button_label   = isset($services_item['service_button_label']) ? $services_item['service_button_label'] : '';
                                    $item_service_button_link    = isset($services_item['service_button_link']) ? $services_item['service_button_link'] : '';
                                    $item_service_button_new_tab = ! empty($services_item['service_button_new_tab']);
                                    $item_service_heading_id     = 'gc-card--services-' . uniqid();
                                    $item_service_button_style   = isset($services_item['service_button_style']) ? $services_item['service_button_style'] : 'btn_primary';;

                                    $item_service_index          = $service_index + 1;
                                    $item_service_total          = count($sec_services_items);
                                ?>

                                    <?php if ($item_service_title || $item_service_image) : ?>
                                        <article class="gc-services__item gc-services--track-item gc-card gc-card--services <?= esc_attr($item_service_heading_id) ?>">
                                            <div class="gc-card--inner-wrap">
                                                <div class="gc-card--image-container gc-flex">
                                                    <div class="gc-content gc-content--image gc-flex">
                                                        <figure class="gc-card--image-block gc-image--default">

                                                            <?php
                                                            echo wp_get_attachment_image(
                                                                $item_service_image['ID'],
                                                                'full',
                                                                false,
                                                                array(
                                                                    'alt'           => '',
                                                                    'class'         => 'gc-card__image',
                                                                    'loading'       => 'lazy'
                                                                )
                                                            );
                                                            ?>

                                                        </figure>
                                                    </div>
                                                </div>

                                                <div class="gc-card--content-container gc-flex gc-flex--col">
                                                    <div class="gc-card--content-block gc-content--container">
                                                        <div class="gc-card--count-container">
                                                            <span class="gc-count gc-count--index"><?= sprintf('%02d', $item_service_index); ?></span>
                                                            <span class="gc-count gc-count--separator">/</span>
                                                            <span class="gc-count gc-count--total"><?= sprintf('%02d', $item_service_total); ?></span>
                                                        </div>
                                                        <div class="gc-card--header-container">
                                                            <<?php echo tag_escape($opt_item_header_level); ?> id="<?php echo esc_attr($opt_item_heading_id); ?>" class="gc-card__title gc-size--default">
                                                                <?php echo esc_html($item_service_title); ?>
                                                            </<?php echo tag_escape($opt_item_header_level); ?>>
                                                        </div>

                                                        <?php if ($item_service_description) : ?>
                                                            <div class="gc-card--description-container">
                                                                <?php echo wp_kses_post($item_service_description); ?>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>

                                                    <?php if ($item_service_button_link) : ?>
                                                        <div class="gc-card--buttons-block gc-content--buttons-block gc-flex gc-flex--row">
                                                            <div class="gc-content--container">
                                                                <a
                                                                    class="gc-button <?= esc_attr($item_service_button_style); ?>"
                                                                    href="<?= esc_url($item_service_button_link); ?>"
                                                                    <?= $item_service_button_new_tab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                                                    <?= esc_html($item_service_button_label); ?>
                                                                    <?php if ($item_service_button_new_tab) : ?>
                                                                        <span class="screen-reader-text"><?php esc_html_e('(opens in a new tab)', 'GoCreative'); ?></span>
                                                                    <?php endif; ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </article>
                                    <?php endif ?>

                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>