# Section Template List
null : Select Template
hero_banner : Full Height Page Banner
page_header : Page Header
logo_carousel : Logo Carousel
about_overview : About Overview

# Section Header Level
h2 : H2
h3 : H3


# var_dump
<?php /* Temporary: remove once layouting is done */ ?>
<pre><?php echo esc_html( print_r( array(
	'general' => $opt_general,
	'content' => $opt_content,
    'section' => $TEMPLATE_FIELD,
), true ) ); ?></pre>