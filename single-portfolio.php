</div>
<?php get_header("portfolio"); ?>


<?php

if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php
    $postcat = get_the_category();
    $cat = [];
    $terms = get_the_terms($post->ID, array('portfolio-category'));
    $i = 1;
    if ($terms != null) {
        foreach ($terms as $term) {
            $term_link = get_term_link($term, array('teams_positions'));
            if (is_wp_error($term_link))
                continue;
            array_push($cat, $term->name);
            $i++;
        }
    }
    $category = get_field("activity");

    $args03 = array(
        'post_type' => 'portfolio',
        'category_name' => $category,
        'posts_per_page' => -1,
    );
    $wp_query_portfoliotitem = new WP_Query($args03);

    $relatedWork = [];
    while ($wp_query_portfoliotitem->have_posts()) :$wp_query_portfoliotitem->the_post();
        if (has_term("", 'portfolio-category', $post->ID) == true) {
            $terms_03 = get_the_terms($post->ID, 'portfolio-category');

            foreach ($terms_03 as $term) {
                $term_link = get_term_link($term, array('teams_positions'));
                if (is_wp_error($term_link))
                    continue;
                foreach ($cat as $value) {
                    if ($term->name == $value) {
                        $link = get_permalink($post);
                        $title = get_the_title();

                        array_push($relatedWork, [$title, $link]);

                    }
                }
                $i++;
            }
        }
    endwhile;

    $args01 = array('post_type' => 'activity', 'posts_per_page' => -1);
    $loop01 = new WP_Query($args01);
    while ($loop01->have_posts()) :$loop01->the_post();
        $sectionOf = get_field("activity_slug");
        if ($category == $sectionOf) {
            $colorcode = get_field('typo_color');

        }
    endwhile;
endwhile;
endif;
?>

<div class="content-wrap single-porfolio">
    <main id="content" role="main">
        <div class="details-sidebar">
            <div class="details-content">
                <?php if (have_posts()) : while (have_posts()) : the_post();
                    $client = get_field('color_code'); ?>
                    <div class="<?php echo $content_col; ?>">
                        <div class="entry-info-wrap">
                            <?php if ($client != "" && $client != null) {
                                echo "client " . $client;
                            } ?>

                            <br>
                            <?php echo '<a class="category-link" href="https://www.mayroo.fr/portfolio/?_='.$category.'">';?>
                            <svg fill="<? echo $colorcode ?>" version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 48.1 32.9" style="enable-background:new 0 0 48.1 32.9;" xml:space="preserve">
<path d="M46.1,12.6c-0.1-0.6-0.6-1.1-1.2-1.1c-6.8-0.3-13.6-0.1-20.4,0c-0.8,0-1.4-0.6-1.3-1.4c0.2-2.9,0.3-5.8,0.2-8.7
	c0-0.7-0.7-1.1-1.3-0.8C14.8,4,7.7,10.5,1.1,15c-0.5,0.3-0.6,1-0.2,1.4c6.4,6.2,12.9,9.9,19.4,16.1c0.4,0.4,1.4,0.3,1.5-0.4
	c0.3-1.9,0.6-3.8,0.8-5.7c0.1-0.8,0-3.4,0.6-4.1c1.6-1.7,6.9-0.3,9.1,0c4.2,0.4,8.3,0.8,12.5,1.2c0.7,0.1,1.3-0.4,1.4-1.1
	C46.6,17.9,46.3,14.3,46.1,12.6z"/>
