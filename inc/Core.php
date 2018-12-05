<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 19.11.2018
 * Time: 15:29
 */

Class Core
{
    public function __construct() {
        add_action( 'after_setup_theme', array( __CLASS__, 'constants' ), 0 );

        add_action( 'after_setup_theme', array(__CLASS__, PREFIX.'_setup'));

        add_action( 'wp_enqueue_scripts', array(__CLASS__, 'theme_js'));
        add_action( 'wp_enqueue_scripts', array(__CLASS__, 'theme_css'));
    }

    public function constants()
    {

        define( 'AS_DIR', get_template_directory() );
        define( 'AS_URI', get_template_directory_uri() );
        define( 'AS_DIR_ASSETS', AS_URI .'/assets' );
        define( 'AS_DIR_PARTIALS', AS_URI .'/partials' );
        define( 'AS_DIR_CSS', AS_DIR_ASSETS .'/css/' );
        define( 'AS_DIR_JS', AS_DIR_ASSETS .'/js/' );
        define( 'AS_DIR_JS_PLUGINS', AS_DIR_JS .'/plugins/' );
    }
    public function EE_setup() {

        // Load text domain
        load_theme_textdomain( PREFIX, get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Enable support for <title> tag
        add_theme_support( 'title-tag' );

        /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/..
        */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        // @example
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Левое фиксированое меню', PREFIX ),
            'footer-center-menu' => esc_html__( 'Меню в футере', PREFIX ),
        ) );

        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ) );
    }

    public function theme_js() {

      /*  //New Jquery
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', AS_DIR_JS_PLUGINS.'jquery.min.js', false, null, true );
        wp_enqueue_script( 'jquery' );*/

        //Main Javascript
        wp_enqueue_script( PREFIX.'-main-js', AS_DIR_JS.'scripts.min.js',array('jquery'),'1.00',false);


        //Add Object PHP for Ajax
        wp_localize_script( PREFIX.'-main-js', PREFIX.'_ajax',
            array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
            )
        );
    }

    public function theme_css() {
        //Theme css
        wp_enqueue_style( PREFIX.'-screen', AS_DIR_CSS.'common-screen.min.css',false, '1.00');
        wp_enqueue_style( PREFIX.'-general', AS_DIR_CSS.'common.min.css',false, '1.00');
    }
}
new Core();
