<?php

function render_main_menu() {
    $menu_render = menu_tree_all_data('main-menu', null, 3); 
    $str_items = '';
    $str_items .= '<ul class="primary-menu-menu">';

    foreach ($menu_render as $index => $menu_item) {
        $menu_item_parent = $menu_item['link'];
        $menu_item_child = $menu_item['below'];
        
        if (!$menu_item_parent['has_children']) {
            $str_items .= '<li class="menu-item-has-children"><a href="'.$menu_item_parent['href'].'">'.$menu_item_parent['link_title'].'</a></li>';
        } elseif ($menu_item_parent['has_children'] && isset($menu_item_parent['options']['item_attributes']['class']) && in_array("mega-menu", explode(" ", $menu_item_parent['options']['item_attributes']['class']))) {

            $str_items .= '<li class="menu-item-has-mega-menu menu-item-has-children">';

            $str_items .= '<a href="'.$menu_item_parent['href'].'">'.$menu_item_parent['link_title'].'</a>';
            $str_items .= '<div class="megamenu" style="background-image: url();">';
            $str_items .= '<div class="megamenu-row">';

            foreach($menu_item_child as $index_child => $menu_item_content) {
                $str_items .= '<div class="col4">';
                $str_items .= '<ul>';
                $str_items .= '<li class="megamenu-item-info">';
				$str_items .= '<h5 class="megamenu-item-info-title">'.$menu_item_content['link']['link_title'].'</h5>';
				$str_items .= '<p class="megamenu-item-info-text">Mirum est notare quam littera.</p>';
                $str_items .= '</li>';
                
                foreach($menu_item_content['below'] as $index_sub_child => $menu_item_sub_child) {
                    $str_items .= '<li>';
                    $str_items .= '<a href="'.$menu_item_sub_child['link']['href'].'">'.$menu_item_sub_child['link']['link_title'].'</a>';
                    $str_items .= '</li>';
                }

                $str_items .= '</ul>';
                $str_items .= '</div>';
            }
            
            $str_items .= '</div>';
            $str_items .= '</div>';
            $str_items .= '</li>';

        } elseif ($menu_item_parent['has_children']) {
            $str_items .= '<li class="menu-item-has-children">';
            $str_items .= '<a href="'.$menu_item_parent['href'].'">'.$menu_item_parent['link_title'].'</a>';
            $str_items .= '<ul class="sub-menu">';

            foreach($menu_item_content['below'] as $index_sub_child => $menu_item_sub_child) {
                $str_items .= '<li>';
                $str_items .= '<a href="'.$menu_item_sub_child['link']['href'].'">'.$menu_item_sub_child['link']['link_title'].'</a>';
                $str_items .= '</li>';
            }

            $str_items .= '</ul>';
            $str_items .= '</li>';
        }
    }

    $str_items .= '</ul>';

    return $str_items;
}