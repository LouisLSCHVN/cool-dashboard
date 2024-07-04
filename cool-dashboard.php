<?php

/*
Plugin Name: Cool Dashboard
Plugin URL: https://plugins.cool/cool-dashboard
Description: A custom dashboard for your WordPress admin area.
Version: 0.1
Author: Cool Plugins Team
Author URI: https://plugins.cool
Text Domain: cool_dashboard
*/

require_once "bootstrap.php";

use Cool_Dashboard\Classes\Clean_Styles;
class Cool_Dashboard
{

    // Refers to a single instance of this class
    private static ?Cool_Dashboard $instance = null;

    /**
     * Creates or returns a single instance of this class
     *
     * @return Cool_Dashboard|null a single instance of this class
     * @since 0.1.0
     */
    public static function self(): ?Cool_Dashboard
    {
        if ( null == self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct()
    {
        add_action('admin_menu', array( &$this,'register_menu') );
        add_action('admin_head', array( &$this,'create_dashboard'));
        new Clean_Styles();
    }

    public function register_menu(): void
    {
        add_dashboard_page( 'Cool Dashboard', 'Cool Dashboard', 'read', 'cool-dashboard', array( &$this,'create_dashboard') );
    }

    public function create_dashboard(): void
    {
        echo '
            <style data-cool="1"> 
                /* Set a data-cool to 1 to not delete the html tag with a scripts */
                #adminmenuback{
                    background-color: #0000ff;
                }
            </style>
        ';
    }
}

//$GLOBALS['cool_dashboard'] = Cool_Dashboard::self();
