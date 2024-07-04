<?php

if ( ! defined( 'WPINC' ) ) {
    die;
}

define('COOL_DASHBOARD_VERSION', '0.1.0');
define('COOL_DASHBOARD_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('COOL_DASHBOARD_CLASSES_URL', plugin_dir_path( __FILE__ ) . 'classes/');

spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/classes/';
    $prefix = 'Cool_Dashboard\\Classes\\';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;

    $relative_class = substr($class, $len);

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) require $file;
});