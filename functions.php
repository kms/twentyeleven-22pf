<?php

function favicon_link() {
    echo '<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />' . "\n";
}
add_action('wp_head', 'favicon_link');

function twentytwopf_remove_header_images() {
    unregister_default_headers( 
        array('wheel','shore','trolley','pine-cone','chessboard','lanterns','willow','hanoi')
    );
}
add_action('after_setup_theme', 'twentytwopf_remove_header_images', 11);

function twentytwopf_new_default_header_images() {
    $image_base_url = get_bloginfo('stylesheet_directory') . '/images/headers/';
    $files = scandir(get_theme_root() . '/' . 'twentyeleven-22pf' . '/images/headers/'); 

    $images = array();
    foreach ($files as $file) { 
        if ($file != '.' && $file != '..' && fnmatch("*.jpg", $file)) { 
            $images[] = $file; 
        } 
    }

    $headers = array();
    foreach ($images as $i) {
        $headers[basename($i)] = array(
                'url' => $image_base_url . $i,
                'thumbnail_url' => $image_base_url . '/thumbs/' . $i,
            );
    }

    register_default_headers($headers);
}
add_action('after_setup_theme', 'twentytwopf_new_default_header_images', 11);

?>