</svg>

                            <?php echo $category.'</a>';  ?>

                            <h1 class="entry-title"
                                style="color: <? echo $colorcode ?>"><?php the_title(); ?></h1>

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>

                <?php endwhile; endif; ?>


                <div class="related-works">
                    <p class="title">
                        Travaux similaires
                    </p>

                    <div class="row">
                        <ul>
                            <?php
                            $title = get_the_title();
                            $titleArray =[$title];

                            foreach ($relatedWork as $value) {
                                if (in_array($value[0], $titleArray)) {
                                }else{
                                   array_push($titleArray, $value[0]);
                                    echo '<li><a href="' . $value[1] . '">' . $value[0] . '</a></li>';
                                }

                            } ?>
                        </ul>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xs-9 image-wrapper">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php
                $terms = get_the_terms($post->ID, 'portfolio-category');
                $video_url = get_post_meta(get_the_ID(), 'ci_cpt_video_url', true);
                $template = get_post_meta(get_the_ID(), 'ci_cpt_portfolio_template', true);


                if ($template == 'fullwidth-flex') {
                    $content_col = 'col-xs-12';
                    $sidebar_col = 'col-xs-12';
                    $thumb = 'fullwidth_cropped';
                } else {
                    $content_col = 'col-md-4 col-md-pull-8';
                    //$sidebar_col = 'col-md-12 col-md-push-4';
                    $thumb = 'tall_thumb';
                }
                ?>
                <article class="col-xs-9"
                         id="entry-<?php the_ID(); ?>" <?php post_class('entry ' . $template); ?>>
                    <nav class="entry-nav">
                        <?php

                        /*$prev_post = get_previous_post(false, "empty");

                        $cliquable_prev = get_field("cliquable", $prev_post->ID);*/
                        $excluded_terms = ['148','149'];

                        $prev_link = get_previous_post_link('%link', '<i class="fa fa-angle-left"></i>', true, $excluded_terms);
                            $prev_link = str_replace('rel="prev"', 'rel="prev" class="entry-prev"', $prev_link);
                            echo $prev_link;


                        /*$next_post = get_next_post();
                        $cliquable_next = get_field("cliquable", $next_post->ID);*/


                            $next_link = get_next_post_link('%link', '<i class="fa fa-angle-right"></i>', true, $excluded_terms);
                            $next_link = str_replace('rel="next"', 'rel="prev" class="entry-next"', $next_link);
                            echo $next_link;


                        ?>
                    </nav>
                    <div class="row">
                        <div class="<?php echo $sidebar_col; ?>">
                            <?php if (!empty($video_url)) : ?>
                                <figure class="entry-thumb">
                                    <div class="video-hold">
                                        <?php echo wp_oembed_get(esc_url($video_url)); ?>
                                    </div>
                                </figure>
                            <?php else : ?>
                                <?php $images = ci_featgal_get_attachments(); ?>
                                <?php if ($template == 'standard-flex' OR $template == 'fullwidth-flex') : ?>
                                    <figure class="entry-thumb">
                                        <div class="flexslider">
                                            <ul class="slides">
                                                <?php while ($images->have_posts()) : $images->the_post(); ?>
                                                    <li>
                                                        <a href="<?php echo ci_get_image_src($post->ID, 'large'); ?>"
                                                           class="fancybox" data-fancybox-group="gallery">
                                                            <?php $attachment = wp_prepare_attachment_for_js($post->ID); ?>
                                                            <img src="<?php echo ci_get_image_src($post->ID, $thumb); ?>"
                                                                 alt="<?php echo esc_attr($attachment['alt']); ?>">
                                                        </a></li>
                                                <?php endwhile; ?>
                                            </ul>
                                        </div>
                                    </figure>

                                <?php elseif ($template == 'custom_animals') : ?>
                                    <div class="grid custom-animals">
                                        <?php while ($images->have_posts()) : $images->the_post(); ?>
                                            <a href="<?php echo ci_get_image_src($post->ID, 'large'); ?>"
                                               class="fancybox" data-fancybox-group="gallery">
                                                <?php $attachment = wp_prepare_attachment_for_js($post->ID); ?>
                                                <img src="<?php echo ci_get_image_src($post->ID, 'tall_thumb'); ?>"
                                                     alt="<?php echo esc_attr($attachment['alt']); ?>">
                                            </a>
                                        <?php endwhile; ?>

                                    </div>

                                <?php elseif ($template == 'winter') : ?>
                                    <div class="grid winter">
                                        <?php while ($images->have_posts()) : $images->the_post(); ?>
                                            <a href="<?php echo ci_get_image_src($post->ID, 'large'); ?>"
                                               class="fancybox" data-fancybox-group="gallery">
                                                <?php $attachment = wp_prepare_attachment_for_js($post->ID); ?>
                                                <img src="<?php echo ci_get_image_src($post->ID, 'tall_thumb'); ?>"
                                                     alt="<?php echo esc_attr($attachment['alt']); ?>">
                                            </a>
                                        <?php endwhile; ?>

                                    </div>

                                <?php else : ?>
                                    <figure class="entry-thumb">
                                        <?php while ($images->have_posts()) : $images->the_post(); ?>
                                            <a href="<?php echo ci_get_image_src($post->ID, 'large'); ?>"
                                               class="fancybox" data-fancybox-group="gallery">
                                                <?php $attachment = wp_prepare_attachment_for_js($post->ID); ?>
                                                <img src="<?php echo ci_get_image_src($post->ID, 'tall_thumb'); ?>"
                                                     alt="<?php echo esc_attr($attachment['alt']); ?>">
                                            </a>
                                        <?php endwhile; ?>
                                    </figure>
                                <?php endif;
                                wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>


                </article>

            <?php endwhile; endif; ?>

            <?php
            // Related Galleries
            $term_list = array();
            $tax_query = array();
            $terms = get_the_terms(get_the_ID(), 'portfolio-category');

            if (is_array($terms) and count($terms) > 0) {
                $term_list = wp_list_pluck($terms, 'slug');
                $term_list = array_values($term_list);
                if (!empty($term_list)) {
                    $tax_query = array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'portfolio-category',
                                'field' => 'slug',
                                'terms' => $term_list
                            )
                        )
                    );
                }
            }

            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => ci_setting('related_items_num'),
                'post_status' => 'publish',
                'post__not_in' => array($post->ID),
                'orderby' => 'rand'
            );

            $related = new WP_Query(array_merge($args, $tax_query));
            ?>

            <?php if ($related->have_posts()): ?>

            <?php endif;
            wp_reset_postdata(); ?>
        </div>
    </main>
    <?php get_footer(); ?>

    <script>

        var val = "<?php echo $colorcode ?>";
        var vallight = "<?php echo $colorcodelight ?>";
        jQuery(document).ready(function () {
            jQuery("#menu-social-medias > li > a ").css("background-color", val);
            jQuery("#menu-social-medias > li > a").hover(function () {
                jQuery(this).css("background-color", vallight);
            }, function () {
                jQuery(this).css("background-color", val);
            });
            let targetblank = document.querySelectorAll(".menu-image-title-after");
            jQuery(targetblank).attr('target', '_blank');

        });
    </script>
