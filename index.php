<?php
/**
 * Main Template File
 * 
 * @package Theme Red
 * 
 */

get_header();

?>

<div class="blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="mehnaz-blog-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-title text-center"><?php the_title(''); ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            $post_id = get_the_ID();  // current post ID
                            $custom_query = new WP_Query([
                                'post_type' => 'post',
                                'posts_per_page' => 4,
                                'category__in' => wp_get_post_categories($post_id),
                                'post__not_in' => [$post_id],
                            ]);
                            ?>
                                <?php
                                if ($custom_query->have_posts()) {
                                    while ($custom_query->have_posts()) : $custom_query->the_post();
                                    ?>  
                                    <div class="col-lg-6">
                                        <article class="mehnaz-blog-item">
                                            <a href="<?php the_permalink(); ?>"><h1><?php the_post_thumbnail( 'mehnaz-fullscreen' ); ?></h1></a>
                                            <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
                                            <a href="<?php the_permalink(); ?>"><p><?php the_excerpt(); ?></p></a>
                                            <a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e('Read More', 'mehnaz') ?></a>
                                        </article>
                                    </div>
                                    <?php
                                    endwhile;
                                    wp_reset_postdata();
                                }
                                ?> 
                            <?php 
                                the_posts_pagination();
                            ?>
                        </div>                                                
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="sidebar">
                    <?php dynamic_sidebar( 'sidebar' ); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-widget">
    <div class="container"> 
        <div class="row">
            <div class="col-lg-4">
                <div class="footer-sidebar">
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="footer-sidebar">
                    <?php dynamic_sidebar( 'sidebar-2' ); ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="footer-sidebar">
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </div>
            </div>
        </div> 
    </div>
</div>

<?php
get_footer();
