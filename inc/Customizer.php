<?php

class Customizers
{
    const prefix = PREFIX;
    public function __construct()
    {
        //Пример
        add_action( 'customize_register', array(__CLASS__,'mains') );
    }

    /**
     * Подключение customizer`а
     * Пример
     * @since   1.0.0
     */

    public static function mains($wp_customize)
    {
        $prefix=self::prefix;
        $main_panel=$prefix.'_main_panel';
        Kirki::add_config( $prefix, array(
            'capability'    => 'edit_theme_options',
            'option_type'   => 'theme_mod',
        ) );

        $wp_customize->add_panel( $main_panel, array(
            'title' 			=> esc_html__( 'Общие настройки', 'sitmade' ),
            'priority' 			=> 1,
        ) );

        $wp_customize->add_section( $prefix.'main_si', array(
            'title' 			=> esc_html__( 'Социальные иконки', 'sitmade' ),
            'priority' 			=> 10,
            'panel' 			=> $main_panel,
        ) );

        Kirki::add_field( $prefix, array(
            'type'     => 'text',
            'settings' => 'asdsasdsad',
            'label'    => __( 'Text Control', 'textdomain' ),
            'section'  => $main_panel,
            'default'  => esc_attr__( 'This is a defualt value', 'textdomain' ),
            'priority' => 10,
        ) );

        Kirki::add_field( $prefix, array(
            'type'        => 'repeater',
            'label'       => esc_attr__( 'Социальные иконки', 'textdomain' ),
            'section'     => $prefix.'main_si',
            'priority'    => 10,
            'row_label' => array(
                'type' => 'text',
                'value' => esc_attr__('Изображение', 'textdomain' ),
            ),
            'button_label' => esc_attr__('Добавить Пункт', 'textdomain' ),
            'settings'     =>$prefix.'fp_screen_si_repeater',
            'default'      => '',
            'fields' => array(
                'url' => array(
                    'type'        => 'text',
                    'label'       => esc_attr__( 'Ссылка', 'textdomain' ),
                    'default'     => '',
                ),
                'link_text_type' => array
                (
                    'type'        => 'select',
                    'label'       => esc_attr__( 'Тип', 'textdomain' ),
                    'choices'     => array(
                        'facebook'   => esc_attr__( 'Facebook', 'textdomain' ),
                        'vkontakte'    => esc_attr__( 'VK', 'textdomain' ),
                        'tweeter'    => esc_attr__( 'Twitter', 'textdomain' ),
                        'instagram'    => esc_attr__( 'Instagram ', 'textdomain' ),
                        'periscope'    => esc_attr__( 'Periscope ', 'textdomain' ),
                    ),
                )
            )
        ) );
    }

}
new Customizers();
