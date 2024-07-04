<?php

namespace Cool_Dashboard\Classes;

use function add_action;

/**
 * Handles the cleaning and management of styles within the WordPress admin and front-end.
 */
class Clean_Styles extends Minify {
    /**
     * Constructor.
     * Hooks into WordPress to clean up styles.
     */
    public function __construct()
    {
        add_action('admin_head', array( &$this,'remove_inline_styles'));
        add_action('admin_enqueue_scripts', array( &$this,'delete_admin_styles'), 100);
    }

    /**
     * Removes inline styles added by WordPress in the admin area.
     * @return void
     */
    public function remove_inline_styles(): void
    {
        echo $this->js('
                <script>
                    window.onload = () => {
                        const adminBarStyles = document.querySelectorAll("style");
                        adminBarStyles.forEach(el => {
                            if (el.getAttribute("data-cool") === "1") return
                            else el.remove()
                        });
                    };
                </script>
            ');
    }

    /**
     * Deletes all admin styles.
     * @return void
     */
    public function delete_admin_styles(): void
    {
        global $wp_styles;

        // Loop through all registered styles
        foreach ($wp_styles->registered as $handle => $data) {
            wp_deregister_style($handle);  // Deregister the style completely
            wp_dequeue_style($handle);     // Dequeue the style
        }
    }

}