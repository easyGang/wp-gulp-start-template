<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.11.2018
 * Time: 16:07
 */

class rpt
{
    public function __construct()
    {
        //Пример
        //add_action( 'init', array(__CLASS__, 'cards'), 0 );
    }

    /**
     * Регистрация Карточек
     * Пример
     * @since   1.0.0
     */
   /* public function cards()
    {
        $labels = array(
            'name'                => _x( 'Карточки', 'Post Type General Name', 'cards'),
            'singular_name'       => _x( 'Карточки', 'Post Type Singular Name', 'cards'),
            'menu_name'           => __( 'Карточки', 'cards'),
            'parent_item_colon'   => __( 'Родительский:', 'cards'),
            'all_items'           => __( 'Все карточки', 'cards'),
            'view_item'           => __( 'Просмотреть', 'cards'),
            'add_new_item'        => __( 'Добавить новую карточку', 'cards'),
            'add_new'             => __( 'Добавить новую', 'cards'),
            'edit_item'           => __( 'Редактировать карточку', 'cards'),
            'update_item'         => __( 'Обновить карточку', 'cards'),
            'search_items'        => __( 'Найти карточку', 'cards'),
            'not_found'           => __( 'Не найдено', 'cards'),
            'not_found_in_trash'  => __( 'Не найдено в корзине', 'cards'),
        );
        $args = array(
            'labels'              => $labels,
            'supports'            => array( 'title','page-attributes' ),
            'hierarchical' => true,
            'taxonomies'          => array('cards'),
            'public'              => true,
            'has_archive' 				=> true,
            'rewrite'             => array('slug' => 'cards','with_front' => false,),
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-images-alt',
        );
        register_post_type( 'cards', $args );
    }*/
}
