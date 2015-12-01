<?php

// Activate menu function
add_action('init', 'my_custom_menus');

function my_custom_menus()
{
    register_nav_menus(array(
        'main-menu' => 'Main Menu',		'resp_menu' => 'Responsive Menu'		
    ));
}

// Main walker menu

class Walker_Responsive_Menu extends Walker_Nav_Menu {    function start_lvl(&$output, $depth){      $indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)    }    function end_lvl(&$output, $depth){      $indent = str_repeat("\t", $depth); // don't output children closing tag    }		function start_el(&$output, $item, $depth, $args) {		global $wp_query;				$item_output = $attributes = $prepend ='';		// Create a visual indent in the list if we have a child item.		$visual_indent = ( $depth ) ? str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $depth) : '';		// Load the item URL		$attributes .= ! empty( $item->url ) ? ' value="'   . esc_attr( $item->url ) .'"' : '';		// If we have hierarchy for the item, add the indent, if not, leave it out.		// Loop through and output each menu item as this.		if($depth != 0) {			$item_output .= '<option ' . $attributes .'>'. $visual_indent . $item->title. '</option>';		} else {			$item_output .= '<option ' . $attributes .'>'.$prepend.$item->title.'</option>';		}		// Make the output happen.		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );	}}class description_walker extends Walker_Nav_Menu{      function start_el(&$output, $item, $depth, $args)      {           global $wp_query;           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';           $class_names = $value = '';           $classes = empty( $item->classes ) ? array() : (array) $item->classes;           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );           $class_names = ' class="'. esc_attr( $class_names ) . '"';           $output .= $indent . '<li id="menu-item-main-'. $item->ID . '"' . $value . $class_names .'>';           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';           $prepend = '<strong>';           $append = '</strong>';           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';           if($depth != 0)           {                     $description = $append = $prepend = "";           }            $item_output = $args->before;            $item_output .= '<a'. $attributes .'>';            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;            $item_output .= $description.$args->link_after;            $item_output .= '</a>';            $item_output .= $args->after;            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );            }}
?>