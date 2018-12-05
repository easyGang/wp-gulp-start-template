<?php
//Константа для prefix`a
define('PREFIX','ee', true);

//Подключаем kirki

include_once( dirname( __FILE__ ) . '/inc/kirki/kirki.php' );

function mytheme_kirki_configuration() {
    return array( 'url_path'     => get_template_directory() . '/inc/kirki/' );
}
add_filter( 'kirki/config', 'mytheme_kirki_configuration' );

//Подключам CRB (Мета поля)
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}
//Пример использования в файлах
//use Carbon_Fields\Container;
//use Carbon_Fields\Field;

//Подключаем компоненты
get_template_part('partials/common/php/common');

//Register Theme
get_template_part('inc/Core');

//Register Post Type
get_template_part('inc/rpt');

//Customizer
get_template_part('inc/Customizer');

//Ajax
get_template_part('inc/ajax');

//Hooks
get_template_part('inc/hooks');


//Carbon MetaBox
get_template_part('inc/meta');
