<?php get_header("portfolio"); ?>


<?php

if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php
    $postcat = get_the_category();


    $str = strtolower($postcat[0]->name);

    $args01 = array('post_type' => 'activity', 'posts_per_page' => -1);
    $loop01 = new WP_Query($args01);
    while ($loop01->have_posts()) :$loop01->the_post();
        $sectionOf = get_field("activity_slug");
        if ($str == $sectionOf) {
            $colorcode = get_field('typo_color');
        }
    endwhile;
endwhile;
endif;
?>


    <div class="content-wrap single-porfolio">
        <main id="content" role="main">
            <div class="">
                <div class="row " style="display:flex;">

                    <div class="details-sidebar">

                        <?php if (have_posts()) : while (have_posts()) : the_post();
                            $client = get_field('color_code');

                            ?>
                            <div class="<?php echo $content_col; ?>">
                                <div class="entry-info-wrap">
                                    <?php if ($client != "" && $client != null) {
                                        echo "client " . $client;
                                    } ?>
                                    <br>
                                    Date :
                                    <h1 class="entry-title"
                                        style="color: <? echo $colorcode ?>"><?php the_title(); ?></h1>

                                    <div class="entry-content">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>

                        <?php endwhile; endif; ?>

                    </div>


                    <div class="col-xs-9">
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
                                    $prev_link = get_previous_post_link('%link', '<i class="fa fa-angle-left"></i>', false, '', 'portfolio-category');
                                    $next_link = get_next_post_link('%link', '<i class="fa fa-angle-right"></i>', false, '', 'portfolio-category');
                                    $prev_link = str_replace('rel="prev"', 'rel="prev" class="entry-prev"', $prev_link);
                                    $next_link = str_replace('rel="next"', 'rel="prev" class="entry-next"', $next_link);

                                    echo $prev_link;
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
                </div>
            </div>
        </main>
    </div>

<?php get_footer(); ?>