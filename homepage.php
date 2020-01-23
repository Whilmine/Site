<?php
/*
 * Template Name: Homepage
 */
?>
<?php get_header('home'); ?>
    <div class="content-wrap home">
        <div id="nav-button">
            <?php
            $args = array('post_type' => 'activity', 'posts_per_page' => -1);
            $loop = new WP_Query($args);
            while ($loop->have_posts()) : $loop->the_post();
                ?>
                <span>

            </span>
            <?php endwhile;?>
        </div>

        <div class="container">
            <?php
            $args = array('post_type' => 'activity', 'posts_per_page' => -1);
            $loop = new WP_Query($args);
            $i = 1;
            while ($loop->have_posts()) :
                $loop->the_post();

                $section = get_field("activity_slug");
                $colorcode = get_field('color_code');
                $typo_code = get_field('typo_color');
                $color_light = get_field('couleur_light');
                ?>



                <section  style="background-color:<?php echo $colorcode ?>" id="section_<?php echo $i ?>" value="<?php echo $typo_code?>,<?php echo $color_light?>">
                    <div class="full-height-content text-content flex-justify-center flex-align-center">
                        <div class="entry-content">
                            <?php the_content(); ?></p>
                        </div>
                    </div>

                    <?php if ($i!=3){ ?>
                        <a id="portfolio_link" class="round_link" href="<?php echo esc_url(add_query_arg('_', $section, site_url('/portfolio'))) ?>">
                            <button>
                                <img src='<?php echo get_theme_file_uri("/assets/img/arrow.svg"); ?>'>
                            </button>
                        </a>
                    <?php } ?>

                    <a class="full-height-content" id="image_item"
                       href="<?php if ($i!=3){ echo esc_url(add_query_arg('_', $section, site_url('/portfolio')));} else {echo "#";} ?>">
                        <div class="entry-content">
                            <h2 class="title" style="color: <?php echo $typo_code?>"><?php the_title();?></h2>
                            <?php
                            the_post_thumbnail();
                            echo '</div>';
                            ?>
                    </a>

                </section>
                <?php
                $i++;
            endwhile; ?>
        </div>
    </div>
    <div class="newsletter-signup">
        Neswletter
    </div>

    <script>
        var i = 1;

        jQuery(document).ready(function () {
            jQuery("#section_" + i).addClass("active");

        });

        var section = document.getElementById("section_" + i);
        if (document.addEventListener) {
            // IE9, Chrome, Safari, Opera
            document.addEventListener("mousewheel", MouseWheelHandler, false);
            // Firefox
            document.addEventListener("DOMMouseScroll", MouseWheelHandler, false);
        }
// IE 6/7/8/
        else document.attachEvent("onmousewheel", MouseWheelHandler);

        function MouseWheelHandler(e) {
            e = window.event || e; // old IE support
            var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));

            if (i + (-delta) <= 3 && i + (-delta) > 0) {
                jQuery("#section_" + i).removeClass("active");
                i = i + (-delta);
                jQuery("#section_" + i).addClass("active");

            }
        }

        function setPortfolioPage(){

            jQuery('.text-content').addClass("active");
            jQuery('#home-navigation').addClass("active");
            jQuery('.round_link').addClass("active");
            jQuery('#portfolio_link').addClass("active");
            jQuery('#image_item').addClass("active");
            jQuery('.container').addClass("active");

            setTimeout(function(){
                window.location =   jQuery('#portfolio_link').attr('href');
            },50)
        }
        jQuery('#portfolio_link').click(function (e) {
            e.preventDefault();
            setPortfolioPage();
        });

        jQuery('#image_item').click(function (e) {
            e.preventDefault();
            setPortfolioPage();
        });


    </script>
<?php get_footer(); ?>