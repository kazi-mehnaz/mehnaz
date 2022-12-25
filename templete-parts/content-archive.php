<?php
/**
 * Single Post Template File
 * 
 * @package Theme Red
 * 
 */
?>

<div class="mehnaz-blog-wrap archive-wrap">
    <div class="container">
        <div class="row">  
            <div class="col-lg-12">
                <article class="mehnaz-blog-item">
                    <?php the_post_thumbnail(); ?>
                    <h1><?php the_title(); ?></h1>
                    <div class="meta">
                        <span><?php the_date(); ?></span><span><?php the_category(); ?></span><span><?php the_tags(); ?></span><span><a href="<?php the_permalink(); ?>"><?php comments_number(); ?></span></a>
                    </div>
                    <p><?php the_content(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="button">Read More</a>
                </article>
            </div>
        </div>                                                  
    </div>
</div>