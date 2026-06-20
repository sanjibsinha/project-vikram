<?php
/**
 * Plugin Name: Project Vikram Platform
 * Plugin URI: https://sanjibdebsinha.in
 * Description: Backend platform powering the Project Vikram reading application.
 * Version: 0.1.0
 * Author: Sanjib Deb Sinha
 * License: GPL2+
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

define('VIKRAM_PLATFORM_PATH', plugin_dir_path(__FILE__));
define('VIKRAM_PLATFORM_URL', plugin_dir_url(__FILE__));

$autoload = VIKRAM_PLATFORM_PATH . 'vendor/autoload.php';

if (! file_exists($autoload)) {
    return;
}

require_once $autoload;

use ProjectVikram\Bootstrap\Bootstrap;

add_action('plugins_loaded', static function (): void {
    (new Bootstrap())->boot();
});