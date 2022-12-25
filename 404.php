<?php
/**
 * The template for displaying the 404 template in the Theme Red theme.
 *
 * @package WordPress
 * @subpackage Theme_Red
 * @since Theme Red 1.0
 */

get_header();
?>

<div class="404-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <main id="site-content">
                    <div class="section-inner text-center m-5">
                        <h1 class="entry-title"><?php _e( 'Page Not Found', 'mehnaz' ); ?></h1>
                        <div class="intro-text"><p><?php _e( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'mehnaz' ); ?></p></div>
                        <?php
                            get_search_form(
                                array(
                                    'aria_label' => __( '404 not found', 'mehnaz' ),
                                )
                            );
                        ?>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
