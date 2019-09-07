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

    <div id="home-navigation" class="">
        <div class="row">
         <span class="logo-wrapper">
             <a href="<?php echo site_url()?>"><img class="logo" alt="logo" src='<?php echo get_theme_file_uri("/assets/img/logo.svg"); ?>'></a>
 </span>

        </div>



        <?php

        wp_nav_menu(array(
            'theme_location' => 'social-menu',));
        ?>
        <nav id="menu-nav">
            <ul>
                <?php
                while ($loop01->have_posts()) :
                    $loop01->the_post();
                    $section = get_field("activity_slug"); ?>

                    <li class="menu-item itemlist menu-item-type-post_type menu-item-object-page"
                        style="text-transform: capitalize"><a href="<?php echo esc_url(add_query_arg('_', $section, site_url('/portfolio'))) ?>"> <?php echo $section ?></a></li>

                <?php
                endwhile;
                ?>
                <li  class="menu-item itemlist menu-item-type-post_type menu-item-object-page"> Contact </li>
            </ul>

        </nav>
    </div>

    <script>





        var val = "<?php echo $typo_code ?>";
        var vallight = "<?php echo $color_light ?>";
        jQuery(document).ready(function () {
            jQuery("#menu-social-medias > li > a ").css("background-color", val);
            jQuery("#menu-social-medias > li > a").hover(function () {
                jQuery(this).css("background-color", vallight);
            }, function () {
                jQuery(this).css("background-color", val);
            });

        });


        setInterval(function(){
            let listitem= jQuery( "#menu-social-medias > li:not('.visible')");
            if (listitem[0] !== undefined) {
                jQuery(listitem[0]).addClass("visible");
                listitem = jQuery( "#menu-social-medias > li:not('.visible')");
            }
            else{
                listitem = document.querySelector(".itemlist");
                jQuery(listitem).removeClass("itemlist");
                listitem = document.querySelector(".itemlist");
            }


        }, 400);




    </script>