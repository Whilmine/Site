<!doctype html>
<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_enqueue_script('jquery'); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action('after_open_body_tag');
$section = get_query_var('_');
$args01 = array('post_type' => 'activity', 'posts_per_page' => -1);
$loop01 = new WP_Query($args01);
while ($loop01->have_posts()) :
    $loop01->the_post();
    $sectionOf = get_field("activity_slug");
    if ($section == $sectionOf) {
        $typo_code = get_field('typo_color');
        $color_light = get_field('couleur_light');
    }
endwhile;
?>


<div >
    <?php
    $img = ci_setting('ci_sidebar_image');
    $style = '';
    if (!empty($img)) {
        $style = sprintf("background: url('%s') 0 50%%",
            esc_url_raw($img)
        );
    }
    ?>



