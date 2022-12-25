<?php
/**
 * Page Template File
 * 
 * @package Theme Red
 * 
 */

get_header();
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <?php
        get_template_part('templete-parts/content', 'page');
    ?>
</article>

<?php
get_footer();
