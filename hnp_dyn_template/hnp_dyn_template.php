<?php
/*
* Plugin Name: HNP Dyn Template
* Plugin URI: https://homepage-nach-preis.de/
* Description: Erstellt 2 Button welche bei Betätigung die Template-Datei auswechseln. Shortcodes: hnp_template_switcher_buttons und hnp_template_switcher
* Version: 1.1
* Author: Christopher Rohde
* Author URI: https://homepage-nach-preis.de/
* License: HNP-Dyn-Template
*/

// Shortcode für den Template-Switcher hinzufügen
add_shortcode('hnp_template_switcher', 'hnp_custom_template_switcher_shortcode');

// Funktion zum Rendern des Shortcodes
function hnp_custom_template_switcher_shortcode() {
    ob_start();
    ?>
    <div id="hnp-template-container">
        <!-- Hier wird das Template dynamisch geladen -->
        <?php include_once(plugin_dir_path(__FILE__) . '/templates/hnp_template_1.php'); ?>
    </div>
    <?php
    return ob_get_clean();
}

// Shortcode für die Schaltflächen zum Wechseln der Templates hinzufügen
add_shortcode('hnp_template_switcher_buttons', 'hnp_custom_template_switcher_buttons_shortcode');

// Funktion zum Rendern des Shortcodes für die Schaltflächen
function hnp_custom_template_switcher_buttons_shortcode() {
    ob_start();
    ?>
    <button id="hnp-template1-btn">Template 1 laden</button>
    <button id="hnp-template2-btn">Template 2 laden</button>
    <?php
    return ob_get_clean();
}

// JavaScript zum Schalten der Templates hinzufügen
add_action('wp_footer', 'hnp_custom_template_switcher_js');

function hnp_custom_template_switcher_js() {
    wp_enqueue_script('hnp-custom-template-switcher', plugin_dir_url(__FILE__) . 'hnp_dyn_template.js', array('jquery'), null, true);

    wp_localize_script('hnp-custom-template-switcher', 'hnpTemplateSwitcher', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}

// Ajax
add_action('wp_ajax_load_template', 'hnp_load_template_ajax');
add_action('wp_ajax_nopriv_load_template', 'hnp_load_template_ajax');

function hnp_load_template_ajax() {
    $template = isset($_GET['template']) ? $_GET['template'] : '';

    if ($template) {
        // Hier können Sie die Template-Datei laden und den Inhalt zurückgeben
        include(plugin_dir_path(__FILE__) . '/templates/' . $template);
    }

    wp_die();
}