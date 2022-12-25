<?php
/**
 * Single Post Template File
 * 
 * @package Theme Red
 * 
 */
?>

<div class="blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="mehnaz-single-blog">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-title text-center"><?php the_title(); ?></h1>
                            </div>
                        </div>
                        <div class="row">  
                            <div class="col-lg-12">
                                <article class="mehnaz-blog-item">
                                    <?php the_post_thumbnail(); ?>
                                    <h1><?php the_title(); ?></h1>
                                    <div class="meta">
                                        <span><?php the_date(); ?></span><span><?php the_category(); ?></span><span><?php the_tags(); ?></span><span><a href="<?php the_permalink(); ?>"><?php comments_number(); ?></span></a>
                                    </div>
                                    <p><?php the_content(); ?></p>
                                </article>
                                <?php 
                                    comments_template();
                                ?>
                            </div>
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