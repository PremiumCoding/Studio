<?php

// Activate menu function
add_action('init', 'my_custom_menus');

function my_custom_menus()
{
    register_nav_menus(array(
        'main-menu' => 'Main Menu',
    ));
}

// Main walker menu


?>