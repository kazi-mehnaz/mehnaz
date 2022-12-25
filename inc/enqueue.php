<?php
/**
* Register and Enqueue Scripts and styles.
*
* @since Theme Red 1.0
*/
function theme_red_enqueue_scripts(){
    // enqueue css
    wp_enqueue_style("style-css", get_template_directory_uri() . "/style.css", [], "1.0.0", "all");
    wp_enqueue_style("bootstrap-css", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css", [], "1.0.0", false);
   
    // enqueue js 
    wp_enqueue_script("bootstrap-js", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js", [], "1.0.0", true);
}

add_action("wp_enqueue_scripts", "theme_red_enqueue_scripts");