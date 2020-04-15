<?php
/*
 * Template Name: Portfolio - avec parametres
 */
?>
<?php
$section = get_query_var('_');
$args01 = array('post_type' => 'activity', 'posts_per_page' => -1);
$loop01 = new WP_Query($args01);
while ($loop01->have_posts()) :
    $loop01->the_post();
    $sectionOf = get_field("activity_slug");
    if ($section == $sectionOf) {
        $colorcode = get_field('color_code');
    }
endwhile;
?>
<?php get_header('portfolio'); ?>


<?php if($section == "integration"){?>
    <main class="flex-justify-center portfolio">

        <div class="col-md-6">
            <?php the_content();?>
        </div>
        <div class="col-md-6">
            <?php
            the_post_thumbnail();
            ?>
        </div>


    </main>

<?php }  else { ?>
    <span id="entry-effect" style="background-color:<?echo $colorcode?>"></span>
    <div class="content-wrap full portfolio">


        <main id="content" role="main">

            <div class="container">



                    <div class="row joined infinite">
                        <?php
                        global $paged;
                        $paged = !empty($paged) ? $paged : get_query_var('page');
                        $temp = $wp_query;

                        $args = array(
                            'post_type' => 'portfolio',
                            'category_name' => $section,
                            'posts_per_page' => -1,
                            'paged' => $paged,

                        );

                        $wp_query = new WP_Query($args);
                        ?>
                        <?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();
                            $trueitem = get_field("cliquable");
                            $truelink = get_field("link");


                            ?>
                            <article class="item <?php ci_e_setting('portfolio_category_columns');?> masked"
                                     style="background: url('<?php echo ci_get_featured_image_src('square_thumb'); ?>') center center no-repeat; background-size: cover;">

                                <a  href="<?php if ($trueitem == true) {the_permalink();} else {echo $truelink;}?> ">
                                    <p class="item-title"><?php the_title(); ?></p>
                                </a>
                            </article>
                        <?php endwhile; endif; ?>
                    </div>

                    <?php
                    wp_reset_postdata();
                    $wp_query = $temp;
                }
                ?>
            </div>
        </main>
    </div>

<?php get_footer(); ?>

<script>
    setInterval(function(){
        var  masked = document.querySelector(".masked");
        setInterval(function(){ jQuery(masked).addClass("up")},400);
        jQuery(masked).removeClass("masked");}, 400);

        jQuery(document).ready(function() {
            jQuery(".infinite").css("background", "<?php echo $colorcode;?>");}
            );


</script>
