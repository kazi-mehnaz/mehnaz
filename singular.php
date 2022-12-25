<?php
/**
 * Single Post Template File
 * 
 * @package Theme Red
 * 
 */

get_header();
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <?php
    if( have_posts() ) {
        while( have_posts() ) { 
            the_post();
            get_template_part('templete-parts/content', 'normal');
        }
    }
    ?>
</article>

<?php
get_footer();


