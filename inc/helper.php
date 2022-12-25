<?php
// mehnaz header
function mehnaz_header(){
    ?> 
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="#">
                            <?php 
                            if(function_exists('the_custom_logo')) {
                                the_custom_logo();
                            }
                            ?>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <?php
                                wp_nav_menu(
                                    array(
                                        'menu' => 'primary',
                                        'container' => '',
                                        'theme_location' => 'primary',
                                        'items_wrap' => '<ul id="" class="navbar-nav m-auto mb-2 mb-lg-0">%3$s</ul>'
                                    )
                                );
                            ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <?php
}