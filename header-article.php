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

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php
$postcat = get_the_category();
$str = strtolower($postcat[0]->name);

$args01 = array('post_type' => 'activity', 'posts_per_page' => -1);
$loop01 = new WP_Query($args01);
while ($loop01->have_posts()) :$loop01->the_post();
    $sectionOf = get_field("activity_slug");
    if ($str == $sectionOf) {
        $colorcode = get_field('typo_color');
        $colorlight = get_field('couleur_light');
    }
endwhile;
    endwhile;
    endif;
?>


<div id="page">
    <?php
    $img = ci_setting('ci_sidebar_image');
    $style = '';
    if (!empty($img)) {
        $style = sprintf("background: url('%s') 0 50%%",
            esc_url_raw($img)
        );
    }
    ?>



    <script>
        var val = "<?php echo $colorcode ?>";
        var vallight = "<?php echo $colorlight ?>";
        jQuery(document).ready(function () {
            jQuery("#menu-social-medias > li > a ").css("background-color", val);
            jQuery("#menu-social-medias > li > a").hover(function () {
                jQuery(this).css("background-color", vallight);
            }, function () {
                jQuery(this).css("background-color", val);
            });
        });
    </script>