<?php

namespace Cool_Dashboard\Classes;

class Cool_Login {

    public function __construct()
    {
        new Clean_Styles();
        add_action('login_enqueue_scripts', array( &$this,'logo') );
    }

    public function logo(): void
    { ?>
        <style>
            #login h1 a, .login h1 a {
                background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/login-logo.png);
                padding-bottom: 30px;
            }
        </style>
        <?php
    }
}